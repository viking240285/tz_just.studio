<?php
// app/View/Composers/Catalog.php
namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use Illuminate\Support\Facades\DB;

class CarCatalog extends Composer {
    protected static $views = ['page-catalog'];

    public function with() {
        global $wpdb;
        // $brand = request()->input('brand');
        // $year = request()->input('year');
        // $cars = $wpdb->get_results("SELECT car_brand, car_model, year FROM wp_cars_properties", OBJECT);
        $per_page = 1; // Количество записей на странице
        $current_page = max(1, get_query_var('paged'));

        $cars = $wpdb->get_results("SELECT car_brand, car_model, year FROM wp_cars_properties LIMIT " . (($current_page - 1) * $per_page) . ", $per_page", OBJECT);

        $total_cars = $wpdb->get_var("SELECT COUNT(*) FROM wp_cars_properties");

        return [
            'cars' => $cars,
            'pagination' => paginate_links(array(
                'total' => ceil($total_cars / $per_page),
                'current' => $current_page,
                'type' => 'array',
            )),
        ];

        // foreach ($cars as $car) {
        //     echo $car->car_brand; // Выведет значение поля car_brand для текущей строки
        //     echo $car->car_model; // Выведет значение поля car_model для текущей строки
        //     echo $car->year;      // Выведет значение поля year для текущей строки
        // }
        // dd('exit');

        // if ($brand) {
        //     $query->where('car_brand', $brand);
        // }

        // if ($year) {
        //     $query->where('year', $year);
        // }

        // $cars = $query->paginate(10);

        // return [
        //     'cars' => $cars,
        // ];
    }
}
