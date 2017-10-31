<?php

use yii\db\Migration;

class m170930_065442_Members extends Migration
{
    public function safeUp()
    {
        $this->createTable('Members',[
            'id'        => $this->primaryKey(11),
            'dialog'    => $this->integer(11),
            'user'      => $this->integer(11)
        ]);

        $this->addForeignKey(
            'fk-Members-dialog',
            'Members',
            'dialog',
            'Dialog',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-Members-user',
            'Members',
            'user',
            'User',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        echo "m170930_065442_Members cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170930_065442_Members cannot be reverted.\n";

        return false;
    }
    */
}
