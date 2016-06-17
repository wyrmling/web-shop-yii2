<?php

use yii\db\Schema;
use yii\db\Migration;

class m160424_193437_filling_the_tables_with_test_data extends Migration
{

    // Тестовые данные для следующих таблиц:
    // "товары" (products)
    // "Бренды товаров" (product_brands)
    // "Атрибуты товаров" (product_attributes)
    // "Атрибуты-товары" (product_attributes_list)
    // "Атрибуты-категории" (product_attributes_categories)
    // "Список категорий товаров" (product_categories_list)
    // "Заказы" (orders)
    // Детали заказа" (order_details)
    public function up()
    {
        $this->truncateTable('{{products}}');
        $this->truncateTable('{{product_brands}}');
        $this->truncateTable('{{product_attributes}}');
        $this->truncateTable('{{product_attributes_list}}');
        $this->truncateTable('{{product_attributes_categories}}');
        $this->truncateTable('{{product_categories_list}}');
        $this->truncateTable('{{orders}}');
        $this->truncateTable('{{order_details}}');

        $this->insert('{{products}}', [
            'product_id' => 1,
            'brand_id' => 7,
            'category_id' => 14,
            'sku' => 'D&C 205-7',
            'article' => 'А654',
            'title' => 'Тапки',
            'description' => 'Непромокаемые и несносные',
            'status' => 1,
            'price' => '648,89',
            'special_price' => '149,89',
            'created_by' => '1'
        ]);
        $this->insert('{{products}}', [
            'product_id' => 2,
            'brand_id' => 1,
            'category_id' => 14,
            'sku' => 'ВЧ8765',
            'article' => 'А747',
            'title' => 'Насос',
            'description' => 'Качать-не перекачать',
            'status' => 1,
            'price' => '1400,99',
            'special_price' => '239,98',
            'created_by' => '1'
        ]);
        $this->insert('{{products}}', [
            'product_id' => 3,
            'brand_id' => 5,
            'category_id' => 14,
            'sku' => 'P502',
            'article' => 'А123',
            'title' => 'Коннектор',
            'description' => 'Коннектинг пиплов',
            'status' => 1,
            'price' => '55,89',
            'special_price' => '17,99',
            'created_by' => '1'
        ]);
        $this->insert('{{products}}', [
            'product_id' => 4,
            'brand_id' => 5,
            'category_id' => 14,
            'sku' => 'P507',
            'article' => 'А155',
            'title' => 'Сальник',
            'description' => 'Самый сальник в мире',
            'status' => 1,
            'price' => '73,89',
            'special_price' => '19,99',
            'created_by' => '1'
        ]);
        $this->insert('{{products}}', [
            'product_id' => 5,
            'brand_id' => 1,
            'category_id' => 8,
            'sku' => 'P507',
            'article' => 'А155',
            'title' => 'Мыльница из эко-стекла',
            'description' => 'Прозрачная в ассортименте',
            'status' => 0,
            'price' => '772,89',
            'special_price' => '143,99',
            'created_by' => '1'
        ]);

        $this->insert('{{product_brands}}', [
            'brand_id' => 1,
            'brand_name' => 'Сунь-Хунь-В-Чай',
            'discount' => 87,
        ]);
        $this->insert('{{product_brands}}', [
            'brand_id' => 2,
            'brand_name' => 'Reebosch',
            //'discount' => 0,
        ]);
        $this->insert('{{product_brands}}', [
            'brand_id' => 5,
            'brand_name' => 'Pear',
            'discount' => 12,
        ]);
        $this->insert('{{product_brands}}', [
            'brand_id' => 7,
            'brand_name' => 'Dolce & Kaballach',
            'discount' => 5,
        ]);
        $this->insert('{{product_brands}}', [
            'brand_id' => 12,
            'brand_name' => 'Nenovo',
            'discount' => 49,
        ]);
        $this->insert('{{product_brands}}', [
            'brand_id' => 17,
            'brand_name' => 'United Colors of Balakleya',
            'discount' => 49,
        ]);

        $this->insert('{{product_attributes}}', [
            'attribute_id' => 1,
            'attribute_name' => 'масса',
            'unit' => 'кг',
        ]);
        $this->insert('{{product_attributes}}', [
            'attribute_id' => 2,
            'attribute_name' => 'диагональ',
            'unit' => 'см',
        ]);
        $this->insert('{{product_attributes}}', [
            'attribute_id' => 3,
            'attribute_name' => 'объем памяти',
            'unit' => 'Гб',
        ]);
        $this->insert('{{product_attributes}}', [
            'attribute_id' => 4,
            'attribute_name' => 'объем',
            'unit' => 'л',
        ]);
        $this->insert('{{product_attributes}}', [
            'attribute_id' => 5,
            'attribute_name' => 'цвет',
            'unit' => '--',
        ]);
        $this->insert('{{product_attributes}}', [
            'attribute_id' => 6,
            'attribute_name' => 'материал корпуса',
            'unit' => '--',
        ]);
        $this->insert('{{product_attributes_list}}', [
            'attribute_id' => 1,
            'product_id' => 1,
            'value' => '0,2',
        ]);
        $this->insert('{{product_attributes_list}}', [
            'attribute_id' => 1,
            'product_id' => 2,
            'value' => '9',
        ]);
        $this->insert('{{product_attributes_list}}', [
            'attribute_id' => 1,
            'product_id' => 3,
            'value' => '0,01',
        ]);
        $this->insert('{{product_attributes_list}}', [
            'attribute_id' => 1,
            'product_id' => 4,
            'value' => '0,3',
        ]);
        $this->insert('{{product_attributes_list}}', [
            'attribute_id' => 2,
            'product_id' => 1,
            'value' => '27',
        ]);
        $this->insert('{{product_attributes_list}}', [
            'attribute_id' => 2,
            'product_id' => 2,
            'value' => '15',
        ]);
        $this->insert('{{product_attributes_list}}', [
            'attribute_id' => 2,
            'product_id' => 3,
            'value' => 'отсутствует',
        ]);
        $this->insert('{{product_attributes_list}}', [
            'attribute_id' => 2,
            'product_id' => 4,
            'value' => 'любая',
        ]);
        $this->insert('{{product_attributes_list}}', [
            'attribute_id' => 3,
            'product_id' => 1,
            'value' => 'безграничный',
        ]);
        $this->insert('{{product_attributes_list}}', [
            'attribute_id' => 3,
            'product_id' => 2,
            'value' => 'глубинный',
        ]);
        $this->insert('{{product_attributes_list}}', [
            'attribute_id' => 3,
            'product_id' => 3,
            'value' => '1000',
        ]);
        $this->insert('{{product_attributes_list}}', [
            'attribute_id' => 3,
            'product_id' => 4,
            'value' => 'жирный',
        ]);
        $this->insert('{{product_attributes_list}}', [
            'attribute_id' => 4,
            'product_id' => 5,
            'value' => '0,2',
        ]);

        $this->insert('{{product_attributes_categories}}', [
            'attribute_id' => 1,
            'category_id' => 14,
            'order' => 3,
        ]);
        $this->insert('{{product_attributes_categories}}', [
            'attribute_id' => 2,
            'category_id' => 14,
            'order' => 2,
        ]);
        $this->insert('{{product_attributes_categories}}', [
            'attribute_id' => 3,
            'category_id' => 14,
            'order' => 1,
        ]);
        $this->insert('{{product_attributes_categories}}', [
            'attribute_id' => 4,
            'category_id' => 8,
            'order' => 1,
        ]);

        $this->insert('{{product_categories_list}}', [
            'category_id' => 1,
            'parent_category_id' => 0,
            'name' => 'Малогабаритная мебель',
            'quantity_invisible' => 1,
        ]);
        $this->insert('{{product_categories_list}}', [
            'category_id' => 2,
            'parent_category_id' => 0,
            'name' => 'Для дома Для семьи',
        ]);
        $this->insert('{{product_categories_list}}', [
            'category_id' => 3,
            'parent_category_id' => 0,
            'name' => 'Недетские игрушки',
        ]);
        $this->insert('{{product_categories_list}}', [
            'category_id' => 4,
            'parent_category_id' => 0,
            'name' => 'Разное',
            'quantity_visible' => 4,
        ]);
        $this->insert('{{product_categories_list}}', [
            'category_id' => 8,
            'parent_category_id' => 1,
            'name' => 'Мыльницы',
            'quantity_invisible' => 1,
        ]);
        $this->insert('{{product_categories_list}}', [
            'category_id' => 12,
            'parent_category_id' => 1,
            'name' => 'Вафельницы',
        ]);
        $this->insert('{{product_categories_list}}', [
            'category_id' => 13,
            'parent_category_id' => 1,
            'name' => 'Пепельницы',
        ]);

        $this->insert('{{product_categories_list}}', [
            'category_id' => 5,
            'parent_category_id' => 2,
            'name' => 'Электродыроколы и пневмостеплеры',
        ]);
        $this->insert('{{product_categories_list}}', [
            'category_id' => 6,
            'parent_category_id' => 2,
            'name' => 'Сербско-монгольские словари',
        ]);
        $this->insert('{{product_categories_list}}', [
            'category_id' => 7,
            'parent_category_id' => 2,
            'name' => 'Клизмы',
        ]);

        $this->insert('{{product_categories_list}}', [
            'category_id' => 9,
            'parent_category_id' => 3,
            'name' => 'Надувные шарфики',
        ]);
        $this->insert('{{product_categories_list}}', [
            'category_id' => 10,
            'parent_category_id' => 3,
            'name' => 'Дверные виброзвонки',
        ]);
        $this->insert('{{product_categories_list}}', [
            'category_id' => 11,
            'parent_category_id' => 3,
            'name' => 'Пароиммитаторы',
        ]);

        $this->insert('{{product_categories_list}}', [
            'category_id' => 14,
            'parent_category_id' => 4,
            'name' => 'Всякое',
            'quantity_visible' => 4,
        ]);

        $this->insert('{{product_categories_list}}', [
            'category_id' => 15,
            'parent_category_id' => 14,
            'name' => 'Кое-что еще',
        ]);

        $this->insert('{{product_categories_list}}', [
            'category_id' => 16,
            'parent_category_id' => 15,
            'name' => 'Не понятно что',
        ]);

        $this->insert('{{product_categories_list}}', [
            'category_id' => 17,
            'parent_category_id' => 4,
            'name' => 'Иное',
        ]);

        $this->insert('{{product_categories_list}}', [
            'category_id' => 18,
            'parent_category_id' => 4,
            'name' => 'Какое-то не такое',
        ]);

        $this->insert('{{orders}}', [
            'order_id' => 1,
            'entered_name' => 'Никонор Евлампиевич',
            'user_phone_number' => '+38 (111) 111-11-11',
            'status' => 0,
            'total_sum' => 275,
            'client_comment' => 'Хочу скидку 100%',
            'manager_comment' => 'Да, конечно',
        ]);

        $this->insert('{{order_details}}', [
            'order_id' => 1,
            'product_id' => 2,
            'quantity' => 1,
            'status' => 0,
            'price' => 239,
        ]);

        $this->insert('{{order_details}}', [
            'order_id' => 1,
            'product_id' => 3,
            'quantity' => 1,
            'status' => 0,
            'price' => 17,
        ]);

        $this->insert('{{order_details}}', [
            'order_id' => 1,
            'product_id' => 4,
            'quantity' => 1,
            'status' => 0,
            'price' => 19,
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{products}}', true) !== null) {
            $this->delete('{{products}}', ['product_id' => [1,2,3,4,5]]);
        }

        if ($this->db->schema->getTableSchema('{{product_brands}}', true) !== null) {
            $this->delete('{{product_brands}}', ['brand_id' => [1,2,5,7,12,17]]);
        }

        if ($this->db->schema->getTableSchema('{{product_attributes}}', true) !== null) {
            $this->delete('{{product_attributes}}', ['attribute_id' => [1,2,3,4,5,6]]);
        }

        if ($this->db->schema->getTableSchema('{{product_attributes_list}}', true) !== null) {
            $this->delete('{{product_attributes_list}}', ['attribute_id' => [1,2,3,4]]);
        }

        if ($this->db->schema->getTableSchema('{{product_attributes_categories}}', true) !== null) {
            $this->delete('{{product_attributes_categories}}', ['attribute_id' => [1,2,3,4]]);
        }

        if ($this->db->schema->getTableSchema('{{product_categories_list}}', true) !== null) {
            $this->delete('{{product_categories_list}}', ['category_id' => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]]);
        }

        if ($this->db->schema->getTableSchema('{{orders}}', true) !== null) {
            $this->delete('{{orders}}', ['order_id' => 1]);
        }

        if ($this->db->schema->getTableSchema('{{order_details}}', true) !== null) {
            $this->delete('{{order_details}}', ['order_id' => 1]);
        }
    }
}
