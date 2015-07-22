<?php

namespace frontend\models;

use Yii;
use \common\models\master\AuthitemMaster;

/**
 * This is the model class for table "authitem".
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $bizrule
 * @property string $data
 *
 * @property Authassignment[] $authassignments
 * @property Authitemchild[] $authitemchildren
 * @property Rights $rights
class Authitem extends \common\models\master\AuthitemMaster
*/
class Authitem extends AuthitemMaster
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
