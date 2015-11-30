<?php

use yii\db\Schema;
use yii\db\Migration;

class m151129_130102_create_article_tag_list_table extends Migration {

    public function up() {
        $this->createTable('{{article_tag_list}}', [
            'tag_id' => $this->primaryKey(),
            'tag_name' => $this->string()->notNull(),
        ]);
    }

    public function down() {
        if ($this->db->schema->getTableSchema('{{article_tag_list}}', true) !== null) {
            $this->dropTable('{{article_tag_list}}');
        }
    }

}
