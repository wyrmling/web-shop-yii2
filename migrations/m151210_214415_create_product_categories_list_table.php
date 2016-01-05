<?php

use yii\db\Schema;
use yii\db\Migration;

class m151210_214415_create_product_categories_list_table extends Migration
{

    // Таблица "Список категорий товаров"
    // ID категории - первичный ключ integer
    // ID родительской категории - integer notNull (если категория наивысшего уровня, тогда ID = 0)
    // Название категории - varchar 255 notNull
    public function up()
    {
        $this->createTable('{{product_categories_list}}', [
            'category_id' => $this->primaryKey(),
            'parent_category_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'discount' => $this->integer(),
        ]);

        $this->insert('{{product_categories_list}}', [
            'category_id' => 1,
            'parent_category_id' => 0,
            'name' => '1_Комплектующие',
        ]);
        $this->insert('{{product_categories_list}}', [
            'category_id' => 5,
            'parent_category_id' => 1,
            'name' => '1_1_Процессоры',
        ]);
        $this->insert('{{product_categories_list}}', [
            'category_id' => 6,
            'parent_category_id' => 5,
            'name' => '1_1_1_AMD',
        ]);
        $this->insert('{{product_categories_list}}', [
            'category_id' => 14,
            'parent_category_id' => 5,
            'name' => '1_1_2_Intel',
        ]);
        $this->insert('{{product_categories_list}}', [
            'category_id' => 7,
            'parent_category_id' => 1,
            'name' => '1_2_Видеокарты',
        ]);
        $this->insert('{{product_categories_list}}', [
            'category_id' => 13,
            'parent_category_id' => 7,
            'name' => '1_2_1_AMD',
        ]);
        $this->insert('{{product_categories_list}}', [
            'category_id' => 8,
            'parent_category_id' => 7,
            'name' => '1_2_2_Nvidia',
        ]);

        $this->insert('{{product_categories_list}}', [
            'category_id' => 2,
            'parent_category_id' => 0,
            'name' => '2_Бытовая техника',
        ]);
        $this->insert('{{product_categories_list}}', [
            'category_id' => 9,
            'parent_category_id' => 2,
            'name' => '2_1_Пылесосы',
        ]);
        $this->insert('{{product_categories_list}}', [
            'category_id' => 10,
            'parent_category_id' => 2,
            'name' => '2_2_Чайники',
        ]);

        $this->insert('{{product_categories_list}}', [
            'category_id' => 3,
            'parent_category_id' => 0,
            'name' => '3_Телефоны',
        ]);
        $this->insert('{{product_categories_list}}', [
            'category_id' => 11,
            'parent_category_id' => 3,
            'name' => '3_1_Смартфоны',
        ]);
        $this->insert('{{product_categories_list}}', [
            'category_id' => 12,
            'parent_category_id' => 11,
            'name' => '3_1_1_Android',
        ]);

        $this->insert('{{product_categories_list}}', [
            'category_id' => 4,
            'parent_category_id' => 0,
            'name' => '4_Ёлочные игрушки',
        ]);

    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{product_categories_list}}', true) !== null) {
            $this->dropTable('{{product_categories_list}}');
        }
    }

}
