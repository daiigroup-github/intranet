<?php

class HomeController extends Controller
{

	public $layout = '//layouts/cl2';

	public function actionIndex()
	{
		$divisionFitAndFast = array();
		if(Yii::app()->user->isGuest)
			$this->redirect(Yii::app()->createUrl('/'));

		$model = new LoginForm();
		$elearningExamModel = ElearningExam::model()->hasExamToday();
		$summary = FitAndFast::model()->gradeByEmployeeId(Yii::app()->user->id);
		$divisionFitAndFast = array();

		if(Employee::model()->isManager())
		{
			$employeeModel = Employee::model()->findByPk(Yii::app()->user->id);
//			$divisionFitAndFastPercent = FitfastEmployee::model()->calculatePercentByDivisionId($employeeModel->companyId, $employeeModel->companyDivisionId, date('Y'));

			$divisionFitAndFast = array(
				'percent'=>FitfastEmployee::model()->calculatePercentByDivisionId($employeeModel->companyId, $employeeModel->companyDivisionId, date('Y')),
				'grades'=>FitfastEmployee::model()->countGradeByDivision($employeeModel->companyId, $employeeModel->companyDivisionId, date('Y'))
			);
		}

		//print_r(sizeof(FitAndFast::model()->findAllWaitingForGradeInCompanyDivision(7)));
		$fitfastEmployeeModel = FitfastEmployee::model()->find(array(
			'condition'=>'employeeId=:employeeId',
			'params'=>array(
				':employeeId'=>Yii::app()->user->id,
			)
		));

		$this->render('index', array(
			'model'=>$model,
			'elearningExamModel'=>$elearningExamModel,
			'summary'=>$summary,
			'divisionFitAndFast'=>$divisionFitAndFast,
			'fitfastEmployeeModel'=>$fitfastEmployeeModel
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
		if(isset($_GET["noticeType"]))
		{
			$noticeType = $_GET["noticeType"];
		}
		else
		{
			$noticeType = 0;
		}
		$this->render("notice", array(
			'noticeType'=>$noticeType));
	}

	public function actionShowroom()
	{
		$this->render('showroom');
	}

}
