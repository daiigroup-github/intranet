<?php

namespace frontend\models;

use Yii;
use \common\models\master\PasswordLogMaster;

/**
 * This is the model class for table "password_log".
 *
 * @property integer $id
 * @property integer $employeeId
 * @property string $createDateTime
 * @property string $password
class PasswordLog extends \common\models\master\PasswordLogMaster
*/
class PasswordLog extends PasswordLogMaster
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
