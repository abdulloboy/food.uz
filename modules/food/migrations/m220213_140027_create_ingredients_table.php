<?php
namespace app\modules\food\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ingredients}}`.
 */
class m220213_140027_create_ingredients_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ingredients}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'hidden' => $this->boolean()->defaultValue(false),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ingredients}}');
    }
}
