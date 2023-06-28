<?php
/*
Template Name: Список сотрудников
*/
get_header();
// Получаем посты с типом "employee"
$args = array(
    'post_type' => 'employee',
    'posts_per_page' => -1, // Все сотрудники (можно задать нужное количество)
);

$employees = get_posts($args);
echo '<div style="margin-left: 8%; margin-right: 8%;">';
// Цикл для отображения сотрудников
foreach ($employees as $employee) {
    $employee_name = $employee->post_title;
    $employee_description = $employee->post_content;
    $employee_permalink = get_permalink($employee->ID); // Получаем ссылку на страницу с детальной информацией

    // Вывод информации о сотруднике с использованием классов Bootstrap
    echo '<div class="card">';
    echo '<div class="card-body">';
    // Создаем ссылку на страницу с детальной информацией
    echo '<h2 class="card-title"><a href="' . $employee_permalink . '">' . $employee_name . '</a></h2>';
    echo '<p class="card-text">' . $employee_description . '</p>';
    echo '</div>';
    echo '</div>';
}
echo '</div>';
get_footer();
?>
