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

<?
// Создаем дополнительные типы записей
function custom_post_types() {
    // Создаем тип записи для сотрудников
  register_post_type('employee', array(
      'labels' => array(
          'name' => 'Сотрудники',
          'singular_name' => 'Сотрудник'
      ),
      'public' => true,
      'has_archive' => true,
  ));

register_post_type('services', array(
   'labels' => array(
      'name' => 'Услуги',
      'singular_name' => 'Услуга'
),
   'public' => true,
   'has_archive' => true,
));
   
}

// Остальные типы создаются тем же образом
add_action('init', 'custom_post_types');

// Создаем таксономию для категорий сотрудников
function custom_taxonomy() {
    register_taxonomy(
        'employee_category',
        'employee',
        array(
            'label' => 'Категории сотрудников',
            'rewrite' => array('slug' => 'employee-category'),
            'hierarchical' => true,
        )
    );
}
add_action('init', 'custom_taxonomy');"