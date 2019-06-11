<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%polls_result}}`.
 */
class m190609_144405_create_polls_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable('{{%polls-result}}', [
            'id' => $this->primaryKey(),
            'num'=> $this->integer(11)->notNull()->defaultValue(0),
            'poll_id' => $this->integer()->notNull(),
            'answer_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'create_at' => $this->dateTime()->notNull(),
            'update_at' => $this->dateTime()->null(),
            'ip' => $this->string()->notNull(),
            'host' => $this->string()->null()->defaultValue(null)
        ], $tableOptions);

        $this->addForeignKey('{{%fk-polls-result-poll_id}}', '{{%polls-result}}', 'poll_id', '{{%polls}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('{{%fk-polls-result-answer_id}}', '{{%polls-result}}', 'answer_id', '{{%polls-answers}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-polls-result-answer_id}}', '{{%polls-result}}');
        $this->dropForeignKey('{{%fk-polls-result-poll_id}}', '{{%polls-result}}');
        $this->dropTable('{{%polls-result}}');
    }
}
