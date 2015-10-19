<?php

namespace frontend\models;

use Yii;
use \common\models\master\QsafPromotionMaster;

/**
 * This is the model class for table "qsaf_promotion".
 *
 * @property integer $qsafPromotionId
 * @property integer $status
 * @property string $qsafPromotionName
 * @property string $startDate
 * @property string $endDate
class QsafPromotion extends \common\models\master\QsafPromotionMaster
*/
class QsafPromotion extends QsafPromotionMaster
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
