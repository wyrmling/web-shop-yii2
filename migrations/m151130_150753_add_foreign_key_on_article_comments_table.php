<?php

use yii\db\Schema;
use yii\db\Migration;

class m151130_150753_add_foreign_key_on_article_comments_table extends Migration {

    public function up() {
        $this->addForeignKey('article_comment_fk', '{{article_comments}}', 'article_id', '{{articles}}', 'article_id', 'CASCADE', 'CASCADE');
    }

    public function down() {
        if ($this->db->schema->getTableSchema('{{article_comments}}', true) !== null) {
            $this->dropForeignKey('{{article_comment_fk}}', '{{article_comments}}');
        }
    }

}