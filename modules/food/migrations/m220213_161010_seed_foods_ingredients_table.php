<?php
namespace app\modules\food\migrations;

use yii\db\Migration;

/**
 * Class m220213_161010_seed_foods_ingredients_table
 */
class m220213_161010_seed_foods_ingredients_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insertFakeFoodIngredient();
    }

    private function insertFakeFoodIngredient()
    {
        for ($i = 1; $i <= 4; $i++) {
            $this->insert(
                'foods_ingredients',
                [
                    'food_id' => $i,
                    'ingredient_id' =>$i,
                ]
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220213_161010_seed_foods_ingredients_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220213_161010_seed_foods_ingredients_table cannot be reverted.\n";

        return false;
    }
    */
}
