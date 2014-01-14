<?php

class EmployeeResignJobController extends Controller
{

	public function filters()
	{
		return array(
			//'accessControl', // perform access control for CRUD operations
			//'rights',
		);
	}

	public function actionIndex()
	{
		Employee::model()->UpdateResignEmployee();
	}

}