<?php

namespace common\models\master;

use Yii;

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
 */
class QsafPromotionCodeMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qsaf_promotion_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createDateTime', 'code', 'customerId', 'ciId'], 'required'],
            [['createDateTime'], 'safe'],
            [['status', 'customerId', 'ciId'], 'integer'],
            [['remarks'], 'string'],
            [['code'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'promotionCodeId' => 'Promotion Code ID',
            'createDateTime' => 'Create Date Time',
            'status' => 'Status',
            'code' => 'Code',
            'customerId' => 'Customer ID',
            'ciId' => 'Ci ID',
            'remarks' => 'Remarks',
        ];
    }
}
