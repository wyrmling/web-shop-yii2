<?php

use yii\db\Schema;
use yii\db\Migration;

class m151128_210416_create_article_comment_table extends Migration {

    public function up() {
        $this->createTable('{{article_comment}}', [
            'comment_id' => $this->primaryKey(),
            'article_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'commetn_text' => $this->string()->notNull(),
            'created_time' => $this->timestamp('NULL'),
        ]);
    }

    public function down() {
        if ($this->db->schema->getTableSchema('{{article_comment}}', true) !== null) {
            $this->dropTable('{{article_comment}}');
        }
    }

}
