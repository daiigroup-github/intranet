<?php

namespace frontend\models;

use Yii;
use \common\models\master\CompanyMaster;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "company".
 *
 * @property string $companyId
 * @property integer $status
 * @property integer $companyValue
 * @property string $companyNameTh
 * @property string $companyNameEn
 *
 * @property Stock[] $stocks
class Company extends \common\models\master\CompanyMaster
*/
class Company extends CompanyMaster
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

    public function getAllCompany()
    {
        return ArrayHelper::map(Company::find()->where('status=1')->all(), 'companyId', 'companyNameTh');
    }
}
