<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property string $stockId
 * @property string $stockDetailId
 * @property string $companyId
 * @property integer $stockQuantity
 * @property string $stockUnitPrice
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property integer $status
 */
class StockMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stockDetailId', 'companyId', 'stockQuantity', 'stockUnitPrice', 'createDateTime', 'status'], 'required'],
            [['stockDetailId', 'companyId', 'stockQuantity', 'status'], 'integer'],
            [['stockUnitPrice'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'stockId' => 'Stock ID',
            'stockDetailId' => 'Stock Detail ID',
            'companyId' => 'Company ID',
            'stockQuantity' => 'Stock Quantity',
            'stockUnitPrice' => 'Stock Unit Price',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
            'status' => 'Status',
        ];
    }
}
