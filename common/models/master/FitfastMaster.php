<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "fitfast".
 *
 * @property integer $fitfastId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property integer $fitfastEmployeeId
 * @property integer $employeeId
 * @property string $title
 * @property string $description
 * @property integer $type
 * @property integer $halfS
 * @property integer $S
 * @property integer $SS
 * @property integer $F
 */
class FitfastMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fitfast';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'fitfastEmployeeId', 'employeeId', 'type', 'halfS', 'S', 'SS', 'F'], 'integer'],
            [['createDateTime', 'updateDateTime', 'fitfastEmployeeId', 'employeeId', 'title', 'type'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title', 'description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fitfastId' => 'Fitfast ID',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
            'fitfastEmployeeId' => 'Fitfast Employee ID',
            'employeeId' => 'Employee ID',
            'title' => 'Title',
            'description' => 'Description',
            'type' => 'Type',
            'halfS' => 'Half S',
            'S' => 'S',
            'SS' => 'Ss',
            'F' => 'F',
        ];
    }
}
