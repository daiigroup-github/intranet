<?php

class ApproveController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }

    // Uncomment the following methods and override them if needed
    /*
    public function filters()
    {
        // return the filter configuration for this controller, e.g.:
        return array(
            'inlineFilterName',
            array(
                'class'=>'path.to.FilterClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }

    public function actions()
    {
        // return external action classes, e.g.:
        return array(
            'action1'=>'path.to.ActionClass',
            'action2'=>array(
                'class'=>'path.to.AnotherActionClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }
    */

    public function actionEmployee()
    {
        /**
         * Only Manager & HR Manager can access.
         * Manager can see all emp by managerId.
         * HR Manager can see all waiting for grade.
         */
        $managerId = Yii::app()->user->id;

        $employeeModels = Employee::model()->findAll(array(
            'condition' => 'managerId=:managerId AND status=1 AND employeeId!=:managerId',
            'params' => array(
                ':managerId' => $managerId
            )
        ));

        $fitfastTargetModels = FitfastTarget::model()->findAll(array(
            'condition' => 'employeeId IN (' . implode(',', CHtml::listData($employeeModels, 'employeeId', 'employeeId')) . ') AND grade=0 AND file IS NOT NULL',
            'order' => 'updateDateTime'
        ));

        $this->pageHeader = 'รายการรออนุมัติพนักงานในฝ่าย';

        $this->render('employee', array(
            'fitfastTargetModels' => $fitfastTargetModels
        ));
    }

    public function actionManager()
    {
        /**
         * NSY & HR Manager can access.
         * HR Manager can see all waiting for grade.
         */
        $employeeModels = Employee::model()->findAll(array(
            'condition' => 'isManager=1 AND status=1',
        ));

        $fitfastTargetModels = FitfastTarget::model()->findAll(array(
            'condition' => 'employeeId IN (' . implode(',', CHtml::listData($employeeModels, 'employeeId', 'employeeId')) . ') AND grade=0 AND file IS NOT NULL',
            'order' => 'updateDateTime'
        ));

        $this->pageHeader = 'รายการรออนุมัติผู้จัดการฝ่าย';

        $this->render('employee', array(
            'fitfastTargetModels' => $fitfastTargetModels
        ));
    }
}