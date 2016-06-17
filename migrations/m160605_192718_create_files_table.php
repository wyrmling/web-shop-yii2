<?php

use yii\db\Schema;
use yii\db\Migration;

class m160605_192718_create_files_table extends Migration
{

    public function up()
    {
        // Таблица "Файлы"
        // ID загружаемого файла - первичный ключ integer
        // ID типа объекта (задается в модели через константу) - integer notNull
        // ID самого объекта - integer notNull
        // Название файла - varchar 255
        $this->createTable('{{files}}', [
            'image_id' => $this->primaryKey(),
            'object_type_id' => $this->integer()->notNull(),
            'object_id' => $this->integer()->notNull(),
            'image_title' => $this->string(),
            'mime' => $this->string(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{files}}', true) !== null) {
            $this->dropTable('{{files}}');
        }
    }

}
