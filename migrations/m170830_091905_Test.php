<?php

use yii\db\Migration;

class m170830_091905_Test extends Migration
{
    public function safeUp()
    {
        $this->createTable('test', [
            'id' => $this->primaryKey(),
            'name' => $this->string(145)->notNull(),
            'num' => $this->integer(23)->unique(),
        ]);

    }

    public function safeDown()
    {
        echo "m170830_091905_Test cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170830_091905_Test cannot be reverted.\n";

        return false;
    }
    */
}
