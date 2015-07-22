<?php

namespace frontend\models;

use Yii;
use \common\models\master\CompanyDivisionMaster;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "company_division".
 *
 * @property integer $companyDivisionId
 * @property integer $status
 * @property integer $companyDivisionValue
 * @property string $description
class CompanyDivision extends \common\models\master\CompanyDivisionMaster
*/
class CompanyDivision extends CompanyDivisionMaster
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

    public function getAllCompanyDivision()
    {
        return ArrayHelper::map(CompanyDivision::find()->where('status=1')->all(), 'companyDivisionId', 'description');
    }
}
