<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "fitfast_employee".
 *
 * @property integer $fitfastEmployeeId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property integer $employeeId
 * @property integer $halfS
 * @property integer $S
 * @property integer $SS
 * @property integer $F
 * @property string $forYear
 * @property double $percent
 */
class FitfastEmployeeMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fitfast_employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'employeeId', 'halfS', 'S', 'SS', 'F'], 'integer'],
            [['createDateTime', 'updateDateTime', 'employeeId', 'forYear'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['percent'], 'number'],
            [['forYear'], 'string', 'max' => 4]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fitfastEmployeeId' => 'Fitfast Employee ID',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
            'employeeId' => 'Employee ID',
            'halfS' => 'Half S',
            'S' => 'S',
            'SS' => 'Ss',
            'F' => 'F',
            'forYear' => 'For Year',
            'percent' => 'Percent',
        ];
    }
}
