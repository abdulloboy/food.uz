<?php

/** @var yii\web\View $this */
/** @var $ingredients array */

use yii\bootstrap4\ActiveForm;

$this->title = 'My Yii Application';
?>
<div id="app" ingredients='<?= json_encode($ingredients) ?>' found_foods='<?= json_encode($found_foods) ?>'>
    <div>
        <div class="text-center display-4">
            Find foods by ingredients
        </div>
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
        ]); ?>
        <ul>
            <li v-for="ingredient in ingredients" key="index">
                <input name="ingredients[]" type="checkbox" :value="ingredient.id" />
                {{ ingredient.name }}
            </li>
        </ul>
        <input type="submit" value="Find">
        <?php ActiveForm::end(); ?>
    </div>
    <div class="text-center display-4">
        <?= $message ?>
    </div>
    <div v-if='found_foods===null'></div>
    <div v-else-if='found_foods.length===0'>
        <div class="text-center display-4">
            Foods not found
        </div>
    </div>
    <div v-else-if='found_foods.length>0'>
        <div v-if='found_foods[0].not_found_ingredient_count==0'>
            <div class="text-center display-4">
                Full matched foods
            </div>
            <ul v-for="food in found_foods">
                <li v-if="food.not_found_ingredient_count==0">
                    {{ food.name }}
                </li>
            </ul>
        </div>
        <div v-else-if='found_foods[0].found_ingredient_count>1'>
            <div class="text-center display-4">
                Partial matched foods
            </div>
            <ul v-for="food in found_foods">
                <li v-if="food.not_found_ingredient_count>1">
                    {{ food.name }}
                </li>
            </ul>
        </div>
        <div v-else>
            <div class="text-center display-4">
                Matched foods not found
            </div>
        </div>
    </div>
</div>