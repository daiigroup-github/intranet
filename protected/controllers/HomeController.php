<?php

class HomeController extends MasterController
{

    public $layout = '//layouts/cl2';

    public function actionIndex()
    {
        if (Yii::app()->user->isGuest)
            $this->redirect(Yii::app()->createUrl('/'));

        $model = new LoginForm();
        $elearningExamModel = ElearningExam::model()->hasExamToday();

        $fitfastEmployeeModel = FitfastEmployee::model()->find(array(
            'condition' => 'employeeId=:employeeId AND forYear=:forYear',
            'params' => array(
                ':employeeId' => Yii::app()->user->id,
                ':forYear' => date('Y'),
            )
        ));
        $summary = FitfastEmployee::model()->calculatePercentByEmployeeIdAndYear(Yii::app()->user->id, date('Y'));

        $waitForUploads = array();
        foreach ($fitfastEmployeeModel->fitfasts as $fitfast) {
            $fitfastTargetModels = FitfastTarget::model()->findAll(array(
                'condition' => 'fitfastId=:fitfastId AND status=1 AND month<=:month',
                'params' => array(
                    ':fitfastId' => $fitfast->fitfastId,
                    ':month' => date('m'),
                )
            ));

            if($fitfastTargetModels){
                $waitForUploads[$fitfast->fitfastId]['title'] = $fitfast->title;

                foreach($fitfastTargetModels as $fitfastTargetModel) {
                    $waitForUploads[$fitfast->fitfastId]['fitfastTarget'][$fitfastTargetModel->fitfastTargetId]['target'] = $fitfastTargetModel->target;
                    $waitForUploads[$fitfast->fitfastId]['fitfastTarget'][$fitfastTargetModel->fitfastTargetId]['month'] = $fitfastTargetModel->month;
                }
            }
        }

        if (Employee::model()->isManager()) {
            $employeeModel = Employee::model()->findByPk(Yii::app()->user->id);
            $divisionFitAndFastPercent = $fitfastEmployeeModel->calculatePercentByDivisionId($employeeModel->companyId, $employeeModel->companyDivisionId, date('Y'));
        }

        //print_r($waitForUploads);

        $this->render('index', array(
            'model' => $model,
            'elearningExamModel' => $elearningExamModel,
            'summary' => $summary,
            'divisionFitAndFastPercent' => isset($divisionFitAndFastPercent) ? $divisionFitAndFastPercent : NULL,
            'waitForUploads'=>$waitForUploads
        ));
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

    public function actionNotice()
    {
        if (isset($_GET["noticeType"])) {
            $noticeType = $_GET["noticeType"];
        } else {
            $noticeType = 0;
        }
        $this->render("notice", array(
            'noticeType' => $noticeType
        ));
    }

    public function actionShowroom()
    {
        $this->render('showroom');
    }

}
