<?php

use yii\db\Schema;
use yii\db\Migration;
use \app\models\Articles;

class m151127_155030_create_articles_table extends Migration
{

    // Таблица "Статьи"
    // ID статьи - первичный ключ integer
    // Название статьи и краткое описание - varchar 255 notNull
    // Содержимое статьи (контент) - text notNull
    // ID автора статьи - integer notNull
    // ID того, кто внес последние изменения - integer
    // время статьи и время последнего изменения - timestamp
    // статус статьи ("опубликована" или "скрыта") - integer notNull
    // статус комментариев ("разрешены" или "запрещены") - integer notNull
    public function up()
    {
        $this->createTable('{{articles}}', [
            'article_id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'time_created' => $this->timestamp(),
            'created_by' => $this->integer()->notNull(),
            'time_updated' => $this->timestamp(),
            'updated_by' => $this->integer(),
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

}
