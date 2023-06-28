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
