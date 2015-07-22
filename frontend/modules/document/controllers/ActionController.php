<?php

namespace frontend\modules\;

class ActionController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
