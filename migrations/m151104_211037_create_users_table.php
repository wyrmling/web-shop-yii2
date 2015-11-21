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
            'user_id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'auth_key' => $this->string()->defaultValue(NULL),
            'access_token' => $this->string()->defaultValue(NULL),
            'created_date' => $this->dateTime()->notNull(),
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
