<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property integer $groupId
 * @property integer $status
 * @property string $groupName
 */
class GroupMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['groupName'], 'required'],
            [['groupName'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'groupId' => 'Group ID',
            'status' => 'Status',
            'groupName' => 'Group Name',
        ];
    }
}
