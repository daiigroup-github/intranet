<?php

class DefaultController extends Controller
{

	public $layout = '//layouts/cl1';
	public $actualArray = array(
		'actualJan',
		'actualFeb',
		'actualMar',
		'actualApr',
		'actualMay',
		'actualJun',
		'actualJul',
		'actualAug',
		'actualSep',
		'actualOct',
		'actualNov',
		'actualDec'
	);
	public $gradeArray = array(
		'gradeJan',
		'gradeFeb',
		'gradeMar',
		'gradeApr',
		'gradeMay',
		'gradeJun',
		'gradeJul',
		'gradeAug',
		'gradeSep',
		'gradeOct',
		'gradeNov',
		'gradeDec'
	);
	public $targetArray = array(
		'targetJan',
		'targetFeb',
		'targetMar',
		'targetApr',
		'targetMay',
		'targetJun',
		'targetJul',
		'targetAug',
		'targetSep',
		'targetOct',
		'targetNov',
		'targetDec'
	);
	public $fileArray = array(
		'fileJan',
		'fileFeb',
		'fileMar',
		'fileApr',
		'fileMay',
		'fileJun',
		'fileJul',
		'fileAug',
		'fileSep',
		'fileOct',
		'fileNov',
		'fileDec'
	);

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

			foreach($this->targetArray as $k=> $v)
			{
				$data[$fitAndFastModel->type][$i][$v] = $fitAndFastModel->{$v};
				$data[$fitAndFastModel->type][$i][$this->actualArray[$k]] = $fitAndFastModel->{$this->actualArray[$k]};
				$data[$fitAndFastModel->type][$i][$this->gradeArray[$k]] = $fitAndFastModel->{$this->gradeArray[$k]};
				$data[$fitAndFastModel->type][$i][$this->fileArray[$k]] = $fitAndFastModel->{$this->fileArray[$k]};
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

				if($model->save())
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

			if($fitAndFastModel->$_POST['field'] != $_POST['grade'])
			{
				if($_POST['grade'] == 'S')
				{
					/**
					 * Performance
					 * 1 S if approve before 20th of next month
					 * 0.5 S if approve after 20th of next month and before the end of next month
					 *
					 * Implement
					 * 2 S if approve before 20th of next month
					 * 1 S if approve after 20th of next month
					 */
					$today = strtotime(date('Y-m-d'));
					$fitAndFastMonth = array_search($_POST['field'], $this->gradeArray);
					$next20th = strtotime(date('Y') . '-' . ($fitAndFastModel + 1) . '-20' + ' +1 month');

					$sPoint = 0;
					$fPoint = 0;

					if($today < $next20th)
					{
						if($_POST['type'] == 1) // Performance
						{
							$sPoint = 1;
						}
						else //Implement
						{
							$sPoint = 2;
						}
					}
					else
					{
						//late
						if($_POST['type'] == 1) // Performance
						{
							$sPoint = 0.5;
						}
						else //Implement
						{
							$sPoint = 1;
						}
					}

					$fitAndFastModel->sumS += $sPoint;

					//change grade from s or S to F
					switch($fitAndFastModel->{$_POST['field']})
					{
						case 's'://0.5S
							$fitAndFastModel->sumS -= 0.5;
							break;

						case 'S'://S
							$fitAndFastModel->sumS -= 1;
							break;

						case 'SS'://0.5S
							$fitAndFastModel->sumS -= 2;
							break;

						case 'F'://F
							$fitAndFastModel->sumF -= 1;
							break;
					}
				}

				if($_POST['grade'] == 'F')
				{
					$fitAndFastModel->sumF += 1;

					if($fitAndFastModel->$_POST['field'] == 'S')
						$fitAndFastModel->sumS -= 1;
				}

				$fitAndFastModel->$_POST['field'] = $_POST['grade'];
			}
			else
			{
				$fitAndFastModel->$_POST['field'] = NULL;

				if($_POST['grade'] == 'S')
					$fitAndFastModel->sumS -= 1;

				if($_POST['grade'] == 'F')
					$fitAndFastModel->sumF -= 1;
			}

			if($fitAndFastModel->save())
			{
				echo CJSON::encode(array(
					'status'=>true,
					'grade'=>$fitAndFastModel->$_POST['field']
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
