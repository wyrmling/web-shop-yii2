<?php

use yii\db\Schema;
use yii\db\Migration;

class m151129_130202_create_tags_articles_table extends Migration
{
    public function up()
    {
$this->createTable('{{tags_articles}}', [
            'tag_id' => $this->integer()->notNull(),
            'article_id' => $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{tags_articles}}', true) !== null) {
            $this->dropTable('{{tags_articles}}');
        }
    }
    
}
