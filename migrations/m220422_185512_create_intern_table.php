<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%intern}}`.
 */
class m220422_185512_create_intern_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%intern}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%intern}}');
    }
}
