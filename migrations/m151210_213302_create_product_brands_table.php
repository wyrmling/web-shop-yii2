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
        
        $this->insert('{{product_brands}}', [
            'brand_id' => 1,
            'brand_name' => 'Сунь-Хунь-В-Чай',
            'discount' => 87,
        ]);
        $this->insert('{{product_brands}}', [
            'brand_id' => 2,
            'brand_name' => 'Reebosch',
            //'discount' => 0,
        ]);
        $this->insert('{{product_brands}}', [
            'brand_id' => 5,
            'brand_name' => 'Pear',
            'discount' => 12,
        ]);
        $this->insert('{{product_brands}}', [
            'brand_id' => 7,
            'brand_name' => 'Dolce & Kaballach',
            'discount' => 5,
        ]);
        $this->insert('{{product_brands}}', [
            'brand_id' => 12,
            'brand_name' => 'Nenovo',
            'discount' => 49,
        ]);
        $this->insert('{{product_brands}}', [
            'brand_id' => 17,
            'brand_name' => 'United Colors of Balakleya',
            'discount' => 49,
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{product_brands}}', true) !== null) {
            $this->dropTable('{{product_brands}}');
        }
    }

}
