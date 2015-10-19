<?php

namespace frontend\models;

use Yii;
use \common\models\master\WorkflowStateMaster;

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
class WorkflowState extends \common\models\master\WorkflowStateMaster
 */
class WorkflowState extends WorkflowStateMaster
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
    public function getWorkflowCurrent()
    {
        return $this->hasOne(Workflow::className(), ['workflowId' => 'currentState']);
    }

    public function getWorkflowStatus()
    {
        return $this->hasOne(WorkflowStatus::className(), ['workflowStatusId' => 'workflowStatusId']);
    }

    //relation

    public function getEstimateTime($numHour = null)
    {
        $numHour = isset($numHour) ? $numHour : $this->estimateHour;

        $day = ($numHour >= 24) ?  floor($numHour/24) : 0;
        $hour = $numHour % 24;

        return ['day' => $day, 'hour' => $hour];
    }
}
