<?php

use yii\db\Schema;
use yii\db\Migration;

class m151129_130102_create_tags_table extends Migration
{

    // Таблица "Теги"
    // ID тега - первичный ключ integer
    // Название тега - varchar 255 notNull
    // Тип тега (к чему относится: новости или статье) - integer notNull
    // ID объекта (новости или статьи) - integer notNull
    public function up()
    {
        $this->createTable('{{tags}}', [
            'tag_id' => $this->primaryKey(),
            'tag_name' => $this->string()->notNull(),
            'tag_type' => $this->integer()->notNull(),
            'object_id' => $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{tags}}', true) !== null) {
            $this->dropTable('{{tags}}');
        }
    }

}
