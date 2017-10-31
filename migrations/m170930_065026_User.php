<?php

use yii\db\Migration;

class m170930_065026_User extends Migration
{
    public function safeUp()
    {
        $this->createTable('User',[
            'id'            => $this->primaryKey(11),
            'username'      => $this->string(50),
            'password'      => $this->string(50),
            'authKey'       => $this->string(100),
            'accessToken'   => $this->string(100),
            'administrator' => $this->boolean()
        ]);
    }

    public function safeDown()
    {
        echo "m170930_065026_User cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170930_065026_User cannot be reverted.\n";

        return false;
    }
    */
}
