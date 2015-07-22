<?php

namespace frontend\models;

use Yii;
use \common\models\master\DocumentWorkflowMaster;

/**
 * This is the model class for table "document_workflow".
 *
 * @property string $documentWorkflowId
 * @property string $documentId
 * @property integer $currentState
 * @property integer $documentGroupId
 * @property integer $isFinished
 * @property string $employeeId
 * @property string $groupId
 * @property string $createDateTime
class DocumentWorkflow extends \common\models\master\DocumentWorkflowMaster
*/
class DocumentWorkflow extends DocumentWorkflowMaster
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
