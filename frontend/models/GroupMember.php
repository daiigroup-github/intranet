<?php

namespace frontend\models;

use Yii;
use \common\models\master\GroupMemberMaster;

/**
 * This is the model class for table "group_member".
 *
 * @property integer $groupMemberId
 * @property integer $status
 * @property integer $groupId
 * @property integer $employeeId
class GroupMember extends \common\models\master\GroupMemberMaster
*/
class GroupMember extends GroupMemberMaster
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
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['groupId'=>'groupId']);
    }

    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['employeeId'=>'employeeId']);
    }
}
