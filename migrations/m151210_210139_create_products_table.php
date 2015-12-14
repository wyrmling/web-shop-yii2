<?php

use yii\db\Schema;
use yii\db\Migration;

class m151210_210139_create_products_table extends Migration
{

    public function up()
    {
        $this->createTable('{{products}}', [
            'product_id' => $this->primaryKey(),
            'brand_id' => $this->integer()->notNull(),
            'sku' => $this->string(),
            'article' => $this->string(),
            'title' => $this->string()->notNull(),
            'description' => $this->string(),
            'status' => $this->integer()->notNull(),
            'price' => $this->float(12,2),
            'special_price' => $this->float(12,2),
            'created_by'=> $this->integer()->notNull(),
            'time_created' => $this->timestamp(),
            'updated_by'=> $this->integer(),
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
