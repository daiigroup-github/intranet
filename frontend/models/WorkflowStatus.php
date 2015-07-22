<?php

namespace frontend\models;

use Yii;
use \common\models\master\WorkflowStatusMaster;

/**
 * This is the model class for table "workflow_status".
 *
 * @property string $workflowStatusId
 * @property string $workflowStatusName
 * @property string $workflowStatusGroup
class WorkflowStatus extends \common\models\master\WorkflowStatusMaster
*/
class WorkflowStatus extends WorkflowStatusMaster
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
}
