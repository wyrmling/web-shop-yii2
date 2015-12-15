<?php

use yii\db\Schema;
use yii\db\Migration;

class m151215_223052_create_titles_table extends Migration
{
    public function up()
    {
        $this->createTable('{{titles}}', [
            'title_id' => $this->string(255)->notNull(),
            'pattern' => $this->string(255)->notNull(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{titles}}', true) !== null) {
            $this->dropTable('{{titles}}');
        }
    }

}