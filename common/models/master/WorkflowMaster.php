<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "workflow".
 *
 * @property string $workflowId
 * @property string $workflowName
 * @property integer $WorkFlowType
 * @property integer $employeeId
 * @property integer $groupId
 */
class WorkflowMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'workflow';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['workflowName', 'WorkFlowType'], 'required'],
            [['WorkFlowType', 'employeeId', 'groupId'], 'integer'],
            [['workflowName'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'workflowId' => 'Workflow ID',
            'workflowName' => 'Workflow Name',
            'WorkFlowType' => 'Work Flow Type',
            'employeeId' => 'Employee ID',
            'groupId' => 'Group ID',
        ];
    }
}
