<?php

use yii\db\Schema;
use yii\db\Migration;

class m151210_210139_create_products_table extends Migration
{

    // Таблица "товары"
    // ID товара - первичный ключ integer
    // ID категории - integer notNull
    // ID бренда - integer notNull
    // SKU - Stock Keeping Unit (ассортиментная позиция товара) - varchar 255
    // Артикул - varchar 255
    // Название товара - varchar 255 notNull
    // Описание товара - varchar 255
    // Статус товара - integer
    // Цена и специальная цена товара - float(12,2)
    // ID того, кто добавил товар - integer notNull
    // ID того, кто внес последние изменения - integer
    // время статьи и время последнего изменения - timestamp
    public function up()
    {
        $this->createTable('{{products}}', [
            'product_id' => $this->primaryKey(),
            'brand_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'sku' => $this->string(),
            'article' => $this->string(),
            'title' => $this->string()->notNull(),
            'description' => $this->string(),
            'status' => $this->integer()->notNull()->defaultValue(\app\models\Products::HIDDEN),
            'price' => $this->float(12, 2),
            'special_price' => $this->float(12, 2),
            'created_by' => $this->integer()->notNull(),
            'time_created' => $this->timestamp(),
            'updated_by' => $this->integer(),
            'time_updated' => $this->timestamp(),
        ]);

        $this->insert('{{products}}', [
            'product_id' => 1,
            'brand_id' => 7,
            'category_id' => 14,
            'sku' => 'D&C 205-7',
            'article' => 'А654',
            'title' => 'Тапки',
            'description' => 'Непромокаемые и несносные',
            'status' => 1,
            'price' => '648,89',
            'special_price' => '149,89',
            'created_by' => '1'
        ]);
        $this->insert('{{products}}', [
            'product_id' => 2,
            'brand_id' => 1,
            'category_id' => 14,
            'sku' => 'ВЧ8765',
            'article' => 'А747',
            'title' => 'Насос',
            'description' => 'Качать-не перекачать',
            'status' => 1,
            'price' => '1400,99',
            'special_price' => '239,98',
            'created_by' => '1'
        ]);
        $this->insert('{{products}}', [
            'product_id' => 3,
            'brand_id' => 5,
            'category_id' => 14,
            'sku' => 'P502',
            'article' => 'А123',
            'title' => 'Коннектор',
            'description' => 'Коннектинг пиплов',
            'status' => 1,
            'price' => '55,89',
            'special_price' => '17,99',
            'created_by' => '1'
        ]);
        $this->insert('{{products}}', [
            'product_id' => 4,
            'brand_id' => 5,
            'category_id' => 14,
            'sku' => 'P507',
            'article' => 'А155',
            'title' => 'Сальник',
            'description' => 'Самый сальник в мире',
            'status' => 1,
            'price' => '73,89',
            'special_price' => '19,99',
            'created_by' => '1'
        ]);
        $this->insert('{{products}}', [
            'product_id' => 5,
            'brand_id' => 1,
            'category_id' => 8,
            'sku' => 'P507',
            'article' => 'А155',
            'title' => 'Мыльница из эко-стекла',
            'description' => 'Прозрачная в ассортименте',
            'status' => 0,
            'price' => '772,89',
            'special_price' => '143,99',
            'created_by' => '1'
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{products}}', true) !== null) {
            $this->dropTable('{{products}}');
        }
    }

}
