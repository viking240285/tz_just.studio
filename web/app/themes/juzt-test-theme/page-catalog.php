<?php
/**
 * Template Name: Каталог
 */

// Обработка формы фильтрации
$selected_brand = isset($_GET['brand']) ? sanitize_text_field($_GET['brand']) : '';
$selected_year = isset($_GET['year']) ? intval($_GET['year']) : '';

?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <form method="get" action="<?php echo esc_url(home_url('/catalog')); ?>">
            <label for="brand">Бренд:</label>
            <select name="brand" id="brand">
                <option value="">Выберите бренд</option>
                <?php
                $brands = get_terms('car_brand');
                foreach ($brands as $brand) {
                    $selected = ($selected_brand == $brand->slug) ? 'selected' : '';
                    echo '<option value="' . esc_attr($brand->slug) . '" ' . $selected . '>' . esc_html($brand->name) . '</option>';
                }
                ?>
            </select>

            <label for="year">Год выпуска:</label>
            <input type="number" name="year" id="year" min="1900" max="<?php echo esc_attr(date('Y')); ?>" step="1" value="<?php echo esc_attr($selected_year); ?>">

            <input type="submit" value="Применить фильтр">
        </form>

        <?php
        // Обработка результатов фильтрации
        $args = array(
            'post_type' => 'car',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
            'tax_query' => array(),
            'meta_query' => array(),
        );

        if ($selected_brand) {
            $args['tax_query'][] = array(
                'taxonomy' => 'car_brand',
                'field' => 'slug',
                'terms' => $selected_brand,
            );
        }

        if ($selected_year) {
            $args['meta_query'][] = array(
                'key' => '_car_year',
                'value' => $selected_year,
                'compare' => '=',
            );
        }

        $cars = new WP_Query($args);

        if ($cars->have_posts()) {
            while ($cars->have_posts()) {
                $cars->the_post();
                $car_id = get_the_ID();
                $car_model = get_the_title();
                $car_year = get_post_meta($car_id, '_car_year', true);

                // Ссылка на страницу детального просмотра автомобиля с фильтром по модели
                echo '<a href="' . esc_url(add_query_arg('model', $car_model, get_permalink())) . '">' . esc_html($car_model) . '</a><br>';

                // Ссылка на страницу детального просмотра автомобиля с фильтром по году выпуска
                echo '<a href="' . esc_url(add_query_arg('year', $car_year, get_permalink())) . '">' . esc_html($car_year) . '</a><br>';

                // Выводите остальную информацию о каждом автомобиле
            }
            wp_reset_postdata();
        } else {
            echo 'Автомобили не найдены.';
        }
        ?>

    </main><!-- #main -->
</div><!-- #primary -->
