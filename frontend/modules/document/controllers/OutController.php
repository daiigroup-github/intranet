<?php

namespace frontend\modules\document\controllers;

class OutController extends \common\controllers\MasterController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
