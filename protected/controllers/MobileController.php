<?php

class MobileController extends Controller
{

	public function actionIndex()
	{
		//$this->render('index');

		$a = array(
			'Kurtumm' => 'Puhng');

		header("Cache-Control: no-cache");
		header("Pragma: no-cache");
		header("Cache-Control: no-cache, must-revalidate");
		header('Content-type: text/json');
		echo json_encode($a);
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
	public function echoJson($res)
	{
		header("Cache-Control: no-cache");
		header("Pragma: no-cache");
		header("Cache-Control: no-cache, must-revalidate");
		header('Content-type: text/json');
		echo json_encode($res);
	}

	public function actionLogin()
	{
		if (isset($_POST['username']) && isset($_POST['password']))
		{
			$model = new LoginForm();
			$model->username = $_POST['username'];
			$model->password = $_POST['password'];
			$model->rememberMe = true;
			// validate user input and redirect to the previous page if valid
			if ($model->validate() && $model->login())
			{
				$name = Yii::app()->user->name;

				$res['result'] = true;
				$res['url']['engineerUrl'] = 'mobile/engineer';
				$res['url']['saleUrl'] = 'mobile/sale';
			}
			else
			{
				//login failed
				$res['result'] = false;
				$res['error'] = 'Log in failed.';
			}

			$this->echoJson($res);
		}
	}

	public function actionEngineer()
	{
		$user = Employee::model()->findByPk(Yii::app()->user->id);
		$companyValue = $user->companyValue;

		$criteria = new CDbCriteria();
		$criteria->condition = 'status=1 AND isEngineer=1 AND companyId&:companyValue>0';
		$criteria->params = array(
			':companyValue' => $companyValue);

		$models = Employee::model()->findAll($criteria);
		$i = 0;
		foreach ($models as $model)
		{
			$res[$i]['name'] = $model->fnTh . ' ' . $model->lnTh;
			$res[$i]['employeeId'] = $model->employeeId;

			$i++;
		}

		Controller::writeToFile('/tmp/mobile_engineer', print_r($res, true));

		$this->echoJson($res);
	}

	public function actionSale()
	{
		$user = Employee::model()->findByPk(Yii::app()->user->id);
		$companyValue = $user->companyValue;

		$criteria = new CDbCriteria();
		$criteria->condition = 'status=1 AND isSale=1';

		$models = Employee::model()->findAll($criteria);
		$i = 0;
		foreach ($models as $model)
		{
			$res[$i]['name'] = $model->fnTh . ' ' . $model->lnTh;
			$res[$i]['employeeId'] = $model->employeeId;

			$i++;
		}

		$this->echoJson($res);
	}

	public function actionMileageEmployee()
	{
		$user = Employee::model()->findByPk(Yii::app()->user->id);
		$companyValue = $user->companyValue;

		$criteria = new CDbCriteria();
		$criteria->condition = 'status=1';

		$models = Employee::model()->findAll($criteria);
		$i = 0;
		foreach ($models as $model)
		{
			$res[$i]['name'] = $model->fnTh . ' ' . $model->lnTh;
			$res[$i]['employeeId'] = $model->employeeId;

			$i++;
		}

		$this->echoJson($res);
	}

}