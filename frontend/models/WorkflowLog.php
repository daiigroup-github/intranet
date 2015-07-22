<?php

namespace frontend\models;

use Yii;
use \common\models\master\WorkflowLogMaster;

/**
 * This is the model class for table "workflow_log".
 *
 * @property string $workflowLogId
 * @property integer $documentId
 * @property integer $workflowStateId
 * @property integer $employeeId
 * @property integer $groupId
 * @property string $createDateTime
 * @property string $remarks
 * @property integer $estimateHour
 * @property integer $numHour
 * @property integer $isOverEstimate
class WorkflowLog extends \common\models\master\WorkflowLogMaster
*/
class WorkflowLog extends WorkflowLogMaster
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
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['employeeId'=>'employeeId']);
    }

    public function getWorkflowState()
    {
        return $this->hasOne(WorkflowState::className(), ['workflowStateId'=>'workflowStateId']);
    }

    // relation
}
