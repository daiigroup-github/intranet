<?php

namespace frontend\models;

use Yii;
use \common\models\master\ProductMaster;

/**
 * This is the model class for table "product".
 *
 * @property integer $productId
 * @property integer $status
 * @property integer $productValue
 * @property string $productName
 * @property string $productDetail
 * @property integer $companyValue
class Product extends \common\models\master\ProductMaster
*/
class Product extends ProductMaster
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
