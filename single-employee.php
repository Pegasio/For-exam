<?php
/*
Template Name: Детальный просмотр сотрудника
*/

get_header();

if (have_posts()) {
    while (have_posts()) {
        the_post();

        // Получаем мета-данные элемента (сотрудника или услуги)
        $element_data = get_post_meta(get_the_ID(), '$employee->ID', true);

        // Получаем контент элемента
        $element_content = get_the_content();

        // Выводим заголовок элемента
        echo '<h1>' . get_the_title() . '</h1>';

        // Выводим мета-данные элемента
        echo '<p>' . $element_data . '</p>';

        // Выводим контент элемента
        echo '<div>' . $element_content . '</div>';
    }
}

get_footer();
?>
