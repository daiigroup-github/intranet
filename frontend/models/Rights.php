<?php

namespace frontend\models;

use Yii;
use \common\models\master\RightsMaster;

/**
 * This is the model class for table "rights".
 *
 * @property string $itemname
 * @property integer $type
 * @property integer $weight
 *
 * @property Authitem $itemname0
class Rights extends \common\models\master\RightsMaster
*/
class Rights extends RightsMaster
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
