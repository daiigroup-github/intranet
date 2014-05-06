<?php

class TheaterShowtimeController extends MasterController
{

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/cl2';

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
			/*
			  array('allow',  // allow all users to perform 'index' and 'view' actions
			  'actions'=>array('index','view'),
			  'users'=>array('*'),
			  ),
			  array('allow', // allow authenticated user to perform 'create' and 'update' actions
			  'actions'=>array('create','update'),
			  'users'=>array('@'),
			  ),
			  array('allow', // allow admin user to perform 'admin' and 'delete' actions
			  'actions'=>array('admin','delete'),
			  'users'=>array('admin'),
			  ),
			  array('deny',  // deny all users
			  'users'=>array('*'),
			  ),
			 */
		);

		/*
		  $result = array();
		  return CMap::mergeArray(parent::rules(), $result);
		 */
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view', array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new TheaterShowtime;
		$showtime = new TheaterShowtime();
		if(isset($_GET["theaterMovieId"]))
		{
			$model->theaterMovieId = $_GET["theaterMovieId"];
			$showtime->theaterMovieId = $_GET["theaterMovieId"];
		}


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TheaterShowtime']))
		{
			$flag = false;
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$model->attributes = $_POST['TheaterShowtime'];

				$dupShowtime = TheaterShowtime::model()->find("theaterId = :theaterId AND showDate =:showDate", array(
					":theaterId"=>$_POST["TheaterShowtime"]["theaterId"],
					":showDate"=>$_POST["TheaterShowtime"]["showDate"]));
				if(isset($dupShowtime) && count($dupShowtime) > 0)
				{
					$model->addError("theaterShowtineId", "มี Showtime นี้ในระบบแล้ว!!");
				}

				if($model->validate(null, FALSE))
				{
					if($model->save())
					{
						$flag = true;
					}
				}

				if($flag)
				{
					$transaction->commit();
					$this->redirect(array(
						'create?theaterMovieId=' . $model->theaterMovieId,));
				}
				else
				{
					$transaction->rollback();
				}
			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());
				$transaction->rollback();
			}
		}

		$this->render('create', array(
			'model'=>$model,
			'showtime'=>$showtime
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

		if(isset($_POST['TheaterShowtime']))
		{
			$flag = false;
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$model->attributes = $_POST['TheaterShowtime'];


				if($model->save())
				{
					$flag = true;
				}

				if($flag)
				{
					$transaction->commit();
					$this->redirect(array(
						'create?theaterMovieId=' . $model->theaterMovieId));
				}
				else
				{
					$transaction->rollback();
				}
			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());
				$transaction->rollback();
			}
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
	public function actionAdmin()
	{
		$dataProvider = new CActiveDataProvider('TheaterShowtime');
		$this->render('admin', array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model = new TheaterShowtime('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TheaterShowtime']))
			$model->attributes = $_GET['TheaterShowtime'];

		$this->render('index', array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TheaterShowtime the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = TheaterShowtime::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TheaterShowtime $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'theater-showtime-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionLoadShowtime($id)
	{
		$result = array();
		$model = $this->loadModel($id);
		$result["theaterShowtimeId"] = $model->theaterShowtimeId;
		$result["theaterId"] = $model->theaterId;
		$result["showDate"] = $model->showDate;
		echo CJSON::encode($result);
	}

	public function actionUpdateAjax($id)
	{
		$flag = false;

//		if(isset($_POST["id"]))
//		{
//			$id = $_POST["id"];
//		}
		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TheaterShowtime']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$model->attributes = $_POST['TheaterShowtime'];


				if($model->save())
				{
					$flag = true;
				}

				if($flag)
				{
					$transaction->commit();
					$this->redirect(array(
						'create?theaterMovieId=' . $model->theaterShowtimeId,));
				}
				else
				{
					$transaction->rollback();
				}
			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());
				$transaction->rollback();
			}
		}
	}

}
