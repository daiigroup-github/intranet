<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "company_division".
 *
 * @property integer $companyDivisionId
 * @property integer $status
 * @property integer $companyDivisionValue
 * @property string $description
 */
class CompanyDivisionMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_division';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'companyDivisionValue'], 'integer'],
            [['companyDivisionValue', 'description'], 'required'],
            [['description'], 'string', 'max' => 100],
            [['companyDivisionValue'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'companyDivisionId' => 'Company Division ID',
            'status' => 'Status',
            'companyDivisionValue' => 'Company Division Value',
            'description' => 'Description',
        ];
    }
}
