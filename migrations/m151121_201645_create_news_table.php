<?php

use yii\db\Schema;
use yii\db\Migration;

class m151121_201645_create_news_table extends Migration
{

    public function up()
    {
        $this->createTable('{{news}}', [
            'news_id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->string(),
            'content' => $this->text(),
            'time_created' => $this->timestamp(),
            'created_by'=> $this->integer()->notNull(),
            'time_updated' => $this->timestamp(),
            'updated_by'=> $this->integer(),
            'news_status' => $this->integer()->notNull()->defaultValue(\app\models\News::HIDDEN),
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
