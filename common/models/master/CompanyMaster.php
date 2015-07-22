<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property string $companyId
 * @property integer $status
 * @property integer $companyValue
 * @property string $companyNameTh
 * @property string $companyNameEn
 */
class CompanyMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'companyValue'], 'integer'],
            [['companyValue', 'companyNameTh', 'companyNameEn'], 'required'],
            [['companyNameTh', 'companyNameEn'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'companyId' => 'Company ID',
            'status' => 'Status',
            'companyValue' => 'Company Value',
            'companyNameTh' => 'Company Name Th',
            'companyNameEn' => 'Company Name En',
        ];
    }
}
