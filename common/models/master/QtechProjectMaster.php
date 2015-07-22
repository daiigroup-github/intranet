<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "qtech_project".
 *
 * @property integer $qtechProjectId
 * @property integer $status
 * @property string $createDateTime
 * @property integer $productCatId
 * @property integer $productValue
 * @property string $projectName
 * @property string $projectDetail
 * @property double $projectPrice
 * @property string $projectImageName
 * @property string $projectAddress
 * @property integer $customerId
 * @property integer $engineerId
 * @property integer $saleId
 * @property string $startDate
 * @property string $endDate
 * @property string $latitude
 * @property string $longitude
 * @property integer $branchValue
 */
class QtechProjectMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qtech_project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'productCatId', 'productValue', 'customerId', 'engineerId', 'saleId', 'branchValue'], 'integer'],
            [['createDateTime', 'productCatId', 'productValue', 'projectName', 'projectDetail', 'projectPrice', 'projectImageName', 'projectAddress', 'customerId', 'engineerId', 'saleId', 'startDate', 'endDate', 'latitude', 'longitude'], 'required'],
            [['createDateTime', 'startDate', 'endDate'], 'safe'],
            [['projectPrice'], 'number'],
            [['projectName'], 'string', 'max' => 100],
            [['projectDetail', 'projectImageName', 'projectAddress'], 'string', 'max' => 255],
            [['latitude', 'longitude'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'qtechProjectId' => 'Qtech Project ID',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'productCatId' => 'Product Cat ID',
            'productValue' => 'Product Value',
            'projectName' => 'Project Name',
            'projectDetail' => 'Project Detail',
            'projectPrice' => 'Project Price',
            'projectImageName' => 'Project Image Name',
            'projectAddress' => 'Project Address',
            'customerId' => 'Customer ID',
            'engineerId' => 'Engineer ID',
            'saleId' => 'Sale ID',
            'startDate' => 'Start Date',
            'endDate' => 'End Date',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'branchValue' => 'Branch Value',
        ];
    }
}
