<?php

class DocumentItemController extends Controller
{

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';

	public function filters()
	{
		return array(
			//'accessControl', // perform access control for CRUD operations
			'rights',
		);
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
		$model = new DocumentItem;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DocumentItem']))
		{
			$model->attributes = $_POST['DocumentItem'];
			if($model->save())
				$this->redirect(array(
					'view',
					'id'=>$model->documentItemId));
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

		if(isset($_POST['DocumentItem']))
		{
			$model->attributes = $_POST['DocumentItem'];
			if($model->save())
				$this->redirect(array(
					'view',
					'id'=>$model->documentItemId));
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
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
						'admin'));
		}
		else
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('DocumentItem');
		$this->render('index', array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new DocumentItem('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DocumentItem']))
			$model->attributes = $_GET['DocumentItem'];

		$this->render('admin', array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model = DocumentItem::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'document-item-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionDisableDocumentItem($id)
	{
		$docItem = DocumentItem::model()->findByPk($id);
		if(isset($docItem))
		{
			$docItem->status = 0;
			if(!$docItem->save())
			{
				echo "ไม่สามารถ ลบรายการ ได้";
			}
			else
			{
				echo "เสร็จสมบูรณ์";
			}
		}
	}

	public function actionApproveDocumentItem($id)
	{
		$docItem = DocumentItem::model()->findByPk($id);
		if(isset($docItem))
		{
			$docItem->status = 2;
			if(!$docItem->save())
			{
				echo "ไม่สามารถ ลบรายการ ได้";
			}
			else
			{
				echo "เสร็จสมบูรณ์";
			}
		}
	}

	public function actionRejectDocumentItem($id)
	{
		$docItem = DocumentItem::model()->findByPk($id);
		if(isset($docItem))
		{
			$docItem->status = 3;
			if(!$docItem->save())
			{
				echo "ไม่สามารถ ลบรายการ ได้";
			}
			else
			{
				echo "เสร็จสมบูรณ์";
			}
		}
	}

}
