<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "mobile_app".
 *
 * @property integer $mobileAppId
 * @property integer $status
 * @property string $name
 * @property string $currentVersion
 */
class MobileAppMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mobile_app';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['name', 'currentVersion'], 'required'],
            [['name'], 'string', 'max' => 80],
            [['currentVersion'], 'string', 'max' => 10],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mobileAppId' => 'Mobile App ID',
            'status' => 'Status',
            'name' => 'Name',
            'currentVersion' => 'Current Version',
        ];
    }
}
