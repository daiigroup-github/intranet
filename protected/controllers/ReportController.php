<?php

class ReportController extends Controller
{

	public $layout = '//layouts/cl2';

	public function actionIndex()
	{
		
	}

	public function actionRequisitionAdmin()
	{

		$model = Report::model();
		$this->render('/report/admin/requisition', array(
			'model' => $model));
	}

}

