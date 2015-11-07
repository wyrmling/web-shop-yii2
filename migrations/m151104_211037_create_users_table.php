<?php

use yii\db\Schema;
use yii\db\Migration;

class m151104_211037_create_users_table extends Migration
{

    public function tableExists($tableName)
    {
        return in_array($tableName, Yii::$app->db->schema->tableNames);
    }

    public function up()
    {

//        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{users}}', [
            'user_id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            'password' => Schema::TYPE_STRING . ' NOT NULL',
            'auth_key' => Schema::TYPE_STRING . ' DEFAULT NULL',
            'access_token' => Schema::TYPE_STRING . ' DEFAULT NULL',
        ]);
//        , $tableOptions
    }


    public function down()
    {
        if ($this->db->schema->getTableSchema('{{users}}', true) !== null) {
            $this->dropTable('{{users}}');
        }
    }

}
