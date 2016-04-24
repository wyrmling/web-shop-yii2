<?php

use yii\db\Schema;
use yii\db\Migration;

class m151210_213302_create_product_brands_table extends Migration
{

    // Таблица "Бренды товаров"
    // ID бренда товара - первичный ключ integer
    // Название бренда - varchar 255 notNull
    // URL логотипа - varchar 255
    // Размер скидкив процентах от производителя (на все товары бренда)
    public function up()
    {
        $this->createTable('{{product_brands}}', [
            'brand_id' => $this->primaryKey(),
            'brand_name' => $this->string()->notNull(),
            'logo_url' => $this->string(),
            'discount' => $this->integer(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{product_brands}}', true) !== null) {
            $this->dropTable('{{product_brands}}');
        }
    }

}
