<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%foods}}`.
 */
class m220213_082457_create_foods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%foods}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%foods}}');
    }
}
