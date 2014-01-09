<?php

class ElearningExamController extends Controller
{

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/cl1';

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
			array(
				'allow', // deny all users
				'users'=>array(
					'*'),
			),
			array(
				'deny', // deny all users
				'users'=>array(
					'*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);

		if($model->status)
		{
			//ไม่สามารถสอบใหม่ได้
			echo 'ไม่สามารถสอบใหม่ได้';
		}
		else if(!Yii::app()->user->id)// != $model->employeeId)
		{
			//สอบของคนอื่นม่ได้
			echo 'ไม่สามารถสอบแทนกันได้';
		}
		else
		{
			//gen question
			$elearningModels = Elearning::model()->findAll('status=1');
			$i = 0;

			foreach($elearningModels as $elearningModel)
			{
				$criteria = new CDbCriteria;
				$criteria->condition = 'elearningId=:elearningId AND status=1';
				$criteria->params = array(
					':elearningId'=>$elearningModel->elearningId);
				$criteria->limit = $elearningModel->numberOfQuestion;
				$criteria->order = 'RAND()';

				$questions = ElearningExamQuestion::model()->findAll($criteria);

				foreach($questions as $question)
				{
					$questionArray[$i]['questionId'] = $question->questionId;
					$questionArray[$i]['title'] = $question->title;
					$questionArray[$i]['description'] = $question->description;

					$criteria2 = new CDbCriteria;
					$criteria2->condition = 'questionId=:questionId';
					$criteria2->params = array(
						':questionId'=>$question->questionId);
					$criteria2->order = 'RAND()';

					$choices = ElearningExamChoice::model()->findAll($criteria2);

					foreach($choices as $choice)
					{
						$questionArray[$i]['choice'][$j]['choiceId'] = $choice->choiceId;
						$questionArray[$i]['choice'][$j]['title'] = $choice->title;
						$questionArray[$i]['choice'][$j]['description'] = $choice->description;
						$questionArray[$i]['choice'][$j]['isCorrect'] = $choice->isCorrect;
						$j++;
					}

					$i++;
				}
			}

			shuffle($questionArray);

			$model->status = 1;
			$model->save();

			$this->render('view', array(
				'questionArray'=>$questionArray,
				'elearningExamId'=>$id,
			));
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new ElearningExam;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ElearningExam']))
		{
			$model->attributes = $_POST['ElearningExam'];
			if($model->save())
				$this->redirect(array(
					'view',
					'id'=>$model->elearningExamId));
		}

		$this->render('create', array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ElearningExam']))
		{
			$model->attributes = $_POST['ElearningExam'];
			if($model->save())
				$this->redirect(array(
					'view',
					'id'=>$model->elearningExamId));
		}

		$this->render('update', array(
			'model'=>$model,
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
					'admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('ElearningExam');
		$this->render('index', array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new ElearningExam('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ElearningExam']))
			$model->attributes = $_GET['ElearningExam'];

		$this->render('admin', array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ElearningExam the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = ElearningExam::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ElearningExam $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'elearning-exam-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionSubmitExam($id)
	{
		if(isset($_POST['answer']))
		{
			$point = 0;
			foreach($_POST['answer'] as $questionId=> $choiceId)
			{
				$elearningExamItemModel = new ElearningExamItem;
				$choiceModel = ElearningExamChoice::model()->findByPk($choiceId);
				$elearningExamItemModel->elearningExamId = $id;
				$elearningExamItemModel->questionId = $questionId;
				$elearningExamItemModel->choiceId = $choiceId;
				$elearningExamItemModel->isCorrect = $choiceModel->isCorrect;
				$elearningExamItemModel->save();

				if($choiceModel->isCorrect)
					$point++;
			}


			$elearningExamItemModel = ElearningExam::model()->findByPk($id);
			$elearningExamItemModel->point = $point;
			$elearningExamItemModel->save();
			$this->writeToFile('/tmp/exam', print_r($elearningExamItemModel->point, true));

			$res['success'] = true;
			$res['point'] = $point;

			echo CJSON::encode($res);
		}
	}

}
