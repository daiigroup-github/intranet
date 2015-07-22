<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "workflow_status".
 *
 * @property string $workflowStatusId
 * @property string $workflowStatusName
 * @property string $workflowStatusGroup
 */
class WorkflowStatusMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'workflow_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['workflowStatusName'], 'required'],
            [['workflowStatusName'], 'string', 'max' => 80],
            [['workflowStatusGroup'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'workflowStatusId' => 'Workflow Status ID',
            'workflowStatusName' => 'Workflow Status Name',
            'workflowStatusGroup' => 'Workflow Status Group',
        ];
    }
}
