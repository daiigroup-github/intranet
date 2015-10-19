<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "workflow_group".
 *
 * @property string $workflowGroupId
 * @property string $workflowGroupName
 */
class WorkflowGroupMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'workflow_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['workflowGroupName'], 'required'],
            [['workflowGroupName'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'workflowGroupId' => 'Workflow Group ID',
            'workflowGroupName' => 'Workflow Group Name',
        ];
    }
}
