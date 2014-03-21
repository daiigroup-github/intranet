<?php

class HomeController extends Controller {

	public $layout = '//layouts/cl2';

	public function actionIndex() {
		if (Yii::app()->user->isGuest)
			$this->redirect(Yii::app()->createUrl('/'));

		$model = new LoginForm();
		$elearningExamModel = ElearningExam::model()->hasExamToday();

		$this->render('index', array(
			'model' => $model,
			'elearningExamModel' => $elearningExamModel,
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

	public function actionShowroom() {
		$this->render('showroom');
	}

}