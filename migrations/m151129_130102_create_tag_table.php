<?php

use yii\db\Schema;
use yii\db\Migration;

class m151129_130102_create_tag_table extends Migration {

    public function up() {
        $this->createTable('{{tag}}', [
            'tag_id' => $this->primaryKey(),
            'tag_name' => $this->string()->notNull(),
        ]);
    }

    public function down() {
        if ($this->db->schema->getTableSchema('{{tag}}', true) !== null) {
            $this->dropTable('{{_tag}}');
        }
    }

}
