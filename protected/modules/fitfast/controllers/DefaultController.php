<?php

class DefaultController extends Controller
{

	public $layout = '//layouts/cl1';
	public $editGradeUsersArray = array(
		'kbw',
		'npr');

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return array(
			array(
				'allow',
				'actions'=>array(
					'*'),
				'users'=>array(
					'@')
			),
//			array('allow',  // allow all users to perform 'index' and 'view' actions
//				'actions'=>array('index','view'),
//				'users'=>array('*'),
//			),
//			array('allow', // allow authenticated user to perform 'create' and 'update' actions
//				'actions'=>array('create','update'),
//				'users'=>array('@'),
//			),
//			array('allow', // allow admin user to perform 'admin' and 'delete' actions
//				'actions'=>array('admin','delete'),
//				'users'=>array('admin'),
//			),
//			array('deny',  // deny all users
//				'users'=>array('*'),
//			),
		);
	}

	public function actionSummary()
	{
		$data = array();
		$i = 0;
		foreach(Company::model()->findAll() as $companyModel)
		{
			$criteria = new CDbCriteria();
			$criteria->condition = 'companyId=:companyId AND status=1';
			$criteria->params = array(
				':companyId'=>$companyModel->companyId);
			$criteria->group = 'companyDivisionId';

			$companyDivisions = Employee::model()->findAll($criteria);

			if(!empty($companyDivisions))
			{
				$data[$i]['name'] = $companyModel->companyNameTh;
				$data[$i]['companyId'] = $companyModel->companyId;
//echo $companyModel->companyNameTh . '<br />';

				$j = 0;
				foreach($companyDivisions as $c)
				{
//echo $c->companyDivision->description . '<br />';

					$data[$i]['division'][$j]['name'] = $c->companyDivision->description;
					$data[$i]['division'][$j]['divisionId'] = $c->companyDivision->companyDivisionId;

					$j++;
				}
//echo '<hr />';
				$i++;
			}
		}

		$this->render('summary', array(
			'data'=>$data));
	}

	public function actionDivision($id1, $id2)
	{
		$companyId = $id1;
		$companyDivisionId = $id2;
		$data = array();
		$i = 0;

		$companyModel = Company::model()->find('companyId=' . $companyId);
		$data['company'] = $companyModel->companyNameTh;

		$companyDivisionModel = CompanyDivision::model()->find('companyDivisionId=' . $companyDivisionId);
		$data['division'] = $companyDivisionModel->description;

		$employeeModels = Employee::model()->findAll(array(
			'condition'=>'companyId=:companyId AND companyDivisionId=:companyDivisionId AND status=1 AND isManager=0',
			'params'=>array(
				'companyId'=>$companyId,
				'companyDivisionId'=>$companyDivisionId
			)
		));

		foreach($employeeModels as $employeeModel)
		{
			$data['employee'][$i]['name'] = $employeeModel->fnTh . ' ' . $employeeModel->lnTh;
			$data['employee'][$i]['employeeId'] = $employeeModel->employeeId;

			$i++;
		}

		$this->render('division', array(
			'data'=>$data));
	}

	public function actionIndex($id = Null)
	{
		$isUpload = true;
		//check access
		if(isset($id) && $id != Yii::app()->user->id)
		{
			$employee = Employee::model()->findByPk($id);
			$managerId = $employee->managerId;
			$isUpload = false;

			if(!in_array(Yii::app()->user->name, array(
					'kbw')) && Yii::app()->user->id != $managerId)
			{
				$this->redirect(Yii::app()->baseUrl);
			}
		}

		$id = (isset($id)) ? $id : Yii::app()->user->id;
		$forYear = (isset($_GET['forYear']) && !empty($_GET['forYear'])) ? $_GET['forYear'] : date('Y');
		$fitAndFastModels = FitAndFast::model()->findAll('employeeId=:employeeId AND forYear=:forYear', array(
			':employeeId'=>$id,
			':forYear'=>$forYear));

		$data = array();

		$i = 0;
		foreach($fitAndFastModels as $fitAndFastModel)
		{
			$data[$fitAndFastModel->type][$i]['fitAndFastId'] = $fitAndFastModel->fitAndFastId;
			$data[$fitAndFastModel->type][$i]['title'] = $fitAndFastModel->title;
			$data[$fitAndFastModel->type][$i]['description'] = $fitAndFastModel->description;

			foreach(FitAndFast::model()->targetArray as $k=> $v)
			{
				$data[$fitAndFastModel->type][$i][$v] = $fitAndFastModel->{$v};
				$data[$fitAndFastModel->type][$i][FitAndFast::model()->actualArray[$k]] = $fitAndFastModel->{FitAndFast::model()->actualArray[$k]};
				$data[$fitAndFastModel->type][$i][FitAndFast::model()->actualArray[$k] . 'DateTime'] = $fitAndFastModel->{FitAndFast::model()->actualArray[$k] . 'DateTime'};
				$data[$fitAndFastModel->type][$i][FitAndFast::model()->gradeArray[$k]] = $fitAndFastModel->{FitAndFast::model()->gradeArray[$k]};
				$data[$fitAndFastModel->type][$i][FitAndFast::model()->gradeArray[$k] . 'DateTime'] = $fitAndFastModel->{FitAndFast::model()->gradeArray[$k] . 'DateTime'};
				$data[$fitAndFastModel->type][$i][FitAndFast::model()->fileArray[$k]] = $fitAndFastModel->{FitAndFast::model()->fileArray[$k]};
				$data[$fitAndFastModel->type][$i][FitAndFast::model()->fileArray[$k] . 'DateTime'] = $fitAndFastModel->{FitAndFast::model()->fileArray[$k] . 'DateTime'};
				$data[$fitAndFastModel->type][$i][FitAndFast::model()->statusFitAndFastArray[$k]] = $fitAndFastModel->{FitAndFast::model()->statusFitAndFastArray[$k]};
			}

			$i++;
		}

		$employeeModel = Employee::model()->findByPk($id);
		$summary = FitAndFast::model()->gradeByEmployeeId($id);

		$this->render('index', array(
			'data'=>$data,
			'companyId'=>$employeeModel->companyId,
			'companyDivisionId'=>$employeeModel->companyDivisionId,
			'employeeName'=>$employeeModel->fnTh . ' ' . $employeeModel->lnTh,
			'summary'=>$summary,
			'isUpload'=>$isUpload,
		));
	}

	public function actionUpload($id1, $id2)
	{
		$model = FitAndFast::model()->findByPk($id1);
		$flag = false;

		if(isset($_POST['FitAndFast'][$id2]))
		{
			$file = CUploadedFile::getInstance($model, $id2);

			$transaction = Yii::app()->db->beginTransaction();
			try
			{
//fileName = employeeId_fitAndFastId_$id2
				$fileName = Yii::app()->user->id . '_' . $id1 . '_' . $id2 . '.pdf';
				$fileUrl = 'images/fitfast/' . $fileName;
				$model->{$id2} = $fileUrl;

				$k = array_search($id2, FitAndFast::model()->fileArray);
				$model->{FitAndFast::model()->statusFitAndFastArray[$k]} = FitAndFast::STATUS_UPLOADED;
				$model->{$id2 . 'DateTime'} = new CDbExpression('NOW()');

				if($model->save(false))
				{
//save file
					if($file->saveAs(Yii::app()->basePath . '/../' . $fileUrl))
					{
						$flag = true;
					}
				}

				if($flag)
				{
					$transaction->commit();
					$this->redirect($this->createUrl('index'));
				}
				else
				{
					$transaction->rollback();
				}
			}
			catch(Exception $e)
			{
				$transaction->rollback();
				throw new Exception($e->getMessage());
			}
		}
		$this->render('upload', array(
			'fitAndFastId'=>$id1,
			'field'=>$id2,
			'model'=>$model));
	}

	public function actionUpdateGrade()
	{
		if(isset($_POST))
		{
			$fitAndFastModel = FitAndFast::model()->findByPk($_POST['fitAndFastId']);

			//find array key
			$k = array_search($_POST['field'], FitAndFast::model()->gradeArray);
			$sumGrade = array();

			if($fitAndFastModel->sumGrade == NULL)
			{
				$sumGrade = array(
					's'=>0,
					'S'=>0,
					'SS'=>0,
					'F'=>0);
			}
			else
				$sumGrade = unserialize($fitAndFastModel->sumGrade);

			$this->writeToFile('/tmp/updateGrade', print_r($_POST, true));
			$this->writeToFile('/tmp/sumGrade', print_r($sumGrade, true));

			//restore when edit
			if($fitAndFastModel->{$_POST['field']} != NULL)
				$sumGrade[$fitAndFastModel->{$_POST['field']}] -= 1;

			if($fitAndFastModel->{$_POST['field']} != $_POST['grade'])
			{
				if($fitAndFastModel->{$_POST['field']} == NULL) //update
				{
					$grade = '';
					if($_POST['grade'] != 'F')
					{
						$grade = FitAndFast::model()->calculateGradeS($_POST['field'], $_POST['type']);
						$sumGrade[$grade] += 1; //calculate S
					}
					else
					{
						$sumGrade['F'] += 1;
						$grade = $_POST['grade'];
					}
				}
				else //edit
				{
					$grade = $_POST['grade'];
					$sumGrade[$grade] += 1;
				}

				$fitAndFastModel->$_POST['field'] = $grade;
			}
			else
			{
				$fitAndFastModel->$_POST['field'] = NULL;
			}
			$this->writeToFile('/tmp/sumGrade', print_r($sumGrade, true), 'a+');
			$fitAndFastModel->sumGrade = serialize($sumGrade);

			$fitAndFastModel->{$_POST['field'] . 'DateTime'} = new CDbExpression('NOW()');

			if($fitAndFastModel->save(false))
			{
				echo CJSON::encode(array(
					'status'=>true,
					'grade'=>$fitAndFastModel->$_POST['field'],
					'dateTime'=>$fitAndFastModel->{$_POST['field'] . 'DateTime'},
					'percent'=>FitAndFast::model()->calculatePercent($fitAndFastModel->forYear)
				));
			}
			else
			{
				echo CJSON::encode(array(
					'status'=>false,));
			}
		}
	}

}
