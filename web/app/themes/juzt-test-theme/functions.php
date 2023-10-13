<?php

// namespace App;

// use App\Controllers\CarController;

// function prefix_register_my_rest_routes() {
//     new CarController(); // Создаем объект контроллера, что автоматически вызовет метод register_routes()
// }

// add_action( 'rest_api_init', 'prefix_register_my_rest_routes' );

// Создаем кастомную таблицу при активации темы или плагина
function create_cars_properties_table() {
// function create_cars_properties_table() {
    error_log('Trying to create cars properties table.'); 
    global $wpdb;
    $table_name = $wpdb->prefix . 'cars_properties';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        -- id mediumint(9) NOT NULL AUTO_INCREMENT,
        post_id mediumint(9) NOT NULL,
        car_model varchar(255) NOT NULL,
        car_brand varchar(255) NOT NULL,
        image varchar(255) NOT NULL,
        year mediumint(4) NOT NULL,
        engine_type varchar(255) NOT NULL,
        transmission_type varchar(255) NOT NULL,
        range_km mediumint(5),
        PRIMARY KEY  (post_id),
        INDEX post_id (post_id),
        INDEX car_brand (car_brand),
        INDEX year (year)
    ) $charset_collate;";


    require_once ABSPATH . '/wp-admin/includes/upgrade.php';
    dbDelta($sql);
}

// add_action('admin_init', 'create_cars_properties_table');
// add_action('after_switch_theme', 'create_cars_properties_table');

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


// function save_car_properties($post_id) {
//     if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
//         return $post_id;

//     $post_status = get_post_status($post_id);

//     if ($post_status === 'publish') {
//         $post = get_post($post_id);

//         if ($post->post_type == 'car') {
//             $car_model = get_the_title($post_id);
//             $car_brand_terms = wp_get_post_terms($post_id, 'car_brand');
//             $car_brand = !empty($car_brand_terms) ? $car_brand_terms[0]->name : '';
//             $image = get_the_post_thumbnail_url($post_id);
//             $year = get_post_meta($post_id, '_car_year', true);
//             $engine_type = get_post_meta($post_id, '_car_engine_type', true);
//             $transmission_type = get_post_meta($post_id, '_car_transmission_type', true);
//             $range_km = get_post_meta($post_id, '_car_range', true);

//             global $wpdb;
//             $table_name = $wpdb->prefix . 'cars_properties';
//             $wpdb->replace(
//                 $table_name,
//                 array(
//                     'post_id'           => $post_id,
//                     'car_model'         => $car_model,
//                     'car_brand'         => $car_brand,
//                     'image'             => $image,
//                     'year'              => $year,
//                     'engine_type'       => $engine_type,
//                     'transmission_type' => $transmission_type,
//                     'range_km'          => $range_km
//                 ),
//                 array(
//                     '%d',
//                     '%s',
//                     '%s',
//                     '%s',
//                     '%d',
//                     '%s',
//                     '%s',
//                     '%d'
//                 )
//             );
//         }
//     }
// }
// add_action('save_post', 'save_car_properties');

// function save_acf_fields_to_custom_table($post_id) {
//     // Проверяем, является ли пост автомобилем (типом 'car')
//     if (get_post_type($post_id) !== 'car') {
//         return;
//     }

//     // Получаем значения полей ACF
//     $engine_type = get_field('engine_type', $post_id);
//     $transmission_type = get_field('transmission_type', $post_id);
//     $year = get_field('year', $post_id);
//     $range_km = get_field('range_km', $post_id);
//     $image_id = get_field('image', $post_id); // Получаем ID изображения из поля ACF
//     // $image_url = wp_get_attachment_url($image_id); // Получаем URL изображения
//     $image_url = $image_id['url'];
//     // $image = get_the_post_thumbnail_url($post_id);
    
    
//     // Получаем значение поля 'car_brand' из терминов таксономии 'car_brand'
//     $terms = wp_get_post_terms($post_id, 'car_brand');
//     $car_brand = !empty($terms) ? $terms[0]->name : '';
    
//     // Получаем значение поля 'car_model' из заголовка поста
//     $car_model = get_the_title($post_id);

//     // Подключаемся к базе данных
//     global $wpdb;
//     $table_name = $wpdb->prefix . 'cars_properties';

//     // Подготавливаем данные для вставки в кастомную таблицу
//     $data = array(
//         'post_id'           => $post_id,
//         'car_brand'         => $car_brand,
//         'car_model'         => $car_model,
//         'image'             => $image_url,
//         'year'              => $year,
//         'engine_type'       => $engine_type,
//         'transmission_type' => $transmission_type,
//         'range_km'          => $range_km,
//     );
    
//     $wpdb->replace($table_name, $data, array('%d', '%s', '%s', '%s', '%d', '%s', '%s', '%d'));
// }

// // Подключаем функцию к хуку ACF
// add_action('acf/save_post', 'save_acf_fields_to_custom_table', 20);

