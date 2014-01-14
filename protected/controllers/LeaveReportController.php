<?php

class LeaveReportController extends Controller
{

	public function actionIndex()
	{
		$leaveModel = new Leave;
		$employeeModels = null;

		if (isset($_POST['Leave']))
		{
			$startDate = $_POST['Leave']['startDate'];
			$endDate = $_POST['Leave']['endDate'];
			$companyId = $_POST['Leave']['companyId'];
			$inAround = $_POST['Leave']['inAround'];

			$employeeModels = Employee::model()->getAllLeaveEmployee($startDate, $endDate, $companyId);
			$leaveModel->startDate = $startDate;
			$leaveModel->endDate = $endDate;
			$leaveModel->inAround = $inAround;
		}

		$this->render('index', array(
			'leaveModel' => $leaveModel,
			'employeeModels' => $employeeModels));
	}

	public function actionFixTimeReport()
	{
		$documentItem = new DocumentItem();
		$employeeModels = null;

		if (isset($_POST['DocumentItem']))
		{
			$startDate = $_POST['DocumentItem']['startDate'];
			$endDate = $_POST['DocumentItem']['endDate'];
			$companyId = $_POST['DocumentItem']['companyId'];
			$inAround = $_POST['DocumentItem']['inAround'];

			$employeeModels = Employee::model()->getAllFixTimeEmployee($startDate, $endDate, $companyId);
			$documentItem->startDate = $startDate;
			$documentItem->endDate = $endDate;
			$documentItem->inAround = $inAround;
		}

		$this->render('timeFix', array(
			'documentItem' => $documentItem,
			'employeeModels' => $employeeModels));
	}

	public function actionLeaveReport()
	{
		$leaveModel = new Leave;
		$employeeModels = null;

		if (isset($_POST['Leave']))
		{
			$startDate = $_POST['Leave']['startDate'];
			$endDate = $_POST['Leave']['endDate'];

			$employeeModels = Employee::model()->getAllLeaveEmployee($startDate, $endDate, '', Yii::app()->user->id);
			$leaveModel->startDate = $startDate;
			$leaveModel->endDate = $endDate;
		}

		$this->render('index', array(
			'leaveModel' => $leaveModel,
			'employeeModels' => $employeeModels));
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

	public function actionUpdateLeaveItemStatus($id)
	{
		//$this->writeToFile('/tmp/leaveReport', $id);
		$leaveItemModel = LeaveItem::model()->findByPk($id);
		$leaveItemModel->status = 1;
		$leaveItemModel->save(false);
	}

	public function actionUpdateLeaveItemWrongStatus($id)
	{
		//$this->writeToFile('/tmp/leaveReport', $id);
		$leaveItemModel = LeaveItem::model()->findByPk($id);
		$leaveItemModel->status = 2;
		$leaveItemModel->save(false);
	}

	public function actionUpdateFixTimeItemStatus($id)
	{
		//$this->writeToFile('/tmp/leaveReport', $id);
		$documentItemModel = DocumentItem::model()->findByPk($id);
		$documentItemModel->status = 4;
		$documentItemModel->save(false);
	}

	public function actionSummaryLeaveReport()
	{
		$leaveModel = new Leave;
		$companyId = NULL;
		$startDate = date("Y-m-d", mktime(0, 0, 0, date("12"), date("23"), date("Y") - 1));
		$endDate = date("Y-m-d", mktime(0, 0, 0, date("12"), date("22"), date("Y")));


		if (isset($_GET['Leave']))
		{
			$startDate = $_GET['Leave']['startDate'];
			$endDate = $_GET['Leave']['endDate'];
			$companyId = $_GET['Leave']['companyId'];
		}
		$employeeModels = Employee::model()->getAllSummaryLeaveEmployee($startDate, $endDate, $companyId, null, 2);
		$leaveModel->startDate = $startDate;
		$leaveModel->endDate = $endDate;

		$this->render('summary', array(
			'leaveModel' => $leaveModel,
			'dataProvider' => $employeeModels));
	}

}

