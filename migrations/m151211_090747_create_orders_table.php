<?php

use yii\db\Schema;
use yii\db\Migration;

class m151211_090747_create_orders_table extends Migration
{

    // Таблица "Заказы"
    // ID заказа - первичный ключ integer
    // ID пользователя - integer notNull
    // Имя незарегистрированного покупателя - string
    // Статус заказа - integer notNull
    // Общая сумма заказа - float(12,2) notNull
    // Время регистрации заказа - timestamp
    // Комментарий покупателя к заказу - text
    // Комментарий менеджера к заказу - text
    public function up()
    {
        $this->createTable('{{orders}}', [
            'order_id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'entered_name' => $this->string(),
            'user_phone_number' => $this->string()->notNull(),
            'status' => $this->integer()->notNull()->defaultValue(\app\models\Orders::UNANSWERED),
            'total_sum' => $this->float(12, 2)->notNull(),
            'time_ordered' => $this->timestamp(),
            'client_comment' => $this->text(),
            'manager_comment' => $this->text(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{orders}}', true) !== null) {
            $this->dropTable('{{orders}}');
        }
    }

}
