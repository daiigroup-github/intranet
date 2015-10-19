<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "stock_detail".
 *
 * @property string $stockDetailId
 * @property string $stockDetailCode
 * @property string $stockDetailName
 * @property string $stockDetailUnit
 * @property string $createDateTime
 * @property integer $status
 */
class StockDetailMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stockDetailCode', 'stockDetailName', 'stockDetailUnit', 'createDateTime', 'status'], 'required'],
            [['createDateTime'], 'safe'],
            [['status'], 'integer'],
            [['stockDetailCode'], 'string', 'max' => 20],
            [['stockDetailName'], 'string', 'max' => 500],
            [['stockDetailUnit'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'stockDetailId' => 'Stock Detail ID',
            'stockDetailCode' => 'Stock Detail Code',
            'stockDetailName' => 'Stock Detail Name',
            'stockDetailUnit' => 'Stock Detail Unit',
            'createDateTime' => 'Create Date Time',
            'status' => 'Status',
        ];
    }
}
