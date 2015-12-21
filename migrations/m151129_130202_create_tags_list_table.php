<?php

use yii\db\Schema;
use yii\db\Migration;

class m151129_130202_create_tags_list_table extends Migration
{
    public function up()
    {
        $this->createTable('{{tags_list}}', [
            'tag_id' => $this->primaryKey(),
            'tag_name' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{tags_list}}', true) !== null) {
            $this->dropTable('{{tags_list}}');
        }
    }
    
}
