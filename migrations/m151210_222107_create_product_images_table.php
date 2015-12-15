<?php

use yii\db\Schema;
use yii\db\Migration;

class m151210_222107_create_product_images_table extends Migration
{

    // Таблица "Картинки товара"
    // ID картинка - первичный ключ integer
    // ID товара - integer notNull 
    // URL картинки товара - varchar 255 notNull
    // Название картинки - varchar 255 notNull
    public function up()
    {
        $this->createTable('{{product_images}}', [
            'image_id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'product_image_url' => $this->string()->notNull(),
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
