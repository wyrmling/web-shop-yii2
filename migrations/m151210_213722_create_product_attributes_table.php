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

        $this->insert('{{product_attributes}}', [
            'attribute_id' => 1,
            'attribute_name' => 'масса',
            'unit' => 'кг',
        ]);
        $this->insert('{{product_attributes}}', [
            'attribute_id' => 2,
            'attribute_name' => 'диагональ',
            'unit' => 'см',
        ]);
        $this->insert('{{product_attributes}}', [
            'attribute_id' => 3,
            'attribute_name' => 'объем памяти',
            'unit' => 'Гб',
        ]);
        $this->insert('{{product_attributes}}', [
            'attribute_id' => 4,
            'attribute_name' => 'объем',
            'unit' => 'л',
        ]);
        $this->insert('{{product_attributes}}', [
            'attribute_id' => 5,
            'attribute_name' => 'цвет',
            'unit' => '--',
        ]);
        $this->insert('{{product_attributes}}', [
            'attribute_id' => 6,
            'attribute_name' => 'материал корпуса',
            'unit' => '--',
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{product_attributes}}', true) !== null) {
            $this->dropTable('{{product_attributes}}');
        }
    }

}
