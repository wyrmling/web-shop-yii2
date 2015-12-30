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
        ]);
        
        $this->insert('{{product_categories_list}}', [
            'category_id' => 1,
            'parent_category_id' => 0,
            'name' => 'category_1',
        ]);
        
        $this->insert('{{product_categories_list}}', [
            'category_id' => 2,
            'parent_category_id' => 0,
            'name' => 'category_2',
        ]);
        
        $this->insert('{{product_categories_list}}', [
            'category_id' => 3,
            'parent_category_id' => 0,
            'name' => 'category_3',
        ]);
        
        $this->insert('{{product_categories_list}}', [
            'category_id' => 4,
            'parent_category_id' => 0,
            'name' => 'category_4',
        ]);
        
        $this->insert('{{product_categories_list}}', [
            'category_id' => 5,
            'parent_category_id' => 1,
            'name' => 'category_1_1',
        ]);
        
        $this->insert('{{product_categories_list}}', [
            'category_id' => 6,
            'parent_category_id' => 5,
            'name' => 'category_1_1_1',
        ]);
        
        $this->insert('{{product_categories_list}}', [
            'category_id' => 7,
            'parent_category_id' => 1,
            'name' => 'category_1_2',
        ]);
        
        $this->insert('{{product_categories_list}}', [
            'category_id' => 8,
            'parent_category_id' => 7,
            'name' => 'category_1_2_1',
        ]);
        
        $this->insert('{{product_categories_list}}', [
            'category_id' => 9,
            'parent_category_id' => 2,
            'name' => 'category_2_1',
        ]);
        
        $this->insert('{{product_categories_list}}', [
            'category_id' => 10,
            'parent_category_id' => 2,
            'name' => 'category_2_2',
        ]);
        
        $this->insert('{{product_categories_list}}', [
            'category_id' => 11,
            'parent_category_id' => 3,
            'name' => 'category_3_1',
        ]);
        
        $this->insert('{{product_categories_list}}', [
            'category_id' => 12,
            'parent_category_id' => 11,
            'name' => 'category_3_1_1',
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{product_categories_list}}', true) !== null) {
            $this->dropTable('{{product_categories_list}}');
        }
    }

}
