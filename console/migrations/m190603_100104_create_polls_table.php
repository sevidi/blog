<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%polls}}`.
 */
class m190603_100104_create_polls_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%polls}}', [
            'id' => $this->primaryKey(),
            'question' => $this->string()->notNull(),
            'date_beg' => $this->date()->notNull(),
            'date_end'=> $this->date()->notNull(),
            'allow_multiple' => $this->integer(4)->notNull(),
            'is_random' => $this->integer(4)->notNull(),
            'anonymous' => $this->integer(4)->notNull(),
            'show_vote' => $this->integer(4)->notNull(),
            'status' => $this->integer()->notNull(),
        ],$tableOptions);
        $this->createIndex('{{%idx-polls-id}}', '{{%polls}}', 'id', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('{{%idx-polls-id}}', '{{%polls}}');
        $this->dropTable('{{%polls}}');
    }
}
