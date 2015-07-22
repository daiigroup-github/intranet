<?php

namespace frontend\models;

use Yii;
use \common\models\master\FitfastTargetMaster;

/**
 * This is the model class for table "fitfast_target".
 *
 * @property integer $fitfastTargetId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property integer $employeeId
 * @property integer $fitfastId
 * @property integer $month
 * @property string $target
 * @property string $file
 * @property double $grade
 * @property integer $parentId
class FitfastTarget extends \common\models\master\FitfastTargetMaster
 */
class FitfastTarget extends FitfastTargetMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }

    /**
     * relation
     */
    public function getFitfast()
    {
        return $this->hasOne(Fitfast::className(), ['fitfastId' => 'fitfastId']);
    }

    // /relation

    public function getGradeArray()
    {
        return [
            strval(FitfastEmployee::GRADE_HALF_S) => 's',
            FitfastEmployee::GRADE_S => 'S',
            FitfastEmployee::GRADE_SS => 'SS',
            strval(FitfastEmployee::GRADE_F) => 'F',
        ];
    }

    public function getGradeText()
    {
        $gradeArray = $this->getGradeArray();
        return ($this->grade == 0) ? 0 : $gradeArray[$this->grade];
    }

    public function gradeValue($grade)
    {
        return array_search($grade, $this->gradeArray);
    }

    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['employeeId'=>'employeeId']);
    }

    // /relation

    /**
     * @param $month
     * @param null $employeeId
     * @param null $forYear
     * @return array
     */
    public function countGradeByMonth($month, $employeeId = null, $forYear = null)
    {
        $res = [];
        $employeeId = isset($employeeId) ? $employeeId : \Yii::$app->user->identity->id;
        $forYear = isset($forYear) ? $forYear : date('Y');

        $models = FitfastTarget::find()
            ->where(['employeeId' => $employeeId, 'forYear' => $forYear, 'month' => $month]);

        foreach ($models as $model) {
            switch ($model->grade) {
                case FitfastEmployee::GRADE_HALF_S:
                    $res['s'] += 1;
                    breake;

                case FitfastEmployee::GRADE_S:
                    $res['S'] += 1;
                    break;

                case FitfastEmployee::GRADE_SS:
                    $res['SS'] += 1;
                    break;

                case FitfastEmployee::GRADE_F:
                    $res['F'] += 1;
                    break;
            }
        }
        return $res;
    }

    public function saveGrade($id, $grade)
    {
        $flag = false;
        $model = FitfastTarget::findOne($id);
        $oldGradeValue = $model->grade;
        $oldGrade = $model->gradeText;
        $fieldName = ($grade === 's') ? 'halfS' : $grade;
        $gradeValue = $model->gradeValue($grade);

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model->grade = $gradeValue;
//            if($model->save()) {
//                if($model->fitfast->saveGrade($grade, $oldGrade)){
//                    if($model->fitfast->fitfastEmployee->saveGrade($grade, $oldGrade)){
//                        $flag = true;
//                    }
//                }
//            }
            $fitfastModel = $model->fitFast;
            $fitfastEmployeeModel = $fitfastModel->fitfastEmployee;

            //new grade
            if ($grade != 'F') {
                $fitfastModel->{$fieldName} += 1;
                $fitfastEmployeeModel->{$fieldName} += 1;
            } else {
                $fitfastModel->{$fieldName} -= 1;
                $fitfastEmployeeModel->{$fieldName} -= 1;
            }

            if ($oldGradeValue != 0) {
                //change grade
                $oldFieldName = ($oldGrade === 's') ? 'halfS' : $oldGrade;
                if ($grade != 'F') {
                    $fitfastModel->{$oldFieldName} -= 1;
                    $fitfastEmployeeModel->{$oldFieldName} -= 1;
                } else {
                    $fitfastModel->{$oldFieldName} += 1;
                    $fitfastEmployeeModel->{$oldFieldName} += 1;
                }
            }

            $fitfastEmployeeModel->percent = $fitfastEmployeeModel->calculatePercent();

            if($model->save() && $fitfastModel->save() && $fitfastEmployeeModel->save()) {
                $flag = true;
            }

            if ($flag) {
                $transaction->commit();
            } else {
                $transaction->rollBack();
            }
        } catch
        (Exception $e) {
            $transaction->rollBack();
        }
        return $flag;
    }
}
