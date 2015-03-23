<?php

class FitfastTargetController extends FitandfastMasterController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2';

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
        return array(/*
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
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new FitfastTarget;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['FitfastTarget'])) {
            $flag = false;
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $model->attributes = $_POST['FitfastTarget'];

                $folderFile = 'folderName';
                $file = CUploadedFile::getInstance($model, 'file');
                if (isset($file) && !empty($file)) {
                    $imgType = explode('.', $file->name);
                    $imgType = $imgType[count($imgType) - 1];
                    $imageUrl = '/images/' . $folderfile . '/' . time() . '-' . rand(0, 999999) . '.' . $imgType;
                    $imagePathfile = '/../' . $imageUrl;
                    $model->file = $imageUrl;
                } else {
                    $model->file = null;
                }

                if ($model->save()) {
                    if (isset($file) && !empty($file)) {
                        if (!file_exists(Yii::app()->getBasePath() . '/../' . 'images/' . $folderfile)) {
                            mkdir(Yii::app()->getBasePath() . '/../' . 'images/' . $folderfile, 0777);
                        }

                        if ($file->saveAs(Yii::app()->getBasePath() . $imagePathfile)) {
                            $flag = true;
                        } else {
                            $flag = false;
                        }
                    } else
                        $flag = true;
                }

                if ($flag) {
                    $transaction->commit();
                    $this->redirect(array('view', 'id' => $model->fitfastTargetId));
                } else {
                    $transaction->rollback();
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
                $transaction->rollback();
            }

        }

        $this->render('create', array(
            'model' => $model,
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

        if (isset($_POST['FitfastTarget'])) {
            $flag = false;
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $model->attributes = $_POST['FitfastTarget'];

                if ($model->save()) {
                    $flag = true;
                }

                if ($flag) {
                    $transaction->commit();
                    $this->redirect(array('view', 'id' => $model->fitfastTargetId));
                } else {
                    $transaction->rollback();
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
                $transaction->rollback();
            }
        }

        $this->render('update', array(
            'model' => $model,
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
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionAdmin()
    {
        $dataProvider = new CActiveDataProvider('FitfastTarget');
        $this->render('admin', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionIndex()
    {
        $model = new FitfastTarget('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['FitfastTarget']))
            $model->attributes = $_GET['FitfastTarget'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return FitfastTarget the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = FitfastTarget::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param FitfastTarget $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'fitfast-target-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * @param $id
     * @param null $g
     * @throws CHttpException
     * @throws Exception
     */
    public function actionChangeGrade($id, $g = null)
    {
        $model = $this->loadModel($id);

        if ($model->grade == 0 && !isset($g)) {
            echo CJSON::encode(array('error' => 'ยังไม่ได้ให้เกรด ไม่สามารถยกเลิกได้'));
            exit();
        }

        if ($model->grade != 0 && $model->gradeText($model->grade) == $g) {
            echo CJSON::encode(array('error' => 'ไม่สามารถให้เกรดเดิมซ้ำได้'));
            exit();
        }

        $oldGrade = $model->grade;

        $flag = false;
        $transaction = Yii::app()->db->beginTransaction();
        try {
            //code here
            $model->grade = isset($g) ? $model->gradeValue($g) : 0;
            $this->writeToFile('/tmp/cg', print_r(compact('g'), true));

            $fitfastModel = $model->fitfast;
            $fieldName = array_search(strval(isset($g) ? $g : $model->gradeText($oldGrade)), $fitfastModel->attributeLabels());

            $fitfastEmployeeModel = $fitfastModel->fitfastEmployee;
            if (isset($g)) {
                if ($g != 'F') {
                    $fitfastModel->{$fieldName} += 1;
                    $fitfastEmployeeModel->{$fieldName} += 1;
                } else {
                    $fitfastModel->{$fieldName} -= 1;
                    $fitfastEmployeeModel->{$fieldName} -= 1;
                }
            }

            if ($oldGrade != 0 || !isset($g)) {
                $oldFieldName = array_search($model->gradeText($oldGrade), $fitfastModel->attributeLabels());
                if ($oldFieldName != 'F') {
                    $fitfastModel->{$oldFieldName} -= 1;
                    $fitfastEmployeeModel->{$oldFieldName} -= 1;
                } else {
                    $fitfastModel->{$oldFieldName} += 1;
                    $fitfastEmployeeModel->{$oldFieldName} += 1;
                }
            }

            $fitfastEmployeeModel->percent = $fitfastEmployeeModel->calculatePercent();
            $this->writeToFile('/tmp/ftc', print_r(compact('oldGrade', 'oldGradeText', 'fieldName'), true));

            if ($model->save() && $fitfastModel->save() && $fitfastEmployeeModel->save()) {
                $flag = true;
            }

            $res = array();

            if ($flag) {
                $transaction->commit();

                /**
                 * update fitfastEmployee grades & this fitfastTargetId
                 */
                $res['fitfastEmployee']['s'] = $fitfastEmployeeModel->halfS;
                $res['fitfastEmployee']['S'] = $fitfastEmployeeModel->S;
                $res['fitfastEmployee']['SS'] = $fitfastEmployeeModel->SS;
                $res['fitfastEmployee']['F'] = $fitfastEmployeeModel->F;
                $res['fitfastEmployee']['percent'] = $fitfastEmployeeModel->percent;

                $res['fitfast']['fitfastId'] = $fitfastModel->fitfastId;
                $res['fitfast']['s'] = $fitfastModel->halfS;
                $res['fitfast']['S'] = $fitfastModel->S;
                $res['fitfast']['SS'] = $fitfastModel->SS;
                $res['fitfast']['F'] = $fitfastModel->F;

                $res['fitfastTarget']['grade'] = isset($g) ? $g : 0;
                $res['fitfastTarget']['fitfastTargetId'] = $id;
                $res['result'] = true;
            } else {
                $transaction->rollback();
                $res['result'] = false;
            }
            $this->writeToFile('/tmp/ftc', print_r($res, true), 'a+');

            echo CJSON::encode($res);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
            $transaction->rollback();
        }
    }

    public function actionUpload($id)
    {
        $model = FitfastTarget::model()->findByPk($id);

        if (isset($_POST['FitfastTarget'])) {
            $flag = false;
            $transaction = Yii::app()->db->beginTransaction();
            try {
                //already upload
                $oldFile = isset($model->file) ? $model->file : null;
                $oldFilePath = Yii::app()->getBasePath() . '/../' . $oldFile;

                $model->attributes = $_POST['FitfastTarget'];
                $file = CUploadedFile::getInstance($model, 'file');
                if (isset($file) && !empty($file)) {
                    $fileType = explode('.', $file->name);
                    $fileType = $fileType[count($fileType) - 1];
                    $fileUrl = '/images/fitandfast/' . time() . '-' . rand(0, 999999) . '.' . $fileType;
                    $filePathfile = Yii::app()->getBasePath() . '/../' . $fileUrl;

                    $model->file = $fileUrl;

                    if ($model->save()) {

                        //unlink if oldFile exist
                        if (isset($oldFile)) {
                            unlink($oldFilePath);
                        }

                        if (isset($file) && !empty($file)) {
                            if ($file->saveAs($filePathfile)) {
                                $flag = true;
                            } else {
                                $flag = false;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        $this->redirect($this->createUrl('/fitandfast'));
                    } else {
                        $transaction->rollback();
                    }
                }
            } catch (Exception $e) {
                $transaction->rollback();
                throw new Exception($e->getMessage());
            }
        }

        $this->render('upload', array(
            'model' => $model
        ));
    }
}
