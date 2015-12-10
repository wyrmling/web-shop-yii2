<?php

use yii\db\Schema;
use yii\db\Migration;

class m151210_221047_create_products_cattegories_table extends Migration
{

    public function up()
    {
        $this->createTable('{{products_cattegoties}}', [
            'product_id' => $this->primaryKey(),
            'cattegory_id' => $this->integer()->notNull(),
       
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{products_cattegoties}}', true) !== null) {
            $this->dropTable('{{products_cattegoties}}');
        }
    }

}
