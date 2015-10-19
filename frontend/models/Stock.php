<?php

namespace frontend\models;

use Yii;
use \common\models\master\StockMaster;

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
 *
 * @property Company $company
class Stock extends \common\models\master\StockMaster
*/
class Stock extends StockMaster
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
