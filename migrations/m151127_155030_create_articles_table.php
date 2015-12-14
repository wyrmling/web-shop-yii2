<?php

use yii\db\Schema;
use yii\db\Migration;
use \app\models\Articles;

class m151127_155030_create_articles_table extends Migration
{

    use \app\models\helpDb;

    public function up() {
        $this->createTable('{{articles}}', [
            'article_id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'created_time' => $this->timestamp(),
            'changed_time' => $this->timestamp(),
            'article_status' => $this->integer()->notNull()->defaultValue(\app\models\Articles::HIDDEN),
            'comments_status' => $this->integer()->notNull()->defaultValue(\app\models\Articles::NO),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{articles}}', true) !== null) {
            $this->dropTable('{{articles}}');
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
