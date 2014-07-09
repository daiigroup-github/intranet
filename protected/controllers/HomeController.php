<?php

class HomeController extends Controller
{

	public $layout = '//layouts/cl2';

	public function actionIndex()
	{
		if(Yii::app()->user->isGuest)
			$this->redirect(Yii::app()->createUrl('/'));

		$model = new LoginForm();
		$elearningExamModel = ElearningExam::model()->hasExamToday();
		$summary = FitAndFast::model()->gradeByEmployeeId(Yii::app()->user->id);

		if(Employee::model()->isManager())
		{
			$employeeModel = Employee::model()->findByPk(Yii::app()->user->id);
			$divisionFitAndFastPercent = FitAndFast::model()->divisionPercent($employeeModel->companyDivisionId);
		}

		//print_r(sizeof(FitAndFast::model()->findAllWaitingForGradeInCompanyDivision(7)));

		$this->render('index', array(
			'model'=>$model,
			'elearningExamModel'=>$elearningExamModel,
			'summary'=>$summary,
			'divisionFitAndFastPercent'=>isset($divisionFitAndFastPercent) ? $divisionFitAndFastPercent : NULL,
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
