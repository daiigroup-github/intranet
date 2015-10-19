<?php

namespace frontend\modules\fitandfast\controllers;

use frontend\models\Employee;
use frontend\models\FitfastTarget;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class ApproveController extends FitandfastMasterController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionEmployee()
    {
        $managerId = Yii::$app->user->identity->id;

        $employeeModels = Employee::find()
            ->where(
                'managerId=:managerId AND status=1 AND employeeId!=:managerId',
                [':managerId' => $managerId]
            )
            ->all();

        $fitfastTargetModels = FitfastTarget::find()
            ->andWhere('grade = 0')
            ->andWhere('file IS NOT NULL')
            ->andWhere(['IN', 'employeeId', ArrayHelper::map($employeeModels, 'employeeId', 'employeeId')]);

//        $employeeModels = Employee::model()->findAll(array(
//            'condition' => 'managerId=:managerId AND status=1 AND employeeId!=:managerId',
//            'params' => array(
//                ':managerId' => $managerId
//            )
//        ));
//
//        $fitfastTargetModels = FitfastTarget::model()->findAll(array(
//            'condition' => 'employeeId IN (' . implode(',', CHtml::listData($employeeModels, 'employeeId', 'employeeId')) . ') AND grade=0 AND file IS NOT NULL',
//            'order' => 'updateDateTime'
//        ));
//
//        $this->pageHeader = 'รายการรออนุมัติพนักงานในฝ่าย';

        $dataProvider = new ActiveDataProvider([
            'query' => $fitfastTargetModels
        ]);

        return $this->render('employee', compact('dataProvider'));
    }

    public function actionManager()
    {
        $employeeModels = Employee::find()
            ->where(
                'status=1 AND isManager=:isManager',
                [':isManager' => 1]
            )
            ->all();

        $fitfastTargetModels = FitfastTarget::find()
            ->andWhere('grade = 0')
            ->andWhere('file IS NOT NULL')
            ->andWhere(['IN', 'employeeId', ArrayHelper::map($employeeModels, 'employeeId', 'employeeId')]);

//        $employeeModels = Employee::model()->findAll(array(
//            'condition' => 'managerId=:managerId AND status=1 AND employeeId!=:managerId',
//            'params' => array(
//                ':managerId' => $managerId
//            )
//        ));
//
//        $fitfastTargetModels = FitfastTarget::model()->findAll(array(
//            'condition' => 'employeeId IN (' . implode(',', CHtml::listData($employeeModels, 'employeeId', 'employeeId')) . ') AND grade=0 AND file IS NOT NULL',
//            'order' => 'updateDateTime'
//        ));
//
//        $this->pageHeader = 'รายการรออนุมัติพนักงานในฝ่าย';

        $dataProvider = new ActiveDataProvider([
            'query' => $fitfastTargetModels
        ]);

        return $this->render('employee', compact('dataProvider'));
    }

    public function actionGrade()
    {
        if (isset($_POST['grade']) && isset($_POST['fitfastTargetId'])) {
            $res = [];
            if(FitfastTarget::saveGrade($_POST['fitfastTargetId'], $_POST['grade'])) {
                $fitfastTargetModel = FitfastTarget::findOne($_POST['fitfastTargetId']);
                $fitfastModel = $fitfastTargetModel->fitfast;
                $fitfastEmployeeModel = $fitfastModel->fitfastEmployee;

                $res['fitfastEmployee']['s'] = $fitfastEmployeeModel->halfS;
                $res['fitfastEmployee']['S'] = $fitfastEmployeeModel->S;
                $res['fitfastEmployee']['SS'] = $fitfastEmployeeModel->SS;
                $res['fitfastEmployee']['F'] = $fitfastEmployeeModel->F;
                $res['fitfastEmployee']['percent'] = $fitfastEmployeeModel->percent;

                $res['fitfast']['fitfastId'] = $fitfastModel->fitfastId;
                $res['fitfast']['s'] = $fitfastModel->halfS;
                $res['fitfast']['S'] = $fitfastModel->S;
                $res['fitfast']['SS'] = $fitfastModel->SS;
                $res['fitfast']['F'] = $fitfastModel->F;

                $res['fitfast-target']['grade'] = $fitfastTargetModel->gradeText;
                $res['fitfast-target']['fitfastTargetId'] = $_POST['fitfastTargetId'];
                $res['result'] = true;

                echo json_encode($res);
            }
        } else {
            $res['result'] = false;
            echo json_encode($res);
        }
    }

    public function actionUnapprove()
    {
        $unapproves = FitfastTarget::find()->where('month <= 9 and grade=0')->all();

        foreach($unapproves as $fft) {

            $_POST['grade'] = 'F';
            $_POST['fitfastTargetId'] = $fft->fitfastTargetId;

            $this->actionGrade();

            echo $fft->fitfastTargetId.', '.$fft->grade;
        }
    }

}
