<?php
namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class SingleCar extends Composer {
    protected static $views = ['single-car'];

    public function with()
    {
        global $wpdb;

        $slug = request()->segment(2); // Получаем слаг из URL

        // Получаем пост по слагу
        $post = get_page_by_path($slug, OBJECT, 'car');

        // Проверяем, найден ли пост
        if ($post && isset($post->ID)) {

            $post_id = $post->ID;

            $table_name = $wpdb->prefix . 'cars_properties';

            $car_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE post_id = %d", $post_id));

            $post_title = $post->post_title;

            if ($car_data) {
                $car = (object) array_merge((array) $car_data, ['post_title' => $post_title]);
                return ['car' => $car];
            }
        }

        // Если пост не найден или автомобиль не существует, вызываем ошибку 404
        abort(404);
    }
}

