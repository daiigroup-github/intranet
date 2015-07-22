<?php

namespace frontend\models;

use Yii;
use \common\models\master\MobileAppPrivMaster;

/**
 * This is the model class for table "mobile_app_priv".
 *
 * @property integer $id
 * @property integer $status
 * @property integer $mobileAppId
 * @property integer $employeeId
 * @property integer $employeeCode
 * @property string $priv
class MobileAppPriv extends \common\models\master\MobileAppPrivMaster
*/
class MobileAppPriv extends MobileAppPrivMaster
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
