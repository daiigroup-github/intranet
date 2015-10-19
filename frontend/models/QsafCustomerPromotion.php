<?php

namespace frontend\models;

use Yii;
use \common\models\master\QsafCustomerPromotionMaster;

/**
 * This is the model class for table "qsaf_customer_promotion".
 *
 * @property integer $qsafCustomerPromotionId
 * @property integer $status
 * @property integer $customerId
 * @property integer $qsafPromotionId
 * @property string $promotionCode
 * @property string $remarks
class QsafCustomerPromotion extends \common\models\master\QsafCustomerPromotionMaster
*/
class QsafCustomerPromotion extends QsafCustomerPromotionMaster
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
