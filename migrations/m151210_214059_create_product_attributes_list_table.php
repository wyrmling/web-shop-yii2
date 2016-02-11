<?php

use yii\db\Schema;
use yii\db\Migration;

class m151210_214059_create_product_attributes_list_table extends Migration
{

    // Cвязующая таблица "Атрибуты-товары"
    // ID атрибута - integer notNull
    // ID товара - integer notNull
    // Значение атрибута (не путать с единицей измерения!) - varchar 255 notNull
    public function up()
    {
        $this->createTable('{{product_attributes_list}}', [
            'attribute_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'value' => $this->string(),
        ]);
        $this->addPrimaryKey('at_prod_key', '{{product_attributes_list}}', [
            'attribute_id', 'product_id',
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
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{product_attributes_list}}', true) !== null) {
            $this->dropTable('{{product_attributes_list}}');
        }
    }

}
