<?php

use yii\db\Schema;
use yii\db\Migration;
use app\models\News;

class m151121_201645_create_news_table extends Migration
{

    use \app\models\helpDb;

    public function up()
    {
        $this->createTable('{{news}}', [
            'news_id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->string(),
            'content' => $this->text(),
            'time_created' => $this->dateTime(),
            'time_updated' => $this->dateTime(),
            'news_status' => "ENUM(".self::quote(News::VISIBLE).",".self::quote(News::HIDDEN).") NOT NULL DEFAULT ".self::quote(News::HIDDEN),
        ]);
    }

    public function down()
    {
       if ($this->db->schema->getTableSchema('{{news}}', true) !== null) {
            $this->dropTable('{{news}}');
        }
    }


    // Use safeUp/safeDown to run migration code within a transaction
//    public function safeUp()
//    {
//    }
//
//    public function safeDown()
//    {
//    }

}
