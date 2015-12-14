<?php

use yii\db\Schema;
use yii\db\Migration;

class m151128_210416_create_article_comments_table extends Migration {

    public function up() {
        $this->createTable('{{article_comments}}', [
            'comment_id' => $this->primaryKey(),
            'article_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
            'time_created' => $this->timestamp(),
            'time_updated' => $this->timestamp(),
        ]);
    }

    public function down() {
        if ($this->db->schema->getTableSchema('{{article_comments}}', true) !== null) {
            $this->dropTable('{{article_comments}}');
        }
    }

}
