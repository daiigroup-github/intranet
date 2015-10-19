<?php

namespace frontend\models;

use Yii;
use \common\models\master\QsafProductImageMaster;

/**
 * This is the model class for table "qsaf_product_image".
 *
 * @property integer $productImageId
 * @property integer $status
 * @property string $imageUrl
 * @property integer $productId
class QsafProductImage extends \common\models\master\QsafProductImageMaster
*/
class QsafProductImage extends QsafProductImageMaster
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
