<?php

namespace frontend\models;

use Yii;
use \common\models\master\QsafCiMaster;

/**
 * This is the model class for table "qsaf_ci".
 *
 * @property integer $ciId
 * @property string $createDateTime
 * @property integer $customerId
 * @property integer $mediaId
 * @property string $mediaOther
 * @property integer $productCategoryId
 * @property integer $restroom
 * @property integer $bedroom
 * @property integer $maidroom
 * @property integer $tabernacle
 * @property integer $kitchen
 * @property integer $garage
 * @property integer $area
 * @property integer $buildingType
 * @property integer $floorType
 * @property string $address
 * @property integer $landArea
 * @property integer $landWidth
 * @property integer $landDepth
 * @property integer $roadWidth
 * @property integer $pileType
 * @property integer $constructionTime
 * @property integer $budgetType
 * @property integer $payType
 * @property string $remarks
 * @property integer $dome
 * @property integer $swimmingPool
 * @property integer $fishPond
 * @property integer $livingroom
 * @property integer $diningroom
 * @property integer $storeroom
 * @property integer $studio
class QsafCi extends \common\models\master\QsafCiMaster
*/
class QsafCi extends QsafCiMaster
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
