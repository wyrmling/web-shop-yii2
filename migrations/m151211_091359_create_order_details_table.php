<?php

use yii\db\Schema;
use yii\db\Migration;

class m151211_091359_create_order_details_table extends Migration
{

    public function up()
    {
        // Детали заказов
        $this->createTable('{{order_details}}', [
            'product_id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
            'price' => $this->float(12, 2)->notNull(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{order_details}}', true) !== null) {
            $this->dropTable('{{order_details}}');
        }
    }

}
