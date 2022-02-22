<?php

namespace app\modules\food\controllers;

use app\modules\food\models\Ingredients;
use yii\web\Controller;

/**
 * Default controller for the `food` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $found_foods = null;
        $message = null;
        if ($this->request->isPost) {
            if ($this->request->post('ingredients')) {
                $found_foods = Ingredients::findFoods($this->request->post('ingredients'));
            } else {
                $message = "Select one or more ingredients";
            }
        }

        return $this->render('index', [
            'found_foods' => $found_foods,
            'ingredients' => Ingredients::find()->where(['hidden' => 0])
                ->with('foods')->orderBy('name')->asArray()->all(),
            'message' => $message,
        ]);
    }
}
