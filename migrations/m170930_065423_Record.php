<?php

use yii\db\Migration;

class m170930_065423_Record extends Migration
{
    /**
     *
     */
    public function safeUp()
    {
        $this->createTable('Record',[
            'id'        => $this->primaryKey(11),
            'text'      => $this->text(),
            'dialog'    => $this->integer(11),
            'autor'     => $this->integer(11)
        ]);

        $this->addForeignKey(
            'fk-Record-dialog',
            'Record',
            'dialog',
            'Dialog',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-Record-autor',
            'Record',
            'autor',
            'User',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        echo "m170930_065423_Record cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170930_065423_Record cannot be reverted.\n";

        return false;
    }
    */
}
