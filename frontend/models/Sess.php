<?php

namespace frontend\models;

use Yii;
use \common\models\master\SessMaster;

/**
 * This is the model class for table "sess".
 *
 * @property integer $employeeId
 * @property string $sessId
 * @property string $datetime
class Sess extends \common\models\master\SessMaster
*/
class Sess extends SessMaster
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
