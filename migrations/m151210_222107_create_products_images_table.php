<?php

use yii\db\Schema;
use yii\db\Migration;

class m151210_222107_create_products_images_table extends Migration
{

    public function up()
    {
        $this->createTable('{{product_images}}', [
            'image_id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'url' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{product_images}}', true) !== null) {
            $this->dropTable('{{product_images}}');
        }
    }

}
