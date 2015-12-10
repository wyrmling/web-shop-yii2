<?php

use yii\db\Schema;
use yii\db\Migration;

class m151210_214059_create_products_attributes_table extends Migration
{

    public function up()
    {
        $this->createTable('{{products_attributes}}', [
            'attribute_id' => $this->primaryKey(),
            'poduct_id' => $this->integer()->notNull(),
            'value' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{products_attributes}}', true) !== null) {
            $this->dropTable('{{products_attributes}}');
        }
    }

}
