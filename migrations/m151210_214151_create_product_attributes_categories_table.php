<?php

use yii\db\Schema;
use yii\db\Migration;

class m151210_214151_create_product_attributes_categories_table extends Migration
    {

    // Cвязующая таблица "Атрибуты-категории"
    // ID атрибута - integer notNull
    // ID категории - integer notNull
    // ! ID атрибута + ID категории = первичный ключ
    // порядковый номер в списке атрибутов для конкретной категории- integer
    public function up()
    {
        $this->createTable('{{product_attributes_categories}}', [
            'attribute_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'order' => $this->integer()->defaultValue(0),
        ]);
        $this->addPrimaryKey('at_cat_key', '{{product_attributes_categories}}', [
            'attribute_id', 'category_id',
        ]);

        $this->insert('{{product_attributes_categories}}', [
            'attribute_id' => 1,
            'category_id' => 14,
            'order' => 3,
        ]);
        $this->insert('{{product_attributes_categories}}', [
            'attribute_id' => 2,
            'category_id' => 14,
            'order' => 2,
        ]);
        $this->insert('{{product_attributes_categories}}', [
            'attribute_id' => 3,
            'category_id' => 14,
            'order' => 1,
        ]);
        $this->insert('{{product_attributes_categories}}', [
            'attribute_id' => 4,
            'category_id' => 8,
            'order' => 1,
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{product_attributes_categories}}', true) !== null) {
            $this->dropTable('{{product_attributes_categories}}');
        }
    }

    }
