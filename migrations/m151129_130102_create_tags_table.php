<?php

use yii\db\Schema;
use yii\db\Migration;

class m151129_130102_create_tags_table extends Migration
{

    public function up()
    {
        $this->createTable('{{tags}}', [
            'tag_type' => $this->integer()->notNull(),
            'object_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{tags}}', true) !== null) {
            $this->dropTable('{{tags}}');
        }
    }

}
