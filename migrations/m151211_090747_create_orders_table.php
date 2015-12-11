<?php

use yii\db\Schema;
use yii\db\Migration;

class m151211_090747_create_orders_table extends Migration
{

    public function up()
    {
        $this->createTable('{{orders}}', [
            'order_id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
            'total_sum' => $this->float(12, 2)->notNull(),
            'ordered_time' => $this->timestamp(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{orders}}', true) !== null) {
            $this->dropTable('{{orders}}');
        }
    }

}
