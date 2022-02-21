<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Foods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="foods-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'ingredient_ids')
        ->listBox(
            $ingredients,
            [
                'multiple' => true,
                'options' => array_fill_keys(array_column($model->ingredients, 'id', 'id'), ['selected' => true])
            ]
        )
        /* or, you may use a checkbox list instead */
        /* ->checkboxList($ingredients) */
        ->hint('Select the ingredients of the food.');
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>