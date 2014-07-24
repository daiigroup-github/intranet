<?php

class SummaryController extends MasterFitFastModuleController
{
    public $layout = '//layouts/cl1';
    public $editGradeUsersArray = array(
        'kbw',
        'npr'
    );

    public function actionIndex()
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

    // Uncomment the following methods and override them if needed
    /*
    public function filters()
    {
        // return the filter configuration for this controller, e.g.:
        return array(
            'inlineFilterName',
            array(
                'class'=>'path.to.FilterClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }

    public function actions()
    {
        // return external action classes, e.g.:
        return array(
            'action1'=>'path.to.ActionClass',
            'action2'=>array(
                'class'=>'path.to.AnotherActionClass',
                'propertyName'=>'propertyValue',
            ),
        );
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
                    $this->writeToFile('/tmp/grades', print_r($fitfastEmployeeModel->countGrade(), true));
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

    public function actionEditGrade()
    {

    }
}