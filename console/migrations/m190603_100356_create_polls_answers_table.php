<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%polls-answers}}`.
 */
class m190603_100356_create_polls_answers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%polls-answers}}', [
            'id' => $this->primaryKey(),
            'poll_id' => $this->integer()->null()->defaultValue(null),
            'answer' => $this->text()->notNull(),
        ],$tableOptions);
        $this->createIndex('{{%idx-polls-answers-poll_id}}', '{{%polls-answers}}', 'poll_id');
        $this->addForeignKey('{{%fk-polls-answers-poll_id}}', '{{%polls-answers}}', 'poll_id', '{{%polls}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-polls-answers-poll_id}}', '{{%polls-answers}}');
        $this->dropIndex('{{%idx-polls-answers-poll_id}}', '{{%polls-answers}}');
        $this->dropTable('{{%polls-answers}}');
    }
}
