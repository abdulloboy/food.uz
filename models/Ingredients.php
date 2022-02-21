<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ingredients".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property FoodsIngredients[] $foodsIngredients
 */
class Ingredients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingredients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[FoodsIngredients]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFoods()
    {
        return $this->hasMany(Foods::class, ['id' => 'food_id'])
            ->viaTable('foods_ingredients', ['ingredient_id' => 'id']);
    }

    /**
     * Gets query for [[FoodsIngredients]].
     *
     * @return \yii\db\ActiveQuery
     */
    public static function findFoods($ingredients)
    {
        $foods = [];
        if(!$ingredients) return [];
        foreach ($ingredients as $ingredient) {
            $ing = self::find()->where(['id' => $ingredient])
                ->with('foods.ingredients')->asArray()->one();
            foreach ($ing['foods'] as $food) {
                $foods[$food['id']] = $food;
            }
        }

        foreach ($foods as &$food) {
            $food['ingredient_count'] = count($food['ingredients']);
            $food['found_ingredient_count'] = 0;
            foreach ($food['ingredients'] as $ingredient) {
                if (in_array($ingredient['id'], $ingredients)) {
                    $food['found_ingredient_count']++;
                }
            }
            $food['not_found_ingredient_count'] = $food['ingredient_count'] - $food['found_ingredient_count'];
        }

        usort($foods, function ($food1, $food2) {
            if($food1['not_found_ingredient_count']===$food2['not_found_ingredient_count']){
                return 0;
            }
            return ($food1['not_found_ingredient_count']<$food2['not_found_ingredient_count']) ? -1 : 1;
        });

        return $foods;
    }

    /**
     * Get all the available ingredients (*4)
     * @return array available ingredients
     */
    public static function getAvailableIngredients()
    {
        $ingredients = self::find()->orderBy('name')->asArray()->all();
        $items = ArrayHelper::map($ingredients, 'id', 'name');
        return $items;
    }
}
