<?php

namespace frontend\models;

use Yii;
use \common\models\master\GroupMaster;

/**
 * This is the model class for table "group".
 *
 * @property integer $groupId
 * @property integer $status
 * @property string $groupName
class Group extends \common\models\master\GroupMaster
*/
class Group extends GroupMaster
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

    /**
     * relation
     */
    public function getDocumentTypes()
    {
        return $this->hasMany(DocumentType::className(), ['groupId'=>'groupId']);
    }

    public function getGroupMembers()
    {
        return $this->hasMany(GroupMember::className(), ['groupId'=>'groupId']);
    }
}
