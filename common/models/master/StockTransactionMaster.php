<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "stock_transaction".
 *
 * @property string $stockTransactionId
 * @property string $stockId
 * @property string $documentId
 * @property integer $stockTransactionQuantity
 * @property string $stockTransactionUnitPrice
 * @property string $stockTransactionTotalPrice
 * @property string $createDateTime
 */
class StockTransactionMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock_transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stockId', 'documentId', 'stockTransactionQuantity', 'stockTransactionUnitPrice', 'stockTransactionTotalPrice', 'createDateTime'], 'required'],
            [['stockId', 'documentId', 'stockTransactionQuantity'], 'integer'],
            [['stockTransactionUnitPrice', 'stockTransactionTotalPrice'], 'number'],
            [['createDateTime'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'stockTransactionId' => 'Stock Transaction ID',
            'stockId' => 'Stock ID',
            'documentId' => 'Document ID',
            'stockTransactionQuantity' => 'Stock Transaction Quantity',
            'stockTransactionUnitPrice' => 'Stock Transaction Unit Price',
            'stockTransactionTotalPrice' => 'Stock Transaction Total Price',
            'createDateTime' => 'Create Date Time',
        ];
    }
}
