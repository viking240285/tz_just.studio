<?php
// Создаем кастомную таблицу при активации темы или плагина
function create_cars_properties_table() {
// function create_cars_properties_table() {
    error_log('Trying to create cars properties table.'); 
    global $wpdb;
    $table_name = $wpdb->prefix . 'cars_properties';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        post_id mediumint(9) NOT NULL,
        car_model varchar(255) NOT NULL,
        car_brand varchar(255) NOT NULL,
        image varchar(255) NOT NULL,
        year mediumint(4) NOT NULL,
        engine_type varchar(255) NOT NULL,
        transmission_type varchar(255) NOT NULL,
        range_km mediumint(5),
        PRIMARY KEY  (id),
        INDEX post_id (post_id),
        INDEX car_brand (car_brand),
        INDEX year (year)
    ) $charset_collate;";


    require_once ABSPATH . '/wp-admin/includes/upgrade.php';
    dbDelta($sql);
}

// add_action('admin_init', 'create_cars_properties_table');
add_action('after_switch_theme', 'create_cars_properties_table');

// Скрыть пункт "Комментарии" в админ-панели
function remove_comments_menu() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'remove_comments_menu');

// Скрыть пункт "Медиафайлы" в админ-панели
function remove_media_menu() {
    remove_menu_page('upload.php');
}
add_action('admin_menu', 'remove_media_menu');

// Скрыть пункт "Записи" в админ-панели
function remove_posts_menu() {
    remove_menu_page('edit.php');
}
add_action('admin_menu', 'remove_posts_menu');


// Создаем кастомный тип записей "Каталог автомобилей"
function register_car_post_type() {
    $labels = array(
        'name'               => 'Каталог автомобилей',
        'singular_name'      => 'Автомобиль',
        'menu_name'          => 'Каталог автомобилей',
        'add_new'            => 'Добавить автомобиль',
        'add_new_item'       => 'Добавить новый автомобиль',
        'edit_item'          => 'Редактировать автомобиль',
        'new_item'           => 'Новый автомобиль',
        'view_item'          => 'Просмотреть автомобиль',
        'search_items'       => 'Найти автомобиль',
        'not_found'          => 'Автомобили не найдены',
        'not_found_in_trash' => 'В корзине автомобилей не найдено'
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'publicly_queryable'  => true,
        'query_var'           => true,
        'rewrite'             => true,
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'supports'            => array('title', 'editor', 'thumbnail'),
        'taxonomies'          => array('car_brand'),  // Связываем с кастомной таксономией
    );

    register_post_type('car', $args);
}
add_action('init', 'register_car_post_type');

// Создаем кастомную таксономию для брендов автомобилей
function register_car_brand_taxonomy() {
    $labels = array(
        'name'              => 'Бренды',
        'singular_name'     => 'Бренд',
        'search_items'      => 'Найти бренд',
        'all_items'         => 'Все бренды',
        'parent_item'       => 'Родительский бренд',
        'parent_item_colon' => 'Родительский бренд:',
        'edit_item'         => 'Редактировать бренд',
        'update_item'       => 'Обновить бренд',
        'add_new_item'      => 'Добавить новый бренд',
        'new_item_name'     => 'Новый бренд',
        'menu_name'         => 'Бренды',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'car_brand'),
    );

    register_taxonomy('car_brand', 'car', $args);
}
add_action('init', 'register_car_brand_taxonomy');


function save_car_properties($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
        return $post_id;

    $post = get_post($post_id);

    if ($post->post_type == 'car') {
        $car_model = get_the_title($post_id);
        $car_brand_terms = wp_get_post_terms($post_id, 'car_brand');
        $car_brand = !empty($car_brand_terms) ? $car_brand_terms[0]->name : '';
        $image = get_the_post_thumbnail_url($post_id);
        $year = get_post_meta($post_id, '_car_year', true);
        $engine_type = get_post_meta($post_id, '_car_engine_type', true);
        $transmission_type = get_post_meta($post_id, '_car_transmission_type', true);
        $range_km = get_post_meta($post_id, '_car_range', true);

        global $wpdb;
        $table_name = $wpdb->prefix . 'cars_properties';
        $wpdb->replace(
            $table_name,
            array(
                'post_id'           => $post_id,
                'car_model'         => $car_model,
                'car_brand'         => $car_brand,
                'image'             => $image,
                'year'              => $year,
                'engine_type'       => $engine_type,
                'transmission_type' => $transmission_type,
                'range_km'             => $range_km
            )
        );
    }
}
add_action('save_post', 'save_car_properties');





