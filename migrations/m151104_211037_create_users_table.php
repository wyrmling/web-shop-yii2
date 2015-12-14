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
            'username' => $this->string()->notNull()->unique(),
            'password' => $this->string()->notNull(),
            'is_active' => $this->integer()->notNull()->defaultValue(\app\models\Users::ACTIVE),
            'auth_key' => $this->string(),
            'access_token' => $this->string(),
            'created_date' => $this->timestamp(),
        ]);
//        , $tableOptions

        $this->insert('{{users}}', [
            'username' => 'admin',
            'password' => 'admin',
        ]);
    }


    public function down()
    {
        if ($this->db->schema->getTableSchema('{{users}}', true) !== null) {
            $this->dropTable('{{users}}');
        }
    }

}
