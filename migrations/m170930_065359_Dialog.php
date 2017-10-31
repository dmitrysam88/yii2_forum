<?php

use yii\db\Migration;

class m170930_065359_Dialog extends Migration
{
    public function safeUp()
    {
        $this->createTable('Dialog',[
            'id'            => $this->primaryKey(11),
            'name'          => $this->string(250),
            'description'   => $this->text()
        ]);
    }

    public function safeDown()
    {
        echo "m170930_065359_Dialog cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170930_065359_Dialog cannot be reverted.\n";

        return false;
    }
    */
}
