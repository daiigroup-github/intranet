<?php

namespace frontend\models;

use Yii;
use \common\models\master\StockDetailMaster;

/**
 * This is the model class for table "stock_detail".
 *
 * @property string $stockDetailId
 * @property string $stockDetailCode
 * @property string $stockDetailName
 * @property string $stockDetailUnit
 * @property string $createDateTime
 * @property integer $status
class StockDetail extends \common\models\master\StockDetailMaster
*/
class StockDetail extends StockDetailMaster
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
