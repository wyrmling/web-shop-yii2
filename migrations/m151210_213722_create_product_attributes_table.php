<?php

use yii\db\Schema;
use yii\db\Migration;

class m151210_213722_create_product_attributes_table extends Migration
{
    // Таблица "Атрибуты товаров"
    // ID атрибута - первичный ключ integer
    // Название атрибута - varchar 255 notNull
    // Единица измерения - varchar 255
    public function up()
    {
        $this->createTable('{{product_attributes}}', [
            'attribute_id' => $this->primaryKey(),
            'attribute_name' => $this->string()->notNull(),
            'unit' => $this->string(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{product_attributes}}', true) !== null) {
            $this->dropTable('{{product_attributes}}');
        }
    }

}
