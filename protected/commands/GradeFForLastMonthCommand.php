<?php

class GradeFForLastMonthCommand extends CConsoleCommand
{

	public function run()
	{
        $lastMonth = date('m')-1;
        $fitfastTargetModels = FitfastTarget::model()->findAll(array(
            'condition'=>'month<=:lastMonth AND grade=0',
            'params'=>array(':lastMonth'=>$lastMonth)
        ));

        foreach ($fitfastTargetModels as $fft) {
            $this->gradeForFitfastTarget($fft->fitfastTargetId, 'F');
        }
	}

    public function gradeForFitfastTarget($id, $g)
    {
        $model = FitfastTarget::model()->findByPk($id);

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

            if ($model->save() && $fitfastModel->save() && $fitfastEmployeeModel->save()) {
                $flag = true;
            }

            $res = array();

            if ($flag) {
                $transaction->commit();
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
            $transaction->rollback();
        }
    }

}
