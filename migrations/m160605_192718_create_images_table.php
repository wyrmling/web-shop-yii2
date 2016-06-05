<?php

use yii\db\Schema;
use yii\db\Migration;

class m160605_192718_create_images_table extends Migration
{

    public function up()
    {
        // Таблица "Картинки"
        // ID картинки - первичный ключ integer
        // ID типа объекта (задается в модели через константу) - integer notNull
        // ID самого объекта - integer notNull
        // Название картинки - varchar 255
        $this->createTable('{{images}}', [
            'image_id' => $this->primaryKey(),
            'object_type_id' => $this->integer()->notNull(),
            'object_id' => $this->integer()->notNull(),
            'image_title' => $this->string(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{images}}', true) !== null) {
            $this->dropTable('{{images}}');
        }
    }

}
