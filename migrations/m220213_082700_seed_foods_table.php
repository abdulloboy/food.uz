<?php

use yii\db\Migration;

/**
 * Class m220213_082700_seed_foods_table
 */
class m220213_082700_seed_foods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insertFakeFoods();
    }

    private function insertFakeFoods()
    {
        $foods = ['Shashlik', 'Olivye', 'Pizza', 'Napalyon'];
        foreach ($foods as $food) {
            $this->insert(
                'foods',
                [
                    'name' => $food,
                ]
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220213_082700_seed_foods_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220213_082700_seed_foods_table cannot be reverted.\n";

        return false;
    }
    */
}
