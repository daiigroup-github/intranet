<?php

namespace frontend\models;

use Yii;
use \common\models\master\CustomerMaster;

/**
 * This is the model class for table "customer".
 *
 * @property integer $customerId
 * @property string $createDateTime
 * @property integer $customerType
 * @property string $customerFnTh
 * @property string $customerLnTh
 * @property string $customerCompany
 * @property string $firstname
 * @property string $lastname
 * @property string $company
 * @property string $email
 * @property string $password
 * @property integer $companyValue
 * @property integer $saleId
 * @property integer $engineerId
 * @property integer $branchId
 * @property integer $branchValue
 * @property string $address
 * @property string $city
 * @property integer $districtId
 * @property integer $amphurId
 * @property integer $provinceId
 * @property string $zipcode
 * @property string $phone
 * @property string $fax
 * @property string $mobile
 * @property integer $status
class Customer extends \common\models\master\CustomerMaster
*/
class Customer extends CustomerMaster
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
