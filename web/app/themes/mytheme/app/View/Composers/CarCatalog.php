<?php
namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use Illuminate\Support\Facades\DB;

class CarCatalog extends Composer {
    protected static $views = ['page-catalog'];

    public function with() {
        global $wpdb;
        // dd('111');
        $per_page = get_option('posts_per_page'); // Количество записей на странице
        // $per_page = 3; // Количество записей на странице
        $current_page = max(1, get_query_var('paged'));
        $brand_filter = sanitize_text_field($_GET['brand'] ?? ''); // Получаем значение параметра brand из URL
        $year_filter = sanitize_text_field($_GET['car_year'] ?? ''); // Получаем значение параметра year из URL
        // $year_filter = intval(sanitize_text_field($_GET['year'] ?? ''));
        $car_brands = get_terms('car_brand');
        // dd($car_brands);

        $table_name = $wpdb->prefix . 'cars_properties'; // Используем префикс таблицы WordPress

        $where_clause = '1=1'; // Начальное условие

        if (!empty($brand_filter)) {
            $where_clause .= $wpdb->prepare(" AND car_brand = %s", $brand_filter);
        }

        if (!empty($year_filter)) {
            $where_clause .= $wpdb->prepare(" AND year = %s", $year_filter);
            // $where_clause .= $wpdb->prepare(" AND year = %d", $year_filter);

        }

        $query = $wpdb->prepare(
            "SELECT post_id, car_model, car_brand, image, year, engine_type, transmission_type, range_km
            FROM $table_name
            WHERE $where_clause
            ORDER BY post_id DESC
            LIMIT %d, %d",
            ($current_page - 1) * $per_page,
            $per_page
        );

        $cars = $wpdb->get_results($query, OBJECT);

        $total_cars = $wpdb->get_var(
            "SELECT COUNT(*)
            FROM $table_name
            WHERE $where_clause"
        );

        return [
            'car_brands' => $car_brands,
            'cars' => $cars,
            'pagination' => paginate_links(array(
                'total' => ceil($total_cars / $per_page),
                'current' => $current_page,
                'type' => 'array',
                'prev_text' => '← Ранее',
                'next_text' => 'Далее →',
                'before_page_number' => '<button class="page-numbers inline-block py-2 px-4 bg-gray-800 hover:bg-gray-600 text-white font-bold rounded mx-1">',
                'after_page_number' => '</button>',
                'before_current' => '<span aria-current="page" class="page-numbers inline-block py-2 px-4 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded mx-1">',
                'after_current' => '</span>',
                'mid_size' => 2,
            )),
        ];

        // return [
        //     'cars' => $cars,
        //     'pagination' => paginate_links(array(
        //         'total' => ceil($total_cars / $per_page),
        //         'current' => $current_page,
        //         'type' => 'array',
        //     )),
        // ];
    }
}
