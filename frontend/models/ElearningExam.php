<?php

namespace frontend\models;

use Yii;
use \common\models\master\ElearningExamMaster;

/**
 * This is the model class for table "elearning_exam".
 *
 * @property integer $elearningExamId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property string $examDate
 * @property integer $employeeId
 * @property integer $point
 * @property integer $createBy
class ElearningExam extends \common\models\master\ElearningExamMaster
*/
class ElearningExam extends ElearningExamMaster
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
}
