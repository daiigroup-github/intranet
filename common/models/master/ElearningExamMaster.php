<?php

namespace common\models\master;

use Yii;

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
 */
class ElearningExamMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'elearning_exam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'employeeId', 'point', 'createBy'], 'integer'],
            [['createDateTime', 'updateDateTime', 'examDate', 'employeeId', 'createBy'], 'required'],
            [['createDateTime', 'updateDateTime', 'examDate'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'elearningExamId' => 'Elearning Exam ID',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
            'examDate' => 'Exam Date',
            'employeeId' => 'Employee ID',
            'point' => 'Point',
            'createBy' => 'Create By',
        ];
    }
}
