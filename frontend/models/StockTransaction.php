<?php

namespace frontend\models;

use Yii;
use \common\models\master\StockTransactionMaster;

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
class StockTransaction extends \common\models\master\StockTransactionMaster
*/
class StockTransaction extends StockTransactionMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }
}
