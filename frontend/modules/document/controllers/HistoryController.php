<?php

namespace frontend\modules\document\controllers;

class HistoryController extends \common\controllers\MasterController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
