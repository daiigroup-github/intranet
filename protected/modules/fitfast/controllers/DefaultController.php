<?php

class DefaultController extends MasterFitFastModuleController
{

    public $layout = '//layouts/cl1';
    public $editGradeUsersArray = array(
        'kbw',
        'npr'
    );

    public function filters()
    {
        return array(
            'accessControl',
            // perform access control for CRUD operations
            'postOnly + delete',
            // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
        return array(
            array(
                'allow',
//				'actions'=>array(
//					'*'),
                'users' => array(
                    '@'
                )
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
        foreach (Company::model()->findAll() as $companyModel) {
            $criteria = new CDbCriteria();
            $criteria->condition = 'companyId=:companyId AND status=1';
            $criteria->params = array(
                ':companyId' => $companyModel->companyId
            );
            $criteria->group = 'companyDivisionId';

            $companyDivisions = Employee::model()->findAll($criteria);

            if (!empty($companyDivisions)) {
                $data[$i]['name'] = $companyModel->companyNameTh;
                $data[$i]['companyId'] = $companyModel->companyId;
//echo $companyModel->companyNameTh . '<br />';

                $j = 0;
                foreach ($companyDivisions as $c) {
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
            'data' => $data
        ));
    }

    public function actionDivision($id1, $id2)
    {
        $this->layout = '//layouts/cl2';
        $companyId = $id1;
        $companyDivisionId = $id2;
        $data = array();
        $i = 0;

        $companyModel = Company::model()->find('companyId=' . $companyId);
        $data['company'] = $companyModel->companyNameTh;

        $companyDivisionModel = CompanyDivision::model()->find('companyDivisionId=' . $companyDivisionId);
        $data['division'] = $companyDivisionModel->description;

        $employeeModels = Employee::model()->findAll(array(
            'condition' => 'companyId=:companyId AND companyDivisionId=:companyDivisionId AND status=1 AND isManager=0',
            'params' => array(
                'companyId' => $companyId,
                'companyDivisionId' => $companyDivisionId
            )
        ));

        foreach ($employeeModels as $employeeModel) {
            $data['employee'][$i]['name'] = $employeeModel->fnTh . ' ' . $employeeModel->lnTh;
            $data['employee'][$i]['employeeId'] = $employeeModel->employeeId;
            $grade = FitfastEmployee::model()->calculatePercentByEmployeeIdAndYear($employeeModel->employeeId, date('Y'));
            $data['employee'][$i]['percent'] = $grade['percent'];
            $data['employee'][$i]['grades'] = $grade['grades'];

            $i++;
        }

        $this->render('division', array(
            'data' => $data
        ));
    }

    public function actionCompanyEmployee()
    {
        $this->layout = '//layouts/cl2';

        $companyModels = Company::model()->findAll();
        $companyDivisionModels = CompanyDivision::model()->findAll();
        $sumPercent = 0;

        $i = 0;
        $k = 0;
        foreach ($companyModels as $companyModel) {
            $data[$i]['companyName'] = $companyModel->companyNameTh;
            $data[$i]['companyId'] = $companyModel->companyId;

            $j = 0;
            foreach ($companyDivisionModels as $companyDivisionModel) {
                if (null == (Employee::model()->find('status=1 AND companyId=:companyId AND companyDivisionId=:companyDivisionId', array(
                        ':companyId' => $companyModel->companyId,
                        ':companyDivisionId' => $companyDivisionModel->companyDivisionId
                    )))
                ) {
                    continue;
                }

                $data[$i]['division'][$j]['companyDivisionId'] = $companyDivisionModel->companyDivisionId;
                $data[$i]['division'][$j]['description'] = $companyDivisionModel->description;
                $data[$i]['division'][$j]['percent'] = FitfastEmployee::model()->calculatePercentByDivisionId($companyModel->companyId, $companyDivisionModel->companyDivisionId, date('Y'));
                $sumPercent += $data[$i]['division'][$j]['percent'];
                $j++;
                $k++;
            }
            $i++;
        }

        $this->render('company_employee', array(
            'data' => $data,
            'sumPercent' => number_format($sumPercent / $k, 2)
        ));
    }

    public function actionCompanyManager()
    {
        $this->layout = '//layouts/cl2';
        $data = array();
        $i = 0;
        $sumPercent = 0;

        $employeeModels = Employee::model()->findAll('status=1 AND isManager=1');

        foreach ($employeeModels as $employeeModel) {
            $data['employee'][$i]['name'] = $employeeModel->fnTh . ' ' . $employeeModel->lnTh;
            $data['employee'][$i]['employeeId'] = $employeeModel->employeeId;
            $grade = FitfastEmployee::model()->calculatePercentByEmployeeIdAndYear($employeeModel->employeeId, date('Y'));
            $data['employee'][$i]['percent'] = $grade['percent'];
            $data['employee'][$i]['grades'] = $grade['grades'];

            $sumPercent += $grade['percent'];

            $i++;
        }
        $this->render('company_manager', array(
            'data' => $data,
            'percent' => number_format($sumPercent / $i, 2)
        ));
    }

    public function actionIndex($id)
    {
        $employeeId = isset($id) ? $id : Yii::app()->user->id;
        $forYear = isset($_GET['forYear']) ? $_GET['forYear'] : date('Y');

        $fitfastEmployeeModel = FitfastEmployee::model()->find(array(
            'condition' => 'employeeId=:employeeId AND forYear=:forYear',
            'params' => array(
                ':employeeId' => $employeeId,
                ':forYear' => $forYear
            )
        ));
        $summary['percent'] = $fitfastEmployeeModel->calculatePercent();
        $summary['grades'] = $fitfastEmployeeModel->countGrade();

        $this->render('index', array(
            'employeeModel' => Employee::model()->findByPk($employeeId),
            'summary' => $summary,
            'fitfastEmployeeModel' => $fitfastEmployeeModel,
        ));
    }

    /*
    public function actionUpload($id1, $id2)
    {
        $model = FitAndFast::model()->findByPk($id1);
        $flag = false;
        $k = array_search($id2, FitAndFast::model()->fileArray);

        if ($model->{FitAndFast::model()->gradeArray[$k]}) {
            Yii::app()->clientScript->registerScript('checkGradeNotEmpty', '
				alert("ให้เกรดแล้วไม่สามารถ Upload ใหม่ได้");
				history.back(1);
				');
        }

        if (isset($_POST['FitAndFast'][$id2])) {
            $file = CUploadedFile::getInstance($model, $id2);

            $transaction = Yii::app()->db->beginTransaction();
            try {
//fileName = employeeId_fitAndFastId_$id2
                $fileName = Yii::app()->user->id . '_' . $id1 . '_' . $id2 . '.pdf';
                $fileUrl = 'images/fitfast/' . $fileName;
                $model->{$id2} = $fileUrl;

                $model->{FitAndFast::model()->statusFitAndFastArray[$k]} = FitAndFast::STATUS_UPLOADED;
                $model->{$id2 . 'DateTime'} = new CDbExpression('NOW()');

                if ($model->save(false)) {
//save file
                    if ($file->saveAs(Yii::app()->basePath . '/../' . $fileUrl)) {
                        $flag = true;
                    }
                }

                if ($flag) {
                    $transaction->commit();
                    $this->redirect($this->createUrl('index'));
                } else {
                    $transaction->rollback();
                }
            } catch (Exception $e) {
                $transaction->rollback();
                throw new Exception($e->getMessage());
            }
        }
        $this->render('upload', array(
            'fitAndFastId' => $id1,
            'field' => $id2,
            'title' => $model->title,
            'target' => $model->{FitAndFast::model()->targetArray[$k]},
            'model' => $model
        ));
    }
    */

    public function actionUpload($id)
    {
        $fitfastTargetModel = FitfastTarget::model()->findByPk($id);

        if (isset($_POST['FitfastTarget'])) {
            $file = CUploadedFile::getInstance($fitfastTargetModel, 'file');

            $transaction = Yii::app()->db->beginTransaction();
            try {
                //fileName = employeeId_fitAndFastId_$id2
                $fileName = Yii::app()->user->id . '_' . $id . '.pdf';
                $fileUrl = 'images/fitfast/' . $fileName;
                $fitfastTargetModel->file = $fileUrl;

                $fitfastTargetModel->status = FitfastTarget::STATUS_UPLOADED;
                $fitfastTargetModel->updateDateTime = new CDbExpression('NOW()');

                if ($fitfastTargetModel->save(false)) {
                    //save file
                    if ($file->saveAs(Yii::app()->basePath . '/../' . $fileUrl)) {
                        $flag = true;
                    }
                }

                if ($flag) {
                    $transaction->commit();
                    $this->redirect($this->createUrl('index'));
                } else {
                    $transaction->rollback();
                }
            } catch (Exception $e) {
                $transaction->rollback();
                throw new Exception($e->getMessage());
            }
        }

        $this->render('upload', array('fitfastTargetModel' => $fitfastTargetModel));
    }

    public function actionUpdateGrade()
    {
        /*
        if (isset($_POST)) {
            $fitAndFastModel = FitAndFast::model()->findByPk($_POST['fitAndFastId']);

            //find array key
            $k = array_search($_POST['field'], FitAndFast::model()->gradeArray);
            $sumGrade = array();

            if ($fitAndFastModel->sumGrade == NULL) {
                $sumGrade = array(
                    's' => 0,
                    'S' => 0,
                    'SS' => 0,
                    'F' => 0
                );
            } else
                $sumGrade = unserialize($fitAndFastModel->sumGrade);

            $this->writeToFile('/tmp/updateGrade', print_r($_POST, true));
            $this->writeToFile('/tmp/sumGrade', print_r($sumGrade, true));

            //restore when edit
            if ($fitAndFastModel->{$_POST['field']} != NULL)
                $sumGrade[$fitAndFastModel->{$_POST['field']}] -= 1;

            if ($fitAndFastModel->{$_POST['field']} != $_POST['grade']) {
                if ($fitAndFastModel->{$_POST['field']} == NULL) //update
                {
                    $grade = '';
                    if ($_POST['grade'] != 'F') {
                        $grade = FitAndFast::model()->calculateGradeS($_POST['field'], $_POST['type']);
                        $sumGrade[$grade] += 1; //calculate S
                    } else {
                        $sumGrade['F'] += 1;
                        $grade = $_POST['grade'];
                    }
                } else //edit
                {
                    $grade = $_POST['grade'];
                    $sumGrade[$grade] += 1;
                }

                $fitAndFastModel->{FitAndFast::model()->statusFitAndFastArray[$k]} = FitAndFast::STATUS_GRADED;
                $fitAndFastModel->$_POST['field'] = $grade;
            } else {
                $fitAndFastModel->{FitAndFast::model()->statusFitAndFastArray[$k]} = FitAndFast::STATUS_UPLOADED;
                $fitAndFastModel->$_POST['field'] = NULL;
            }
            $this->writeToFile('/tmp/sumGrade', print_r($sumGrade, true), 'a+');
            $fitAndFastModel->sumGrade = serialize($sumGrade);

            $fitAndFastModel->{$_POST['field'] . 'DateTime'} = new CDbExpression('NOW()');

            if ($fitAndFastModel->save(false)) {
                echo CJSON::encode(array(
                    'status' => true,
                    'grade' => $fitAndFastModel->$_POST['field'],
                    'dateTime' => $fitAndFastModel->{$_POST['field'] . 'DateTime'},
                    'percent' => FitAndFast::model()->calculatePercent($fitAndFastModel->forYear)
                ));
            } else {
                echo CJSON::encode(array(
                    'status' => false,
                ));
            }
        }
        */
        if (isset($_POST['grade']) && isset($_POST['fitfastTargetId'])) {
            $flag = false;
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $fitfastTargetModel = FitfastTarget::model()->findByPk($_POST['fitfastTargetId']);
                $fitfastModel = $fitfastTargetModel->fitfast;
                $fitfastEmployeeModel = $fitfastModel->fitfastEmployee;

                $fitfastTargetModel->grade = $_POST['grade'];
                $fitfastTargetModel->updateDateTime = new CDbExpression('NOW()');

                if ($fitfastTargetModel->save())
                    $flag = true;

                if ($flag) {
                    $transaction->commit();
                    $grade = ($_POST['grade'] == 0.5) ? 0 : $_POST['grade'];
                } else {
                    $transaction->rollback();
                }
            } catch (Exception $e) {
                $transaction->rollback();
                throw new Exception($e->getMessage());
            }


            if ($flag) {
                //success
                echo CJSON::encode(array(
                    'status' => true,
                    'grade' => $fitfastTargetModel->gradeText($grade),
                    'dateTime' => $fitfastTargetModel->updateDateTime,
                    'percent' => $fitfastEmployeeModel->calculatePercent(),
                    'grades' => $fitfastEmployeeModel->countGrade(),
                ));
            } else {
                //failed
                echo CJSON::encode(array(
                    'status' => false,
                ));
            }

        }
    }

    public function actionGradeInCompanyDivision()
    {
        $this->layout = '//layouts/cl2';
        $employeeModel = Employee::model()->findByPk(Yii::app()->user->id);

        $this->render('gradeInDivision', array(
            //'res'=>FitAndFast::model()->findAllWaitingForGradeInCompanyDivision($employeeModel->companyDivisionId)
            'res' => FitAndFast::model()->findAllWaitingForGradeByManagerId(Yii::app()->user->id)
        ));
    }

    public function actionGradeInManagement()
    {
        $this->layout = '//layouts/cl2';

        $this->render('gradeInDivision', array(
            'res' => FitAndFast::model()->findAllWaitingForGradeInManagement()
        ));
    }

    public function actionEmployeeSummary($id = null)
    {
        $employeeId = isset($id) ? $id : Yii::app()->user->id;
        $forYear = isset($_GET['forYear']) ? $_GET['forYear'] : date('Y');

        $summary['percent'] = FitfastEmployee::model()->calculatePercentByEmployeeIdAndYear($employeeId, $forYear);
        $fitfastEmployeeModel = FitfastEmployee::model()->find(array(
            'condition' => 'employeeId=:employeeId AND forYear=:forYear',
            'params' => array(
                ':employeeId' => $employeeId,
                ':forYear' => $forYear
            )
        ));

        $this->render('employee_summary', array(
            'employeeModel' => Employee::model()->findByPk($employeeId),
            'summary' => $summary,
            'fitfastEmployeeModel' => $fitfastEmployeeModel,
        ));
    }

}
