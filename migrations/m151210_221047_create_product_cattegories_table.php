<?php

use yii\db\Schema;
use yii\db\Migration;

class m151210_221047_create_products_cattegories_table extends Migration
{

    public function up()
    {
        $this->createTable('{{product_categories}}', [
            'product_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{product_categories}}', true) !== null) {
            $this->dropTable('{{product_categories}}');
        }
    }

}
