<?php

use yii\db\Schema;
use yii\db\Migration;

class m151210_222107_create_products_images_table extends Migration
{

    public function up()
    {
        $this->createTable('{{products_images}}', [
            'image_id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'image_url' => $this->string()->notNull(),
            'image_title' => $this->string()->notNull(),
            'caption' => $this->string(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{products_images}}', true) !== null) {
            $this->dropTable('{{products_images}}');
        }
    }

}
