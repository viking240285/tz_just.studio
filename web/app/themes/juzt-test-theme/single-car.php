<?php

$car_id = get_post_meta(get_the_ID(), '_car_id', true);
$car_model = get_the_title();
$car_brand = wp_get_post_terms(get_the_ID(), 'car_brand', array('fields' => 'names'))[0];
$year = get_post_meta(get_the_ID(), '_car_year', true);
$engine_type = get_post_meta(get_the_ID(), '_car_engine_type', true);
$transmission_type = get_post_meta(get_the_ID(), '_car_transmission_type', true);
$range = get_post_meta(get_the_ID(), '_car_range', true);

// Проверяем, если какие-либо значения не заполнены, заменяем их на прочерк
$car_brand = $car_brand ? $car_brand : '-';
$year = $year ? $year : '-';
$engine_type = $engine_type ? $engine_type : '-';
$transmission_type = $transmission_type ? $transmission_type : '-';
$range = $range ? $range . ' км' : '-';

?>

<div class="car-details">
    <h2>Модель: <?php echo esc_html($car_model); ?></h2>
    <p>Бренд: <?php echo esc_html($car_brand); ?></p>
    <p>Год выпуска: <?php echo esc_html($year); ?></p>
    <p>Тип двигателя: <?php echo esc_html($engine_type); ?></p>
    <p>Трансмиссия: <?php echo esc_html($transmission_type); ?></p>
    <p>Запас хода: <?php echo esc_html($range); ?></p>
</div>