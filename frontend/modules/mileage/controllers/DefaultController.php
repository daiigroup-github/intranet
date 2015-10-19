<?php

namespace frontend\modules\mileage\controllers;

use yii\web\Controller;

class DefaultController extends MileageMasterController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
