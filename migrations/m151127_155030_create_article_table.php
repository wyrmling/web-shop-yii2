<?php

use yii\db\Schema;
use yii\db\Migration;
use \app\models\Article;

class m151127_155030_create_article_table extends Migration
{

    use \app\models\helpDb;

    public function up() {
        $this->createTable('{{articles}}', [
            'article_id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'created_time' => $this->timestamp()->notNull() . ' DEFAULT NOW()',
            'changed_time' => $this->timestamp() . ' ON UPDATE NOW()',
            'article_status' => "ENUM(".self::quote(Articles::VISIBLE).",".self::quote(Articles::HIDDEN).") NOT NULL DEFAULT ".self::quote(Article::HIDDEN),
            'comments_status' => "ENUM('y','n') NOT NULL DEFAULT 'y'",
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{article}}', true) !== null) {
            $this->dropTable('{{article}}');
        }
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
