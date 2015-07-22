<?php

namespace frontend\models;

use Yii;
use \common\models\master\QsafProductMaster;

/**
 * This is the model class for table "qsaf_product".
 *
 * @property integer $productId
 * @property integer $status
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $shortDescription
 * @property double $area
 * @property integer $bedroom
 * @property integer $restroom
 * @property integer $garage
 * @property double $priceSt
 * @property double $priceAr
 * @property double $priceOp
 * @property integer $productStyleId
 * @property integer $floor
 * @property string $imageUrl
 * @property integer $productCategoryId
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property string $remarks
class QsafProduct extends \common\models\master\QsafProductMaster
*/
class QsafProduct extends QsafProductMaster
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
