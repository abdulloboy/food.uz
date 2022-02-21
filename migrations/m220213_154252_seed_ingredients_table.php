<?php

use yii\db\Migration;

/**
 * Class m220213_154252_seed_ingredients_table
 */
class m220213_154252_seed_ingredients_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insertFakeIngredients();
    }

    private function insertFakeIngredients()
    {
        $ingredients=['Gosht','Moyanez','Kolbasa','Moloko'];
        foreach($ingredients as $ingredient){
            $this->insert(
                'ingredients',
                [
                    'name' => $ingredient,
                    'hidden' => false,
                ]
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220213_154252_seed_ingredients_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220213_154252_seed_ingredients_table cannot be reverted.\n";

        return false;
    }
    */
}
