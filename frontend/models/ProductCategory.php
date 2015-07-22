<?php

namespace frontend\models;

use Yii;
use \common\models\master\ProductCategoryMaster;

/**
 * This is the model class for table "product_category".
 *
 * @property integer $productCatId
 * @property integer $status
 * @property integer $productCatValue
 * @property string $productCatName
 * @property integer $companyId
class ProductCategory extends \common\models\master\ProductCategoryMaster
*/
class ProductCategory extends ProductCategoryMaster
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
