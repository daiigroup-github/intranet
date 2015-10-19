<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "qsaf_customer_promotion".
 *
 * @property integer $qsafCustomerPromotionId
 * @property integer $status
 * @property integer $customerId
 * @property integer $qsafPromotionId
 * @property string $promotionCode
 * @property string $remarks
 */
class QsafCustomerPromotionMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qsaf_customer_promotion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'customerId', 'qsafPromotionId'], 'integer'],
            [['customerId', 'qsafPromotionId', 'promotionCode'], 'required'],
            [['remarks'], 'string'],
            [['promotionCode'], 'string', 'max' => 20],
            [['promotionCode'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'qsafCustomerPromotionId' => 'Qsaf Customer Promotion ID',
            'status' => 'Status',
            'customerId' => 'Customer ID',
            'qsafPromotionId' => 'Qsaf Promotion ID',
            'promotionCode' => 'Promotion Code',
            'remarks' => 'Remarks',
        ];
    }
}
