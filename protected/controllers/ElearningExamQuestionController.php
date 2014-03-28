<?php

class ElearningExamQuestionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/cl1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			// array('allow',  // allow all users to perform 'index' and 'view' actions
			// 	'actions'=>array('index','view'),
			// 	'users'=>array('*'),
			// ),
			// array('allow', // allow authenticated user to perform 'create' and 'update' actions
			// 	'actions'=>array('create','update'),
			// 	'users'=>array('@'),
			// ),
			// array('allow', // allow admin user to perform 'admin' and 'delete' actions
			// 	'actions'=>array('admin','delete'),
			// 	'users'=>array('admin'),
			// ),
			// array('deny',  // deny all users
			// 	'users'=>array('*'),
			// ),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ElearningExamQuestion;
		$choiceModel = new ElearningExamChoice;
		$choiceModels = null;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ElearningExamQuestion']))
		{
			$flag = false;
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$model->attributes=$_POST['ElearningExamQuestion'];

				if($model->save())
				{
					$questionId = Yii::app()->db->getLastInsertId();
					$i = 0;
					foreach ($_POST['ElearningExamChoice'] as $key => $value) 
					{
						$choiceModel = new ElearningExamChoice;
						$choiceModel->attributes = $value;
						$choiceModel->isCorrect = ($key == $_POST['isCorrect'])	? 1 : 0;
						$choiceModel->questionId = $questionId;

						$choiceModels[$key] = $choiceModel;

						if(!$choiceModel->save())
						{
							$i++;
						}
					}

					if (!$i) 
					{
						$flag = true;
					}
				}
			
				if($flag)
				{
					$transaction->commit();
					$this->redirect(array('view','id'=>$model->questionId));
				}
				else
				{
					$transaction->rollback();
				}
			}
			catch (Exception $e)
			{
				throw new Exception($e->getMessage());
				$transaction->rollback();
			}
			// if($model->save())
			// 	$this->redirect(array('view','id'=>$model->questionId));
		}

		$this->render('create',array(
			'model'=>$model,
			'choiceModel'=>$choiceModel,
			'choiceModels'=>$choiceModels,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$choiceModels = ElearningExamChoice::model()->findAll(array('condition'=>'questionId=:questionId', 'params'=>array(':questionId'=>$id)));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ElearningExamQuestion']))
		{
			$flag = false;
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$model->attributes=$_POST['ElearningExamQuestion'];

				if($model->save())
				{
					$questionId = Yii::app()->db->getLastInsertId();
					$i = 0;
					foreach ($_POST['ElearningExamChoice'] as $choiceId => $value) 
					{
						$choiceModel = ElearningExamChoice::model()->findByPk($choiceId);
						$choiceModel->attributes = $value;
						$choiceModel->isCorrect = ($choiceId == $_POST['isCorrect'])	? 1 : 0;

						$choiceModels[$key] = $choiceModel;

						if(!$choiceModel->save())
						{
							$i++;
						}
					}

					if (!$i) 
					{
						$flag = true;
					}
				}
			
				if($flag)
				{
					$transaction->commit();
					$this->redirect(array('view','id'=>$model->questionId));
				}
				else
				{
					$transaction->rollback();
				}
			}
			catch (Exception $e)
			{
				throw new Exception($e->getMessage());
				$transaction->rollback();
			}

			// $model->attributes=$_POST['ElearningExamQuestion'];
			// if($model->save())
			// 	$this->redirect(array('view','id'=>$model->questionId));
		}

		$this->render('update',array(
			'model'=>$model,
			'choiceModels'=>$choiceModels
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new ElearningExamQuestion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ElearningExamQuestion']))
			$model->attributes=$_GET['ElearningExamQuestion'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ElearningExamQuestion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ElearningExamQuestion::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ElearningExamQuestion $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='elearning-exam-question-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionImport()
	{
		/**
		 * c0 elearning
		 * c1 question no.
		 * c2 question
		 * c3 choice
		 * c4 isCorrect
		 */

		$flag = false;
		$transaction = Yii::app()->db->beginTransaction();
		try
		{
			$filePath = Yii::app()->basePath.'/../assets/exam.csv';
			$lines = file($filePath);
			$lines2 = file($filePath);
			$i = 0;
			$k = 0;
			foreach ($lines as $line) 
			{
				$items = explode('|', $line);
				if(!empty($items[1]))
				{
					$questionModel = new ElearningExamQuestion;
					$questionModel->title = $items[2];
					$questionModel->elearningId = $items[0];

					echo $items[2].'<br />';

					if($questionModel->save())
					{
						$questionId = Yii::app()->db->getLastInsertId();

						for($j=$i;$j<$i+4;$j++)
						{
							$items2 = explode('|', $lines2[$j]);
							$choiceModel = new ElearningExamChoice;
							$choiceModel->title = $items2[3];
							$choiceModel->isCorrect = $items2[4];
							$choiceModel->questionId = $questionId;

							if(!$choiceModel->save())
							{
								$isBreak = true;
								$k++;
								break;
							}
							echo $j.' : '.$items2[3].'<br />';
						}
						echo '<hr />';
					}
					else
						$isBreak = true;

					if($isBreak)
						break;
				}
				$i++;
			}

			if(!$k) $flag = true;
		
			if($flag)
			{
				$transaction->commit();
			}
			else
			{
				$transaction->rollback();
			}
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
			$transaction->rollback();
		}
	}
}
