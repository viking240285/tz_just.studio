<?php
namespace App\Controllers;

use WP_REST_Response;
use WP_Error;

class RestApiCarsController {
    // public function __construct() {
    //     add_action('rest_api_init', [$this, 'register_routes']);
    // }

    public function register_routes() {
        add_action('rest_api_init', function () {

            register_rest_route('api/v1', '/catalog', [
                'methods'  => 'GET',
                'callback' => [$this, 'get_cars'],
            ]);

            register_rest_route('api/v1', '/manage/cars', [
                'methods'  => 'POST',
                'callback' => [$this, 'create_car'],
            ]);

            register_rest_route('api/v1', '/manage/cars/(?P<id>\d+)', [
                'methods'  => 'GET',
                'callback' => [$this, 'get_car'],
            ]);

            register_rest_route('api/v1', '/manage/cars/(?P<id>\d+)', [
                'methods'  => ['PUT', 'PATCH'],
                'callback' => [$this, 'update_car'],
            ]);

            register_rest_route('api/v1', '/manage/cars/(?P<id>\d+)', [
                'methods'  => 'DELETE',
                'callback' => [$this, 'delete_car'],
            ]);

            register_rest_route('api/v1', '/manage/cars/upload-image', [
                'methods'  => 'POST',
                'callback' => [$this, 'upload_image'],
            ]);
        });
    }

    public function get_cars() {
        error_log('GET request to /api/v1/catalog');
        global $wpdb;
        $table_name = $wpdb->prefix . 'cars_properties';
        $cars_data = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
        return new WP_REST_Response($cars_data, 200);
    }

    public function create_car($request) {
        $params = $request->get_params();
        global $wpdb;
        $table_name = $wpdb->prefix . 'cars_properties';

        $wpdb->insert(
            $table_name,
            array(
                'post_id' => $params['post_id'],
                'car_model' => sanitize_text_field($params['car_model']),
                'car_brand' => sanitize_text_field($params['car_brand']),
                'image' => sanitize_text_field($params['image']),
                'year' => intval($params['year']),
                'engine_type' => sanitize_text_field($params['engine_type']),
                'transmission_type' => sanitize_text_field($params['transmission_type']),
                'range_km' => intval($params['range_km']),
            )
        );

        $inserted_id = $wpdb->insert_id;
        $created_car_data = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $inserted_id", ARRAY_A);
        return new WP_REST_Response($created_car_data, 201);
    }

    public function get_car($request) {
        $car_id = $request['id'];
        global $wpdb;
        $table_name = $wpdb->prefix . 'cars_properties';
        $car_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $car_id), ARRAY_A);

        if (!$car_data) {
            return new WP_Error('invalid_car_id', 'Invalid car ID.', array('status' => 404));
        }

        return new WP_REST_Response($car_data, 200);
    }

    public function update_car($request) {
        $car_id = $request['id'];
        $params = $request->get_params();
        global $wpdb;
        $table_name = $wpdb->prefix . 'cars_properties';

        $wpdb->update(
            $table_name,
            array(
                'car_model' => sanitize_text_field($params['car_model']),
                'car_brand' => sanitize_text_field($params['car_brand']),
                'image' => sanitize_text_field($params['image']),
                'year' => intval($params['year']),
                'engine_type' => sanitize_text_field($params['engine_type']),
                'transmission_type' => sanitize_text_field($params['transmission_type']),
                'range_km' => intval($params['range_km']),
            ),
            array('id' => $car_id)
        );

        $updated_car_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $car_id), ARRAY_A);
        return new WP_REST_Response($updated_car_data, 200);
    }

    public function delete_car($request) {
        $car_id = $request['id'];
        global $wpdb;
        $table_name = $wpdb->prefix . 'cars_properties';

        $deleted = $wpdb->delete($table_name, array('id' => $car_id));

        if (!$deleted) {
            return new WP_Error('delete_car_error', 'Failed to delete car.', array('status' => 500));
        }

        return new WP_REST_Response(['message' => 'Car deleted successfully.'], 204);
    }


    public function upload_image($request) {
        $file = $request->get_file_params();
        $overrides = [
            'test_form' => false,
            'test_size' => true,
            'test_upload' => true,
        ];

        $uploaded_file = wp_handle_upload($file, $overrides);

        if ($uploaded_file && empty($uploaded_file['error'])) {
            $image_url = $uploaded_file['url']; // URL загруженного изображения
            return new WP_REST_Response(['image_url' => $image_url], 200);
        } else {
            return new WP_Error('image_upload_error', $uploaded_file['error']);
        }
    }
}
