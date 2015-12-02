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
            'time_created' => $this->dateTime(),
            'time_updated' => $this->dateTime(),
        ]);
    }

//	`news_id` INT(11) NOT NULL AUTO_INCREMENT,
//	`title` VARCHAR(255) NOT NULL,
//	`description` VARCHAR(255) NULL DEFAULT NULL,
//	`content` TEXT NULL,
//	`time_created` DATETIME NULL DEFAULT NULL,
//	`time_updated` DATETIME NULL DEFAULT NULL,

    public function down()
    {
       if ($this->db->schema->getTableSchema('{{news}}', true) !== null) {
            $this->dropTable('{{news}}');
        }
    }


    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }

}
