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
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'phone_number' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
        ]);
//        , $tableOptions

        $this->insert('{{users}}', [
            'username' => 'admin',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'first_name' => 'Админ',
            'last_name' => 'Админов',
            'phone_number' => '+38 (111) 111-11-11',
            'email' => 'admin@admin.com',
        ]);
        $this->insert('{{users}}', [
            'username' => 'user',
            'password' => password_hash('user', PASSWORD_DEFAULT),
            'first_name' => 'Юзер',
            'last_name' => 'Юзеровский',
            'phone_number' => '+38 (222) 222-22-22',
            'email' => 'user@user.ru',
        ]);
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema('{{users}}', true) !== null) {
            $this->dropTable('{{users}}');
        }
    }

}