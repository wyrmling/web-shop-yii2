<?php

use yii\db\Schema;
use yii\db\Migration;

class m151210_214415_create_categories_table extends Migration
{

    public function up()
    {
        $this->createTable('{{categories}}', [
            'category_id' => $this->primaryKey(),
            'parent_category_id' => $this->integer()->notNull(),
            'category_name' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{categories}}', true) !== null) {
            $this->dropTable('{{categories}}');
        }
    }

}
