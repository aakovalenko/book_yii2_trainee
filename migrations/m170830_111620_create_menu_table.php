<?php

use yii\db\Migration;

/**
 * Handles the creation of table `menu`.
 */
class m170830_111620_create_menu_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%menu}}', [
            'id' => $this->primaryKey(),
            'tree' => $this->integer()->notNull(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'url' => $this->string(50)->notNull(),
            'text' => $this->string(1000),
        ]);;
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('menu');
    }
}
