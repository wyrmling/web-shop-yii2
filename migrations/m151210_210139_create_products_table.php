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
            'SKU' => $this->string()->notNull(),
            'article' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->string(),
            'status' => $this->integer()->notNull()->defaultValue(0),
            'price' => $this->float(12,2)->notNull(),
            'special_price' => $this->float(12,2)->notNull(),
            'created_by'=> $this->integer()->notNull(),
            'created' => $this->timestamp(),
            'updated_by'=> $this->integer()->notNull(),
            'updated' => $this->timestamp(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{products}}', true) !== null) {
            $this->dropTable('{{products}}');
        }
    }

}
