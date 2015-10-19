<?php

namespace frontend\models;

use Yii;
use \common\models\master\QsafProductCategoryMaster;

/**
 * This is the model class for table "qsaf_product_category".
 *
 * @property integer $productCategoryId
 * @property integer $websiteId
 * @property integer $status
 * @property string $name
 * @property string $description
 * @property string $shortDescription
 * @property string $imageUrl
 * @property integer $parentId
class QsafProductCategory extends \common\models\master\QsafProductCategoryMaster
*/
class QsafProductCategory extends QsafProductCategoryMaster
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
