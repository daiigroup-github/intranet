<?php

/**
 * Created by PhpStorm.
 * User: NPR
 * Date: 3/18/15
 * Time: 1:07 PM
 */
class MigrateController extends FitandfastMasterController
{

    public function actionIndex()
    {
//        exit();
        ini_set("max_execution_time", "1000");
        $forYear = 2015;
        $flag = false;
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $criteria = new CDbCriteria();
            $criteria->select = 'distinct employeeId';
            $criteria->condition = 'forYear=' . $forYear;
            $criteria->order = 'employeeId';

            $employees = FitAndFast::model()->findAll($criteria);
            foreach ($employees as $emp) {


                // insert into FitfastEmployee
                $fitFastEmployee = new FitfastEmployee();
                $fitFastEmployee->employeeId = $emp->employeeId;
                $fitFastEmployee->createDateTime = new CDbExpression('NOW()');
                $fitFastEmployee->updateDateTime = new CDbExpression('NOW()');
                $fitFastEmployee->forYear = $forYear;
                $fitFastEmployee->halfS = 0;
                $fitFastEmployee->S = 0;
                $fitFastEmployee->SS = 0;
                $fitFastEmployee->F = 0;


                if ($fitFastEmployee->save()) {
                    echo 'EmployeeId : ' . $emp->employeeId . '<br />';
                    $cri2 = new CDbCriteria();
                    $cri2->condition = 'forYear=:forYear AND employeeId=:employeeId';
                    $cri2->params = array(
                        ':forYear' => $forYear,
                        ':employeeId' => $emp->employeeId
                    );

                    $fitandfasts = FitAndFast::model()->findAll($cri2);
                    $fitfastEmployeeId = Yii::app()->db->lastInsertID;

                    $fitfastEmployeeModel = FitfastEmployee::model()->findByPk($fitfastEmployeeId);

                    foreach ($fitandfasts as $fitandfast) {
                        // insert into fitfast
                        $fitfast = new Fitfast();
                        $fitfast->createDateTime = new CDbExpression('NOW()');
                        $fitfast->updateDateTime = new CDbExpression('NOW()');
                        $fitfast->fitfastEmployeeId = $fitfastEmployeeId;
                        $fitfast->employeeId = $emp->employeeId;
                        $fitfast->title = $fitandfast->title;
                        $fitfast->description = $fitandfast->description;
                        $fitfast->type = $fitandfast->type;

                        if ($fitfast->save()) {
                            echo $fitfast->title . '<br />';

                            $targetArray = FitAndFast::model()->targetArray;
                            $fileArray = FitAndFast::model()->fileArray;
                            $gradeArray = FitAndFast::model()->gradeArray;

                            echo '<ul>';

                            $fitfastId = Yii::app()->db->lastInsertID;

                            $fitfastModel = Fitfast::model()->findByPk($fitfastId);

                            for ($i = 0; $i < 12; $i++) {
                                // insert into fitfast_target
                                if (!isset($fitandfast->{$targetArray[$i]}) || empty(trim($fitandfast->{$targetArray[$i]})) || $fitandfast->{$targetArray[$i]} == '')
                                    continue;

                                $fitfastTarget = new FitfastTarget();
                                $fitfastTarget->createDateTime = new CDbExpression('NOW()');
                                $fitfastTarget->updateDateTime = new CDbExpression('NOW()');
                                $fitfastTarget->employeeId = $emp->employeeId;
                                $fitfastTarget->fitfastId = $fitfastId;
                                $fitfastTarget->target = $fitandfast->{$targetArray[$i]};
                                $fitfastTarget->file = $fitandfast->{$fileArray[$i]};
                                $fitfastTarget->month = $i + 1;

                                switch ($fitandfast->{$gradeArray[$i]}) {
                                    case 's':
                                        $fitfastTarget->grade = 0.5;
                                        $fitfastModel->halfS += 1;
                                        break;
                                    case 'S':
                                        $fitfastTarget->grade = 1;
                                        $fitfastModel->S += 1;
                                        break;
                                    case 'SS':
                                        $fitfastTarget->grade = 2;
                                        $fitfastModel->SS += 1;
                                        break;
                                    case 'F':
                                        $fitfastTarget->grade = -1;
                                        $fitfastModel->F -= 1;
                                        break;
                                    default:
                                        $fitfastTarget->grade = 0;
                                }

                                if ($fitfastTarget->grade > 0) {
                                    $fitfastTarget->status = FitfastTarget::STATUS_GRADED;
                                } elseif (isset($fitfastTarget->file)) {
                                    $fitfastTarget->status = FitfastTarget::STATUS_UPLOADED;
                                }

                                if ($fitfastTarget->save()) {
                                    echo '<li>target : ' . $fitandfast->{$targetArray[$i]} . '<br />' . 'file : ' . $fitandfast->{$fileArray[$i]} . '<br />' . 'grade : ' . $fitandfast->{$gradeArray[$i]} . '<br />' . '</li>';
                                } else
                                    throw new Exception('fitfastTarget : ' . $fitandfast->fitAndFastId . "\n" . $targetArray[$i] . "\n" . print_r($fitfastTarget->errors, true));
                            }
                            echo '</ul>';

                            $fitfastModel->save();

                        } else
                            throw new Exception('fitfast' . print_r($fitfast->errors, true));

                        $fitfastEmployeeModel->halfS += $fitfastModel->halfS;
                        $fitfastEmployeeModel->S += $fitfastModel->S;
                        $fitfastEmployeeModel->SS += $fitfastModel->SS;
                        $fitfastEmployeeModel->F += $fitfastModel->F;
                        $fitfastEmployeeModel->percent = $fitfastEmployeeModel->calculatePercent();
                        $fitfastEmployeeModel->save();
                    }

                    echo '<hr />';
                    $flag = true;
                } else {
                    throw new Exception(print_r($fitFastEmployee->errors, true));
                }
            }

            if ($flag)
                $transaction->commit();
            else
                $transaction->rollback();
        } catch (Exception $e) {
            $transaction->rollback();
            throw new Exception($e->getMessage());
        }
    }

    public function actionUpdateGrade()
    {
        $fitfastEmployeeModels = FitfastEmployee::model()->findAll();
        foreach ($fitfastEmployeeModels as $fem) {
            $cri1 = new CDbCriteria();
            $cri1->select = 'sum(sumS) as s, sum(sumF) as f';
            $cri1->condition = 'fitfastEmployeeId=:fitfastEmployeeId';
            $cri1->params = array(':fitfastEmployeeId' => $fem->fitfastEmployeeId);
            $f = Fitfast::model()->find($cri1);
            $fem->sumS = $f->s;
            $fem->sumF = $f->f;
            $fem->save();
            echo print_r($f->s . ',' . $f->f, true) . '<br />';
        }
    }

    // Uncomment the following methods and override them if needed
    /*
     * public function filters() { // return the filter configuration for this controller, e.g.: return array( 'inlineFilterName', array( 'class'=>'path.to.FilterClass', 'propertyName'=>'propertyValue', ), ); } public function actions() { // return external action classes, e.g.: return array( 'action1'=>'path.to.ActionClass', 'action2'=>array( 'class'=>'path.to.AnotherActionClass', 'propertyName'=>'propertyValue', ), ); }
     */
}