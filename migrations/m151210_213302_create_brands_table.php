<?php

use yii\db\Schema;
use yii\db\Migration;

class m151210_213302_create_brands_table extends Migration
{

    public function up()
    {
        $this->createTable('{{brands}}', [
            'brand_id' => $this->primaryKey(),
            'brand_name' => $this->string()->notNull(),
            'logo_url' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{brands}}', true) !== null) {
            $this->dropTable('{{brands}}');
        }
    }
    
}
