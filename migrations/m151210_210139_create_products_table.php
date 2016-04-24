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
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{products}}', true) !== null) {
            $this->dropTable('{{products}}');
        }
    }

}
