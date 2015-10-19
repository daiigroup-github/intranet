<?php

namespace common\models\master;

use Yii;

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
 */
class WorkflowLogMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'workflow_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['documentId', 'workflowStateId', 'employeeId', 'remarks', 'estimateHour', 'isOverEstimate'], 'required'],
            [['documentId', 'workflowStateId', 'employeeId', 'groupId', 'estimateHour', 'numHour', 'isOverEstimate'], 'integer'],
            [['createDateTime'], 'safe'],
            [['remarks'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'workflowLogId' => 'Workflow Log ID',
            'documentId' => 'Document ID',
            'workflowStateId' => 'Workflow State ID',
            'employeeId' => 'Employee ID',
            'groupId' => 'Group ID',
            'createDateTime' => 'Create Date Time',
            'remarks' => 'Remarks',
            'estimateHour' => 'Estimate Hour',
            'numHour' => 'Num Hour',
            'isOverEstimate' => 'Is Over Estimate',
        ];
    }
}
