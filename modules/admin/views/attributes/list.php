<?php

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Атрибуты товаров', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Список атрибутов для категории '. $category->category_id . ' - "' . $category->name . '"';
