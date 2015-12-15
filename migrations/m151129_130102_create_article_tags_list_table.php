<?php

use yii\db\Schema;
use yii\db\Migration;

class m151129_130102_create_article_tags_list_table extends Migration
{

    // Таблица "Теги для статей"
    // ID тега - первичный ключ integer
    // Название тега - varchar 255 notNull
    public function up()
    {
        $this->createTable('{{article_tags_list}}', [
            'tag_id' => $this->primaryKey(),
            'tag_name' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{article_tags_list}}', true) !== null) {
            $this->dropTable('{{article_tags_list}}');
        }
    }

}
