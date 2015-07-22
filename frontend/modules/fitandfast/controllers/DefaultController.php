<?php

namespace frontend\modules\fitandfast\controllers;

use frontend\models\FitfastEmployee;
use frontend\modules\fitandfast\controllers\FitandfastMasterController;
use frontend\models\Employee;
use Yii;
use yii\helpers\Url;

class DefaultController extends FitandfastMasterController
{
    public function actionIndex($employeeId=Null, $forYear=Null)
    {
        $employeeId = isset($employeeId) ? $employeeId :Yii::$app->user->identity->id;
        $forYear = isset($forYear) ? $forYear : date('Y');

        $employeeModel = Employee::findOne($employeeId);
        $fitfastEmployee = FitfastEmployee::find()
        ->where('employeeId=:employeeId AND forYear=:forYear', ['employeeId'=>$employeeId, 'forYear'=>$forYear])
        ->one();

        return $this->render('index', compact('employeeModel', 'fitfastEmployee'));
    }
}