function save_acf_fields_to_custom_table($post_id) {
    // Проверяем, является ли пост автомобилем (типом 'car')
    if (get_post_type($post_id) !== 'car') {
        return;
    }

    // Получаем значения полей ACF
    $engine_type = get_field('engine_type', $post_id) ?: '';
    $transmission_type = get_field('transmission_type', $post_id) ?: '';
    $year = get_field('year', $post_id) ?: '';
    $range_km = get_field('range_km', $post_id) ?: '';
    $image_id = get_field('image', $post_id);
    
    // Получаем URL изображения
    $image_url = '';
    if ($image_id) {
        $image_url = $image_id['url'];
    }

    // Получаем значение поля 'car_brand' из терминов таксономии 'car_brand'
    $terms = wp_get_post_terms($post_id, 'car_brand');
    $car_brand = !empty($terms) ? $terms[0]->name : '';
    
    // Получаем значение поля 'car_model' из заголовка поста
    $car_model = get_the_title($post_id) ?: '';

    // Подключаемся к базе данных
    global $wpdb;
    $table_name = $wpdb->prefix . 'cars_properties';

    // Подготавливаем данные для вставки в кастомную таблицу
    $data = array(
        'post_id'           => $post_id,
        'car_brand'         => $car_brand,
        'car_model'         => $car_model,
        'image'             => $image_url,
        'year'              => $year,
        'engine_type'       => $engine_type,
        'transmission_type' => $transmission_type,
        'range_km'          => $range_km,
    );

    // Используем транзакции для обеспечения целостности данных
    $wpdb->query('START TRANSACTION');
    
    // Выполняем вставку данных в кастомную таблицу
    $wpdb->replace($table_name, $data, array('%d', '%s', '%s', '%s', '%d', '%s', '%s', '%d'));
    
    // Если не произошло ошибок, коммитим транзакцию
    $wpdb->query('COMMIT');
}

// Подключаем функцию к хуку ACF
add_action('acf/save_post', 'save_acf_fields_to_custom_table', 20);




// ACF
add_action( 'acf/include_fields', function() {
        if ( ! function_exists( 'acf_add_local_field_group' ) ) {
            return;
        }

        acf_add_local_field_group( array(
        'key' => 'group_652858a265031',
        'title' => 'Автомобиль',
        'fields' => array(
            array(
                'key' => 'field_65285b0bd8871',
                'label' => 'Тип двигателя',
                'name' => 'engine_type',
                'aria-label' => '',
                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'Бензиновый' => 'Бензиновый',
                    'Дизельный' => 'Дизельный',
                    'Электрический' => 'Электрический',
                ),
                'default_value' => 'Бензиновый',
                'return_format' => 'value',
                'multiple' => 0,
                'allow_null' => 0,
                'ui' => 0,
                'ajax' => 0,
                'placeholder' => '',
            ),
            array(
                'key' => 'field_652858a2c7417',
                'label' => 'Трансмиссия',
                'name' => 'transmission_type',
                'aria-label' => '',
                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_65285b0bd8871',
                            'operator' => '==contains',
                            'value' => 'Бензиновый',
                        ),
                    ),
                    array(
                        array(
                            'field' => 'field_65285b0bd8871',
                            'operator' => '==',
                            'value' => 'Дизельный',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'Автоматическая' => 'Автоматическая',
                    'Ручная' => 'Ручная',
                    'Роботизированная' => 'Роботизированная',
                ),
                'default_value' => 'Ручная',
                'return_format' => 'value',
                'multiple' => 0,
                'allow_null' => 0,
                'ui' => 0,
                'ajax' => 0,
                'placeholder' => '',
            ),
            array(
                'key' => 'field_6528ea95ff79b',
                'label' => 'Год выпуска',
                'name' => 'year',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'maxlength' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_6528ead69e8ac',
                'label' => 'Запас хода (км)',
                'name' => 'range_km',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_65285b0bd8871',
                            'operator' => '==',
                            'value' => 'Электрический',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'maxlength' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_6528ead69e8ac',
                'label' => 'Изображение',
                'name' => 'image',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'car',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => 'djes-rest-api',
        'show_in_rest' => 1,
    ) );
} );











/*
// Create Metaboxes
function add_car_metaboxes() {
    add_meta_box('car_year', 'Год выпуска', 'car_year_callback', 'car', 'side');
    add_meta_box('engine_type', 'Тип двигателя', 'engine_type_callback', 'car', 'side');
    add_meta_box('transmission', 'Трансмиссия', 'transmission_callback', 'car', 'side');
    add_meta_box('range_km', 'Запас хода (км)', 'range_km_callback', 'car', 'side');
}

function car_year_callback($post) {
    $year = get_post_meta($post->ID, '_car_year', true);
    echo '<input type="text" name="car_year" value="' . esc_attr($year) . '" />';
}

function engine_type_callback($post) {
    $engine_type = get_post_meta($post->ID, '_car_engine_type', true);
    echo '<input type="text" name="car_engine_type" value="' . esc_attr($engine_type) . '" />';
}

function transmission_callback($post) {
    $transmission = get_post_meta($post->ID, '_car_transmission_type', true);
    echo '<input type="text" name="car_transmission_type" value="' . esc_attr($transmission) . '" />';
}

function range_km_callback($post) {
    $range_km = get_post_meta($post->ID, '_car_range', true);
    echo '<input type="text" name="car_range" value="' . esc_attr($range_km) . '" />';
}

add_action('add_meta_boxes', 'add_car_metaboxes');

function save_car_metaboxes($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;

    $fields = array('car_year', 'car_engine_type', 'car_transmission_type', 'car_range');

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $value = sanitize_text_field($_POST[$field]);
            update_post_meta($post_id, '_' . $field, $value);

            // Сохраняем значения в таблицу wp_cars_properties
            global $wpdb;
            $table_name = $wpdb->prefix . 'cars_properties';

            // Определяем, в какой столбец в таблице нужно сохранить значение
            switch ($field) {
                case 'car_year':
                    $column_name = 'year';
                    break;
                case 'car_engine_type':
                    $column_name = 'engine_type';
                    break;
                case 'car_transmission_type':
                    $column_name = 'transmission_type';
                    break;
                case 'car_range':
                    $column_name = 'range_km';
                    break;
            }

            // Сохраняем значение в таблицу
            $wpdb->update(
                $table_name,
                array($column_name => $value),
                array('post_id' => $post_id),
                array('%s'),
                array('%d')
            );
        }
    }
}

add_action('save_post_car', 'save_car_metaboxes');
*/







