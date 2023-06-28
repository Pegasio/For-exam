<?php
/*
Template Name: Список сотрудников
*/
get_header();
// Получаем список категорий сотрудников
$categories = get_terms(array(
    'taxonomy' => 'employee_category',
    'hide_empty' => true,
));

// Проверяем, была ли выбрана категория
$selected_category = isset($_GET['category']) ? $_GET['category'] : '';

// Проверяем, выбрана ли опция "Все сотрудники"
$is_all_employees_selected = ($selected_category === '');

// Выводим выпадающий список
echo '<form style="margin-left:8%; margin-right:8%; float: right;" action="' . esc_url(get_permalink()) . '" method="GET">';
echo '<select name="category" onchange="this.form.submit()">';
echo '<option value="" ' . ($is_all_employees_selected ? 'selected' : '') . '>Все сотрудники</option>';

foreach ($categories as $category) {
    $option_value = esc_attr($category->slug);
    $option_label = esc_html($category->name);
    $selected = ($selected_category === $option_value) ? 'selected' : '';

    echo '<option value="' . $option_value . '" ' . $selected . '>' . $option_label . '</option>';
}

echo '</select>';
echo '</form>';

// Получаем посты с типом "employee" и выбранной категорией
$args = array(
    'post_type' => 'employee',
    'posts_per_page' => -1,
);

if (!$is_all_employees_selected) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'employee_category',
            'field' => 'slug',
            'terms' => $selected_category,
        ),
    );
}

$employees = get_posts($args);

// Выводим список сотрудников
echo '<div style="margin-left: 8%; margin-right: 8%;">';

foreach ($employees as $employee) {
    $employee_name = $employee->post_title;
    $employee_description = $employee->post_content;
    $employee_permalink = get_permalink($employee->ID);

    echo '<div class="card">';
    echo '<div class="card-body">';
    echo '<h2 class="card-title"><a href="' . $employee_permalink . '">' . $employee_name . '</a></h2>';
    echo '<p class="card-text">' . $employee_description . '</p>';
    echo '</div>';
    echo '</div>';
}

echo '</div>';


get_footer();
?>
