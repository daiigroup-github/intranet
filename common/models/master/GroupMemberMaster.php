<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "group_member".
 *
 * @property integer $groupMemberId
 * @property integer $status
 * @property integer $groupId
 * @property integer $employeeId
 */
class GroupMemberMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group_member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'groupId', 'employeeId'], 'required'],
            [['status', 'groupId', 'employeeId'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'groupMemberId' => 'Group Member ID',
            'status' => 'Status',
            'groupId' => 'Group ID',
            'employeeId' => 'Employee ID',
        ];
    }
}
