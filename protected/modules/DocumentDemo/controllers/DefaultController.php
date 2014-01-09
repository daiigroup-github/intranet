<?php

class DefaultController extends Controller
{

	public function actionIndex()
	{
		$model = new DocumentType('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DocumentType']))
			$model->attributes = $_GET['DocumentType'];

		$this->render('index', array(
			'model'=>$model
		));
	}

	public function actionNewDocument()
	{
		if(isset($_GET['documentTypeId']))
		{
			$model = DocumentType::model()->findByPk($_GET['documentTypeId']);
			$documentItemModel = new DocumentItem;

			$this->render('createDocument', array(
				'model'=>$model,
				'documentItemModel'=>$documentItemModel,
			));
		}
	}

}
