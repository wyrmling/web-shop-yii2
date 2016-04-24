<?php

use yii\db\Schema;
use yii\db\Migration;

class m151210_214415_create_product_categories_list_table extends Migration
{

    // Таблица "Список категорий товаров"
    // ID категории - первичный ключ integer
    // ID родительской категории - integer notNull (если категория наивысшего уровня, тогда ID = 0)
    // Название категории - varchar 255 notNull
    // Скидка на бренд (%) - integer
    // Количество видимых (выставленных на продажу товаров) - integer
    // Количество невидимых (не выставленных на продажу товаров) - integer
    public function up()
    {
        $this->createTable('{{product_categories_list}}', [
            'category_id' => $this->primaryKey(),
            'parent_category_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'discount' => $this->integer(),
            'quantity_visible' => $this->integer()->notNull()->defaultValue(0),
            'quantity_invisible' => $this->integer()->notNull()->defaultValue(0),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{product_categories_list}}', true) !== null) {
            $this->dropTable('{{product_categories_list}}');
        }
    }

}
