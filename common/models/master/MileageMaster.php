<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "mileage".
 *
 * @property integer $mileageId
 * @property integer $status
 * @property string $createDate
 * @property string $createTime
 * @property string $createDateTime
 * @property string $captureDateTime
 * @property integer $mileage
 * @property integer $mileageDiff
 * @property string $mileageDetail
 * @property string $mileageImage
 * @property string $latitude
 * @property string $longitude
 * @property integer $employeeId
 * @property string $employeeCode
 * @property integer $branchId
 * @property integer $projectId
 */
class MileageMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mileage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'mileage', 'mileageDiff', 'employeeId', 'branchId', 'projectId'], 'integer'],
            [['createDate', 'createTime', 'createDateTime', 'captureDateTime', 'mileage', 'mileageDiff', 'mileageImage', 'latitude', 'longitude', 'employeeId', 'employeeCode', 'branchId', 'projectId'], 'required'],
            [['createDate', 'createTime', 'createDateTime', 'captureDateTime'], 'safe'],
            [['mileageDetail'], 'string'],
            [['mileageImage'], 'string', 'max' => 255],
            [['latitude', 'longitude'], 'string', 'max' => 20],
            [['employeeCode'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mileageId' => 'Mileage ID',
            'status' => 'Status',
            'createDate' => 'Create Date',
            'createTime' => 'Create Time',
            'createDateTime' => 'Create Date Time',
            'captureDateTime' => 'Capture Date Time',
            'mileage' => 'Mileage',
            'mileageDiff' => 'Mileage Diff',
            'mileageDetail' => 'Mileage Detail',
            'mileageImage' => 'Mileage Image',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'employeeId' => 'Employee ID',
            'employeeCode' => 'Employee Code',
            'branchId' => 'Branch ID',
            'projectId' => 'Project ID',
        ];
    }
}
