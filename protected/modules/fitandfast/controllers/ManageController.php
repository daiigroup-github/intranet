<?php

class ManageController extends FitandfastMasterController
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
        $model = new Fitfast;
        $fitfastEmployeeModel = new FitfastEmployee();
        $fitfastTargetModel = new FitfastTarget();
        $targets = array();

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['Fitfast']) && isset($_POST['FitfastEmployee']) && isset($_POST['FitfastTarget'])) {
            $model->attributes = $_POST['Fitfast'];

            $flag = false;
            $transaction = Yii::app()->db->beginTransaction();
            try {
                /**
                 * fitfastEmployee
                 */
                $fitfastEmployeeModel->attributes = $_POST['FitfastEmployee'];

                $ffem = $fitfastEmployeeModel->findByAttributes(
                    array(
                        'employeeId' => $fitfastEmployeeModel->employeeId,
                        'forYear' => $fitfastEmployeeModel->forYear
                    )
                );

                if (!isset($ffem)) {
                    $fitfastEmployeeModel = new FitfastEmployee();
                    $fitfastEmployeeModel->attributes = $_POST['FitfastEmployee'];
                } else {
                    $fitfastEmployeeModel = $ffem;
                }

                $fitfastEmployeeModel->createDateTime = new CDbExpression('NOW()');
                $fitfastEmployeeModel->updateDateTime = new CDbExpression('NOW()');

                if ($fitfastEmployeeModel->save()) {
                    /**
                     * fitfast
                     */
                    $fitfastEmployeeId = ($fitfastEmployeeModel->isNewRecord) ? Yii::app()->db->getLastInsertID() : $fitfastEmployeeModel->fitfastEmployeeId;
                    $model->attributes = $_POST['Fitfast'];
                    $model->fitfastEmployeeId = $fitfastEmployeeId;
                    $model->createDateTime = new CDbExpression('NOW()');
                    $model->updateDateTime = new CDbExpression('NOW()');
                    $model->employeeId = $fitfastEmployeeModel->employeeId;

                    if ($model->save()) {
                        $fitfastId = Yii::app()->db->getLastInsertID();

                        $this->writeToFile('/tmp/manageff', print_r($model->attributes, true));
                        $i = 0;
                        $month = 0;
                        $target = '';
                        foreach ($_POST['FitfastTarget'] as $m => $fft) {
                            if (empty($fft['target']))
                                continue;

                            $fitfastTargetModel = new FitfastTarget();
                            $fitfastTargetModel->attributes = $fft;
                            $fitfastTargetModel->createDateTime = new CDbExpression('NOW()');
                            $fitfastTargetModel->updateDateTime = new CDbExpression('NOW()');
                            $fitfastTargetModel->employeeId = $fitfastEmployeeModel->employeeId;
                            $fitfastTargetModel->fitfastId = $fitfastId;
                            $fitfastTargetModel->month = $m;

                            if (!$fitfastTargetModel->save()) {
                                $i++;
                                $this->writeToFile('/tmp/mfft', print_r($fitfastTargetModel->errors, true));
                                break;
                            }
                            $month = $m;
                            $target = $fitfastTargetModel->target;
                        }

                        //implement
                        if ($model->type == Fitfast::FITFAST_TYPE_IMPLEMENT) {
                            $this->writeToFile('/tmp/fft-i', '');
                            for ($k = ($month + 1); $k <= 12; $k++) {
                                $fft = new FitfastTarget();
                                $fft->createDateTime = new CDbException('NOW()');
                                $fft->updateDateTime = new CDbException('NOW()');
                                $fft->parentId = Yii::app()->db->getLastInsertID();
                                $fft->employeeId = $fitfastEmployeeModel->employeeId;
                                $fft->fitfastId = $fitfastId;
                                $fft->target = $target;
                                $fft->month = $k;

                                $this->writeToFile('/tmp/fft-i', print_r($k . ' ' . $target . '\r', true), 'a+');

                                if (!$fft->save()) {
                                    $i++;
                                    break;
                                }
                            }
                        }

                        if ($i == 0) {
                            $this->writeToFile('/tmp/save', print_r('save', true));
                            $flag = true;
                        }
                    } else {
                        $this->writeToFile('/tmp/mff', print_r($model->errors, true));
                    }

                } else {
                    $this->writeToFile('/tmp/mfe', print_r($fitfastEmployeeModel->errors, true));
                }

                if ($flag) {
                    $transaction->commit();
                    $this->redirect(Yii::app()->createUrl('fitandfast/manage'));
                } else {
                    $transaction->rollback();
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
                $transaction->rollback();
            }

            $targets = $_POST['FitfastTarget'];

        }

        $this->render('create', array(
            'model' => $model,
            'fitfastEmployeeModel' => $fitfastEmployeeModel,
            'fitfastTargetModel' => $fitfastTargetModel,
            'targets' => $targets,
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

        if (isset($_POST['Fitfast'])) {
            $flag = false;
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $model->attributes = $_POST['Fitfast'];

                if ($model->save()) {
                    $flag = true;
                }

                if ($flag) {
                    $transaction->commit();
                    $this->redirect(array('view', 'id' => $model->fitfastId));
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
        $dataProvider = new CActiveDataProvider('Fitfast');
        $this->render('admin', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionIndex()
    {
        $model = new Fitfast('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Fitfast']))
            $model->attributes = $_GET['Fitfast'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Fitfast the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Fitfast::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Fitfast $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'fitfast-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Import from file
     */
    public function actionImport()
    {
        if (isset($_FILES['fFile'])) {
            $forYear = $_POST['forYear'];
            $lines = file($_FILES['fFile']['tmp_name']);

            $flag = false;
            $transaction = Yii::app()->db->beginTransaction();
            $error = array();

            try {
                $i = 0;
                foreach ($lines as $line) {
                    $data = explode('|', $line);

                    $employeeModel = Employee::model()->find(array(
                        'condition'=>'employeeCode=:employeeCode',
                        'params'=>array(
                            ':employeeCode'=>$data[0]
                        )
                    ));
                    if(!isset($employeeModel))
                        break;

                    /**
                     * create FitfastEmployee if not exist
                     */
                    $fitfastEmployeeModel = FitfastEmployee::model()->find(array(
                        'condition' => 'employeeId=:employeeId AND forYear=:forYear',
                        'params' => array(
                            ':employeeId' => $employeeModel->employeeId,
                            ':forYear' => $forYear
                        ),
                    ));

                    if (!isset($fitfastEmployeeModel)) {
                        $fitfastEmployeeModel = new FitfastEmployee();
                        $fitfastEmployeeModel->createDateTime = $fitfastEmployeeModel->updateDateTime = new CDbExpression('NOW()');
                        $fitfastEmployeeModel->employeeId = $employeeModel->employeeId;
                        $fitfastEmployeeModel->forYear = $forYear;
                    } else {
                        // update updateDateTime
                        $fitfastEmployeeModel->updateDateTime = new CDbExpression('NOW()');
                    }

                    if ($fitfastEmployeeModel->save()) {
                        $fitfastEmployeeId = ($fitfastEmployeeModel->isNewRecord) ? Yii::app()->db->lastInsertID : $fitfastEmployeeModel->fitfastEmployeeId;

                        $fitfastModel = new Fitfast();
                        $fitfastModel->employeeId = $employeeModel->employeeId;
                        $fitfastModel->fitfastEmployeeId = $fitfastEmployeeId;
                        $fitfastModel->createDateTime = $fitfastModel->updateDateTime = new CDbExpression('NOW()');
                        $fitfastModel->title = $data[1];
                        $fitfastModel->type = Fitfast::FITFAST_TYPE_PERFORMANCE;

                        if($fitfastModel->save()) {
                            $fitfastId = Yii::app()->db->lastInsertID;

                            for($j=2;$j<=13;$j++) {
                                if($data[$j] == null || $data[$j] == "\r" || $data[$j] == "\n") {
                                    continue;
                                }

                                $fitfastTargetModel = new FitfastTarget();
                                $fitfastTargetModel->employeeId = $employeeModel->employeeId;
                                $fitfastTargetModel->fitfastId = $fitfastId;
                                $fitfastTargetModel->createDateTime = $fitfastTargetModel->updateDateTime = new CDbExpression('NOW()');
                                $fitfastTargetModel->target = $data[$j];
                                $fitfastTargetModel->month = $j-1;

                                if(!$fitfastTargetModel->save()) {
                                    $error[] = $fitfastTargetModel->errors;
                                    print_r($fitfastTargetModel->errors);
                                    break;
                                }
                            }

                            if($j != 14)
                                break;
                        } else {
                            $error[] = $fitfastModel->errors;
                            print_r($fitfastModel->errors);
                            break;
                        }
                    } else {
                        $error[] = $fitfastEmployeeModel->errors;
                        print_r($fitfastEmployeeModel->errors);
                        break;
                    }
                    $i++;
                }

                if($i == sizeof($lines))
                    $flag = true;

                if ($flag) {
                    $transaction->commit();
                    $this->redirect(Yii::app()->createUrl('fitandfast/manage'));
                } else {
                    print_r($data);
                    $transaction->rollback();
                }
            } catch (Exception $e) {
                $transaction->rollback();
                throw new Exception($e->getMessage());
            }
        }
        $this->render('import');
    }
}
