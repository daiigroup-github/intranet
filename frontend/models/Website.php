<?php

namespace frontend\models;

use Yii;
use \common\models\master\WebsiteMaster;

/**
 * This is the model class for table "website".
 *
 * @property integer $websiteId
 * @property string $name
 * @property string $description
 * @property string $url
 * @property integer $type
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
class Website extends \common\models\master\WebsiteMaster
*/
class Website extends WebsiteMaster
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
