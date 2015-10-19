<?php

namespace frontend\models;

use Yii;
use \common\models\master\QsafPromotionCodeMaster;

/**
 * This is the model class for table "qsaf_promotion_code".
 *
 * @property integer $promotionCodeId
 * @property string $createDateTime
 * @property integer $status
 * @property string $code
 * @property integer $customerId
 * @property integer $ciId
 * @property string $remarks
class QsafPromotionCode extends \common\models\master\QsafPromotionCodeMaster
*/
class QsafPromotionCode extends QsafPromotionCodeMaster
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
