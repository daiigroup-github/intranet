<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "mobile_app_priv".
 *
 * @property integer $id
 * @property integer $status
 * @property integer $mobileAppId
 * @property integer $employeeId
 * @property integer $employeeCode
 * @property string $priv
 */
class MobileAppPrivMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mobile_app_priv';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'mobileAppId', 'employeeId', 'employeeCode', 'priv'], 'integer'],
            [['mobileAppId', 'employeeId', 'employeeCode', 'priv'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'mobileAppId' => 'Mobile App ID',
            'employeeId' => 'Employee ID',
            'employeeCode' => 'Employee Code',
            'priv' => 'Priv',
        ];
    }
}
