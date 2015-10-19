<?php

namespace frontend\models;

use Yii;
use \common\models\master\WorkflowMaster;

/**
 * This is the model class for table "workflow".
 *
 * @property string $workflowId
 * @property string $workflowName
 * @property integer $WorkFlowType
 * @property integer $employeeId
 * @property integer $groupId
class Workflow extends \common\models\master\WorkflowMaster
*/
class Workflow extends WorkflowMaster
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
