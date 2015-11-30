<?php

use yii\db\Schema;
use yii\db\Migration;

class m151127_155030_create_article_table extends Migration
{
    public function up() {
        $this->createTable('{{article}}', [
            'article_id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'created_time' => $this->timestamp()->notNull() . ' DEFAULT NOW()',
            'changed_time' => $this->timestamp() . ' ON UPDATE NOW()',
            'article_status' => "ENUM('visible','hidden') NOT NULL DEFAULT 'hidden'",
            'comments_status' => "ENUM('yes','no') NOT NULL DEFAULT 'yes'",
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
