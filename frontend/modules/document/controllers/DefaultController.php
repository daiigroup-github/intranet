<?php

namespace frontend\modules\document\controllers;

use yii\web\Controller;

class DefaultController extends \common\controllers\MasterController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
