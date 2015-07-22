<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "workflow_state".
 *
 * @property string $workflowStateId
 * @property string $workflowStateName
 * @property string $currentState
 * @property string $nextState
 * @property string $workflowStatusId
 * @property string $workflowGroupId
 * @property integer $requireConfirm
 * @property integer $ordered
 * @property integer $estimateHour
 */
class WorkflowStateMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'workflow_state';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['workflowStateName', 'currentState', 'workflowStatusId', 'workflowGroupId', 'ordered'], 'required'],
            [['currentState', 'nextState', 'workflowStatusId', 'workflowGroupId', 'requireConfirm', 'ordered', 'estimateHour'], 'integer'],
            [['workflowStateName'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'workflowStateId' => 'Workflow State ID',
            'workflowStateName' => 'Workflow State Name',
            'currentState' => 'Current State',
            'nextState' => 'Next State',
            'workflowStatusId' => 'Workflow Status ID',
            'workflowGroupId' => 'Workflow Group ID',
            'requireConfirm' => 'Require Confirm',
            'ordered' => 'Ordered',
            'estimateHour' => 'Estimate Hour',
        ];
    }
}
