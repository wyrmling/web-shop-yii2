<?php

use yii\db\Schema;
use yii\db\Migration;

class m151210_214151_create_product_attributes_categories_table extends Migration
{
    // Cвязующая таблица "Атрибуты-категории"
    // ID атрибута - integer notNull
    // ID категории - integer notNull
    public function up()
    {
        $this->createTable('{{product_attributes_categories}}', [
            'attribute_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{product_attributes_categories}}', true) !== null) {
            $this->dropTable('{{product_attributes_categories}}');
        }
    }

}










