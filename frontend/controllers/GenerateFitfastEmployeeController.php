<?php

namespace frontend\controllers;

use frontend\models\Employee;
use frontend\models\FitfastEmployee;
use Yii;
use yii\db\Expression;

class GenerateFitfastEmployeeController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $employeeModels = Employee::find()->where('status!=2 AND username!="tm"')->all();

        foreach ($employeeModels as $employeeModel) {

            $fitfastEmployeeModel = new FitfastEmployee();
            $fitfastEmployeeModel->employeeId = $employeeModel->employeeId;
            $fitfastEmployeeModel->createDateTime = new Expression('NOW()');
            $fitfastEmployeeModel->updateDateTime = new Expression('NOW()');
            $fitfastEmployeeModel->forYear = date('Y');
            if($fitfastEmployeeModel->save()){
                echo $employeeModel->username.'<br />';
            }
        }
    }

}
