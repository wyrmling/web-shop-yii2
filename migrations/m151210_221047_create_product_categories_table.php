<?php

use yii\db\Schema;
use yii\db\Migration;

class m151210_221047_create_product_categories_table extends Migration
{

    // Связующая таблица "Продукт-Категория"
    // ID товара - integer notNull
    // ID категории - integer notNull
    public function up()
    {
        $this->createTable('{{product_categories}}', [
            'product_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'PRIMARY KEY(product_id, category_id)'
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{product_categories}}', true) !== null) {
            $this->dropTable('{{product_categories}}');
        }
    }

}
