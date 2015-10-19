<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "branch".
 *
 * @property integer $branchId
 * @property integer $status
 * @property integer $branchValue
 * @property string $branchName
 * @property string $latitude
 * @property string $longitude
 * @property string $address
 * @property string $image
 * @property string $tel
 */
class BranchMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'branch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'branchValue'], 'integer'],
            [['branchValue', 'branchName', 'latitude', 'longitude'], 'required'],
            [['address'], 'string'],
            [['branchName'], 'string', 'max' => 120],
            [['latitude', 'longitude'], 'string', 'max' => 20],
            [['image'], 'string', 'max' => 200],
            [['tel'], 'string', 'max' => 50],
            [['branchValue'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'branchId' => 'Branch ID',
            'status' => 'Status',
            'branchValue' => 'Branch Value',
            'branchName' => 'Branch Name',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'address' => 'Address',
            'image' => 'Image',
            'tel' => 'Tel',
        ];
    }
}
