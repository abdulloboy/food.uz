<?php

namespace app\modules\food\models;

use Yii;

/**
 * This is the model class for table "foods".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property FoodsIngredients[] $foodsIngredients
 */
class Foods extends \yii\db\ActiveRecord
{
    /**
     * @var array IDs of the ingredients
     */
    public $ingredient_ids = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'foods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            [
                'ingredient_ids', 'each', 'rule' => [
                    'exist', 'targetClass' => Ingredients::class, 'targetAttribute' => 'id'
                ]
            ],
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
            'ingredient_ids' => 'Ingredients',
        ];
    }

    /**
     * Gets query for [[FoodsIngredients]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIngredients()
    {
        return $this->hasMany(Ingredients::class, ['id' => 'ingredient_id'])
            ->viaTable('foods_ingredients', ['food_id' => 'id']);
    }

    /**
     * load the food's ingredient (*2)
     */
    public function loadIngredients()
    {
        $this->ingredient_ids = [];
        if (!empty($this->id)) {
            $rows = self::find()
                ->select(['ingredient_id'])
                ->where(['food_id' => $this->id])
                ->asArray()
                ->all();
            foreach($rows as $row) {
               $this->ingredient_ids[] = $row['ingredient_id'];
            }
        }
    }

    /**
     * save the food's ingredients (*3)
     */
    public function saveIngredients()
    {
        /* clear the ingredients of the food before saving */
        $this->unlinkAll('ingredients',true);
        if (is_array($this->ingredient_ids)) {
            $ingredients=Ingredients::findAll($this->ingredient_ids);
            foreach($ingredients as $ingredient) {
                $this->link('ingredients',$ingredient);
            }
        }
        $this->save();
    }
}
