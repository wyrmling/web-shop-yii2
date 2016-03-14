<?php

use yii\db\Schema;
use yii\db\Migration;

class m151211_091359_create_order_details_table extends Migration
{

    public function up()
    {
        // Таблица "Детали заказа"
        // ID товара - integer notNull
        // ID заказа - integer notNull
        // Количество - integer notNull
        // Статус елемента заказа (не путать со статусом всего заказа!) - integer notNull
        // Цена товара (на момент заказа) - float(12,2)
        $this->createTable('{{order_details}}', [
            'order_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull()->defaultValue(\app\models\OrderDetails::DEFAULT_STATUS),
            'price' => $this->float(12, 2)->notNull(),
            'PRIMARY KEY(order_id, product_id)'
        ]);
        
        $this->insert('{{order_details}}', [
            'order_id' => 1,
            'product_id' => 2,
            'quantity' => 1,
            'status' => 0,
            'price' => 239,
        ]);
        
        $this->insert('{{order_details}}', [
            'order_id' => 1,
            'product_id' => 3,
            'quantity' => 1,
            'status' => 0,
            'price' => 17,
        ]);
        
        $this->insert('{{order_details}}', [
            'order_id' => 1,
            'product_id' => 4,
            'quantity' => 1,
            'status' => 0,
            'price' => 19,
        ]);
        
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{order_details}}', true) !== null) {
            $this->dropTable('{{order_details}}');
        }
    }

}
