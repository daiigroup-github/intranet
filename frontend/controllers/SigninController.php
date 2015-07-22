<?php

namespace frontend\controllers;

use Yii;
use common\controllers\MasterController;
use common\models\LoginForm;
use common\models\MasterModel;
use yii\web\Controller;

class SigninController extends Controller
{
    public $layout = 'signin';

    public function actionIndex()
    {
        $webs = MasterModel::getAllWebs();
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('index', compact('model', 'webs'));
        }
    }

}
