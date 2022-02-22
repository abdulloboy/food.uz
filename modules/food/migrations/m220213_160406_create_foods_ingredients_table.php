<?php
namespace app\modules\food\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%foods_ingredients}}`.
 */
class m220213_160406_create_foods_ingredients_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%foods_ingredients}}', [
            'id' => $this->primaryKey(),
            'food_id' => $this->integer()->notNull(),
            'ingredient_id' => $this->integer()->notNull()
        ]);

        // creates index for column `food_id`
        $this->createIndex(
            'idx-foods-ingredients-food_id',
            'foods_ingredients',
            'food_id'
        );

        // add foreign key for table `foods`
        $this->addForeignKey(
            'fk-foods-ingredients-food_id',
            'foods_ingredients',
            'food_id',
            'foods',
            'id',
            'CASCADE'
        );

        // creates index for column `ingredient_id`
        $this->createIndex(
            'idx-foods-ingredients-ingredient-id',
            'foods_ingredients',
            'ingredient_id'
        );

        // add foreign key for table `ingredients`
        $this->addForeignKey(
            'fk-foods-ingredients-ingredient-id',
            'foods_ingredients',
            'ingredient_id',
            'ingredients',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `foods`
        $this->dropForeignKey(
            'fk-foods-ingredients-food_id',
            'foods_ingredients'
        );

        // drops index for column `food_id`
        $this->dropIndex(
            'idx-foods-ingredients-food_id',
            'foods_ingredients'
        );

        // drops foreign key for table `ingredients`
        $this->dropForeignKey(
            'fk-foods-ingredients-ingredient-id',
            'foods_ingredients'
        );

        // drops index for column `ingredient_id`
        $this->dropIndex(
            'idx-foods-ingredients-ingredient-id',
            'foods_ingredients'
        );
        
        $this->dropTable('{{%foods_ingredients}}');
    }
}
