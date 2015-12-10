<?php

use yii\db\Schema;
use yii\db\Migration;

class m151210_213722_create_atributes_table extends Migration
{

    public function up()
    {
        $this->createTable('{{attributes}}', [
            'attribute_id' => $this->primaryKey(),
            'attribute_name' => $this->string()->notNull(),
            'unite' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{attributes}}', true) !== null) {
            $this->dropTable('{{attributes}}');
        }
    }

}
