<?php

namespace common\models\master;

use Yii;

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
 */
class FitfastTargetMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fitfast_target';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'employeeId', 'fitfastId', 'month', 'parentId'], 'integer'],
            [['createDateTime', 'updateDateTime', 'employeeId', 'fitfastId', 'month', 'target'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['target'], 'string'],
            [['grade'], 'number'],
            [['file'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fitfastTargetId' => 'Fitfast Target ID',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
            'employeeId' => 'Employee ID',
            'fitfastId' => 'Fitfast ID',
            'month' => 'Month',
            'target' => 'Target',
            'file' => 'File',
            'grade' => 'Grade',
            'parentId' => 'Parent ID',
        ];
    }
}
