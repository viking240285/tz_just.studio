<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

if (! file_exists($composer = __DIR__.'/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'sage'));
}

require $composer;

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

if (! function_exists('\Roots\bootloader')) {
    wp_die(
        __('You need to install Acorn to use this theme.', 'sage'),
        '',
        [
            'link_url' => 'https://roots.io/acorn/docs/installation/',
            'link_text' => __('Acorn Docs: Installation', 'sage'),
        ]
    );
}

\Roots\bootloader()->boot();

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['setup', 'filters'])
    ->each(function ($file) {
        if (! locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });



// Создаем кастомную таблицу при активации темы или плагина
function create_cars_properties_table() {
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
        'taxonomies'          => array('car_brand'),
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


function save_acf_fields_to_custom_table($post_id) {
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
    $car_model = get_the_title($post_id) ?: '';

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

    try {
        $wpdb->query('START TRANSACTION');
        $wpdb->replace($table_name, $data, array('%d', '%s', '%s', '%s', '%d', '%s', '%s', '%d'));
        $wpdb->query('COMMIT');
    } catch (Exception $e) {
        $wpdb->query('ROLLBACK'); // Откат изменений
    }
}

// Подключаем функцию к хуку ACF
add_action('acf/save_post', 'save_acf_fields_to_custom_table', 20);


function delete_custom_table_row_on_post_delete($post_id) {

    if (get_post_type($post_id) !== 'car') {
        return;
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'cars_properties';

    $wpdb->delete($table_name, array('post_id' => $post_id), array('%d'));
}

// Подключаем функцию к хуку удаления поста
add_action('wp_trash_post', 'delete_custom_table_row_on_post_delete');
// add_action('before_delete_post', 'delete_custom_table_row_on_post_delete');


// ACF
add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_652858a265031',
	'title' => 'car',
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
			'key' => 'field_652d6e15815ce',
			'label' => 'Изображение',
			'name' => 'image',
			'aria-label' => '',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
			'preview_size' => 'medium',
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

if (!function_exists('redirect_home_to_catalog')) {
    function redirect_home_to_catalog() {
        if (is_front_page()) {
            wp_safe_redirect(home_url('/catalog'));
            exit;
        }
    }
}

add_action('template_redirect', 'redirect_home_to_catalog');
