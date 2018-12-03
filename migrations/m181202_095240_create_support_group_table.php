<?php

use yii\db\Migration;

/**
 * Handles the creation of table `support_group`.
 */
class m181202_095240_create_support_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('support_group', [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer()->unsigned()->notNull(),
            'language_code' => $this->string()->notNull(),
            'title' => $this->string(255)->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
            'updated_by' => $this->integer()->unsigned()->notNull()
        ]);

        $this->createIndex(
            'idx-support_group-language_code',
            'support_group',
            'language_code'
        );

        $this->addForeignKey(
            'fk-support_group-language_code',
            'support_group',
            'language_code',
            'language',
            'code',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-support_group-language_code',
            'support_group'
        );

        $this->dropIndex(
            'idx-support_group-language_code',
            'support_group'
        );

        $this->dropTable('support_group');
    }
}