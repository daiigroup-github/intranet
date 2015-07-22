<?php

namespace frontend\models;

use Yii;
use \common\models\master\AuthitemchildMaster;

/**
 * This is the model class for table "authitemchild".
 *
 * @property string $parent
 * @property string $child
 *
 * @property Authitem $parent0
 * @property Authitem $child0
class Authitemchild extends \common\models\master\AuthitemchildMaster
*/
class Authitemchild extends AuthitemchildMaster
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
