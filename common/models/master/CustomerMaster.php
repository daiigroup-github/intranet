<?php

namespace common\models\master;

use Yii;

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
 */
class CustomerMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createDateTime', 'customerFnTh', 'customerLnTh', 'firstname', 'lastname', 'saleId', 'address', 'provinceId', 'zipcode', 'mobile'], 'required'],
            [['createDateTime'], 'safe'],
            [['customerType', 'companyValue', 'saleId', 'engineerId', 'branchId', 'branchValue', 'districtId', 'amphurId', 'provinceId', 'status'], 'integer'],
            [['address'], 'string'],
            [['customerFnTh', 'firstname', 'city'], 'string', 'max' => 80],
            [['customerLnTh', 'customerCompany', 'lastname', 'company', 'email'], 'string', 'max' => 120],
            [['password'], 'string', 'max' => 40],
            [['zipcode'], 'string', 'max' => 10],
            [['phone'], 'string', 'max' => 30],
            [['fax', 'mobile'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customerId' => 'Customer ID',
            'createDateTime' => 'Create Date Time',
            'customerType' => 'Customer Type',
            'customerFnTh' => 'Customer Fn Th',
            'customerLnTh' => 'Customer Ln Th',
            'customerCompany' => 'Customer Company',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'company' => 'Company',
            'email' => 'Email',
            'password' => 'Password',
            'companyValue' => 'Company Value',
            'saleId' => 'Sale ID',
            'engineerId' => 'Engineer ID',
            'branchId' => 'Branch ID',
            'branchValue' => 'Branch Value',
            'address' => 'Address',
            'city' => 'City',
            'districtId' => 'District ID',
            'amphurId' => 'Amphur ID',
            'provinceId' => 'Province ID',
            'zipcode' => 'Zipcode',
            'phone' => 'Phone',
            'fax' => 'Fax',
            'mobile' => 'Mobile',
            'status' => 'Status',
        ];
    }
}
