<?php

namespace frontend\models;

use Yii;
use \common\models\master\AuthassignmentMaster;

/**
 * This is the model class for table "authassignment".
 *
 * @property string $itemname
 * @property string $userid
 * @property string $bizrule
 * @property string $data
 *
 * @property Authitem $itemname0
class Authassignment extends \common\models\master\AuthassignmentMaster
*/
class Authassignment extends AuthassignmentMaster
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
