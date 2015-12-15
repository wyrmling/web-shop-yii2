<?php

use yii\db\Schema;
use yii\db\Migration;

class m151128_210416_create_comments_table extends Migration
{

    // Таблица "Комментари к статье"
    // ID комментария - первичный ключ integer
    // тип комментария - integer
    // ID статьи, к которой добавлен комментарий - integer notNull
    // ID автора комментария - integer notNull
    // Содержимое статьи (контент) - text notNull - integer notNull
    // Текст комментария - text notNull
    // время статьи и время последнего изменения - timestamp
    // статус статьи ("опубликована" или "скрыта") - integer notNull
    public function up()
    {
        $this->createTable('{{comments}}', [
            'comment_id' => $this->primaryKey(),
            'comment_type' => $this->integer()->notNull(),
            'object_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
            'time_created' => $this->timestamp(),
            'time_updated' => $this->timestamp(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{comments}}', true) !== null) {
            $this->dropTable('{{comments}}');
        }
    }

}