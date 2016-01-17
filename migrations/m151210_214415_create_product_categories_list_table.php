<?php

use yii\db\Schema;
use yii\db\Migration;

class m151210_214415_create_product_categories_list_table extends Migration
{

    // Таблица "Список категорий товаров"
    // ID категории - первичный ключ integer
    // ID родительской категории - integer notNull (если категория наивысшего уровня, тогда ID = 0)
    // Название категории - varchar 255 notNull
    // Скидка на бренд (%) - integer
    // Количество видимых (выставленных на продажу товаров) - integer
    // Количество невидимых (не выставленных на продажу товаров) - integer 
    public function up()
    {
        $this->createTable('{{product_categories_list}}', [
            'category_id' => $this->primaryKey(),
            'parent_category_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'discount' => $this->integer(),
            'quantity_visible' => $this->integer(),
            'quantity_invisible' => $this->integer(),
        ]);

        $this->insert('{{product_categories_list}}', [
            'category_id' => 1,
            'parent_category_id' => 0,
            'name' => 'Малогабаритная мебель',
        ]);
        $this->insert('{{product_categories_list}}', [
            'category_id' => 2,
            'parent_category_id' => 0,
            'name' => 'Для дома Для семьи',
            'quantity_invisible' => 1,
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
            'quantity_visible' => 1,
        ]);
        $this->insert('{{product_categories_list}}', [
            'category_id' => 8,
            'parent_category_id' => 1,
            'name' => 'Мыльницы',
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
            'quantity_invisible' => 1,
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
            'quantity_visible' => 1,
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
            'quantity_visible' => 1,
        ]);

        $this->insert('{{product_categories_list}}', [
            'category_id' => 18,
            'parent_category_id' => 4,
            'name' => 'Какое-то не такое',
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{product_categories_list}}', true) !== null) {
            $this->dropTable('{{product_categories_list}}');
        }
    }

}
