<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "employee_level".
 *
 * @property integer $employeeLevelId
 * @property integer $status
 * @property integer $level
 * @property string $description
 */
class EmployeeLevelMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'level'], 'integer'],
            [['level', 'description'], 'required'],
            [['description'], 'string', 'max' => 80],
            [['level'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'employeeLevelId' => 'Employee Level ID',
            'status' => 'Status',
            'level' => 'Level',
            'description' => 'Description',
        ];
    }
}
