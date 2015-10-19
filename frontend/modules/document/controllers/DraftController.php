<?php

namespace frontend\modules\document\controllers;

class DraftController extends \common\controllers\MasterController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
