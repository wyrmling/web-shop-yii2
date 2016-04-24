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
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{product_attributes_list}}', true) !== null) {
            $this->dropTable('{{product_attributes_list}}');
        }
    }

}
