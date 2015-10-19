<?php

namespace frontend\models;

use Yii;
use \common\models\master\MobileAppMaster;

/**
 * This is the model class for table "mobile_app".
 *
 * @property integer $mobileAppId
 * @property integer $status
 * @property string $name
 * @property string $currentVersion
class MobileApp extends \common\models\master\MobileAppMaster
*/
class MobileApp extends MobileAppMaster
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
