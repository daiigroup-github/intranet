<?php

namespace frontend\models;

use Yii;
use \common\models\master\MigrationMaster;

/**
 * This is the model class for table "migration".
 *
 * @property string $version
 * @property integer $apply_time
class Migration extends \common\models\master\MigrationMaster
*/
class Migration extends MigrationMaster
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
