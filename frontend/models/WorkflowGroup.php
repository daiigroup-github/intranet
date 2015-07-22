<?php

namespace frontend\models;

use Yii;
use \common\models\master\WorkflowGroupMaster;

/**
 * This is the model class for table "workflow_group".
 *
 * @property string $workflowGroupId
 * @property string $workflowGroupName
class WorkflowGroup extends \common\models\master\WorkflowGroupMaster
*/
class WorkflowGroup extends WorkflowGroupMaster
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
    public function getDocumentTypes()
    {
        return $this->hasMany(DocumentType::className(), ['workflowGroupId'=>'workflowGroupId']);
    }
}
