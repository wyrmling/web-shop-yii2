<?php

use yii\db\Schema;
use yii\db\Migration;

class m151210_213722_create_pr_atributes_table extends Migration
{

    public function up()
    {
        $this->createTable('{{product_attributes}}', [
            'attribute_id' => $this->primaryKey(),
            'attribute_name' => $this->string()->notNull(),
            'unite' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{product_attributes}}', true) !== null) {
            $this->dropTable('{{product_attributes}}');
        }
    }

}
