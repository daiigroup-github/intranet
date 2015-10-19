<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "qsaf_promotion".
 *
 * @property integer $qsafPromotionId
 * @property integer $status
 * @property string $qsafPromotionName
 * @property string $startDate
 * @property string $endDate
 */
class QsafPromotionMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qsaf_promotion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['startDate', 'endDate'], 'safe'],
            [['qsafPromotionName'], 'string', 'max' => 120]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'qsafPromotionId' => 'Qsaf Promotion ID',
            'status' => 'Status',
            'qsafPromotionName' => 'Qsaf Promotion Name',
            'startDate' => 'Start Date',
            'endDate' => 'End Date',
        ];
    }
}
