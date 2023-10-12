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


// ACF
function create_acf_field_groups() {
    if (function_exists('acf_add_local_field_group')) {

        // Год выпуска
        acf_add_local_field_group(array(
            'key' => 'group_5f9f883ac005b',
            'title' => 'Год выпуска',
            'fields' => array(
                array(
                    'key' => 'field_5f9f8841e6b34',
                    'label' => 'Год выпуска',
                    'name' => 'car_year',
                    'type' => 'number',
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
        ));

        // Тип двигателя
        acf_add_local_field_group(array(
            'key' => 'group_5f9f884de6b35',
            'title' => 'Тип двигателя',
            'fields' => array(
                array(
                    'key' => 'field_5f9f8856e6b36',
                    'label' => 'Тип двигателя',
                    'name' => 'engine_type',
                    'type' => 'select',
                    'choices' => array(
                        'Бензиновый' => 'Бензиновый',
                        'Дизельный' => 'Дизельный',
                        'Электрический' => 'Электрический',
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
        ));

        // Трансмиссия (будет показано только при выборе Бензинового или Дизельного двигателя)
        acf_add_local_field_group(array(
            'key' => 'group_5f9f886ae6b37',
            'title' => 'Трансмиссия',
            'fields' => array(
                array(
                    'key' => 'field_5f9f8873e6b38',
                    'label' => 'Трансмиссия',
                    'name' => 'transmission_type',
                    'type' => 'select',
                    'choices' => array(
                        'Автоматическая' => 'Автоматическая',
                        'Ручная' => 'Ручная',
                        'Роботизированная' => 'Роботизированная',
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
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_5f9f8856e6b36', // Поле "Тип двигателя"
                        'operator' => '==',
                        'value' => 'Бензиновый', // Покажет поле "Трансмиссия" только если выбрано "Бензиновый"
                    ),
                    array(
                        'field' => 'field_5f9f8856e6b36', // Поле "Тип двигателя"
                        'operator' => '==',
                        'value' => 'Дизельный', // Покажет поле "Трансмиссия" только если выбрано "Дизельный"
                    ),
                ),
            ),
        ));

        // Запас хода в км (будет показано только при выборе Электрического двигателя)
        acf_add_local_field_group(array(
            'key' => 'group_5f9f8883e6b39',
            'title' => 'Запас хода',
            'fields' => array(
                array(
                    'key' => 'field_5f9f888ae6b3a',
                    'label' => 'Запас хода (км)',
                    'name' => 'range_km',
                    'type' => 'number',
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
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_5f9f8856e6b36', // Поле "Тип двигателя"
                        'operator' => '==',
                        'value' => 'Электрический', // Покажет поле "Запас хода" только если выбрано "Электрический"
                    ),
                ),
            ),
        ));
    }
}

add_action('acf/init', 'create_acf_field_groups');









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







