<?php
// app/View/Composers/SingleCar.php
namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
// use DB;


class SingleCar extends Composer {
    protected static $views = ['single-car'];
    // protected static $views = ['page-single-car'];

    public function with()
    {
        global $wpdb;

        $slug = request()->segment(2); // Получаем слаг из URL

        // Получаем пост по слагу
        $post = get_page_by_path($slug, OBJECT, 'car'); // Указываем тип поста 'car'

        // Проверяем, найден ли пост
        if ($post && isset($post->ID)) {
            // Получаем post_id из поста
            $post_id = $post->ID;

            // Получаем данные о конкретном автомобиле из таблицы wp_cars_properties с использованием $wpdb
            $table_name = $wpdb->prefix . 'cars_properties'; // Добавляем префикс к имени таблицы
            $car_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE post_id = %d", $post_id));

            // Получаем post_title из объекта $post
            $post_title = $post->post_title;

            // Проверка на существование автомобиля
            if ($car_data) {
                // Объединяем данные
                $car = (object) array_merge((array) $car_data, ['post_title' => $post_title]);

                // Отправляем данные в шаблон
                return ['car' => $car];
            }
        }

        // Если пост не найден или автомобиль не существует, вызываем ошибку 404
        abort(404);
    }

    // public function with()
    // {
    //     dd('1111');
    //     // Получаем slug автомобиля из URL
    //     $carSlug = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

    //     // Получаем данные о конкретном автомобиле из вашей таблицы
    //     $car = DB::table('wp_cars_properties')->where('slug', $carSlug)->first();

    //     // Проверка на существование автомобиля
    //     if (!$car) {
    //         abort(404);
    //     }

    //     return ['car' => $car];
    // }

    // public function with()
    // {
    //     global $post;

    //     dd($post);
    //     if ($post && $post->post_type === 'car') {
    //         // Получите идентификатор записи "car" из ACF поля
    //         $carID = get_field('car_id_field_name', $post->ID);

    //         // Выполните запрос к кастомной таблице для получения данных об автомобиле
    //         $carData = DB::table('wp_cars_properties')->where('post_id', $carID)->first();

    //         if ($carData) {
    //             return [
    //                 'carData' => $carData,
    //             ];
    //         }
    //     }

    //     return [];
    // }

//     public function with() {
//         global $wpdb;

//         // $slug = get_post_field('post_name', get_post());
//         // $car = DB::table('wp_cars_properties')->where('car_model', $slug)->first();
//         $car = $wpdb->get_row("SELECT * FROM wp_cars_properties WHERE post_id = :post_id", ['post_id' => $post_id], OBJECT);
// dd($car);
//         return [
//             'car' => $car,
//         ];
//     }
}

