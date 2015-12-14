<?php

use yii\db\Schema;
use yii\db\Migration;

class m151210_214415_create_categories_table extends Migration
{

    public function up()
    {
        $this->createTable('{{product_categories_list}}', [
            'category_id' => $this->primaryKey(),
            'parent_category_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{product_categories_list}}', true) !== null) {
            $this->dropTable('{{product_categories_list}}');
        }
    }

}
