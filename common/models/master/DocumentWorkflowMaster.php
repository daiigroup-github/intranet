<?php

namespace common\models\master;

use Yii;

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
 */
class DocumentWorkflowMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document_workflow';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['documentId', 'currentState', 'createDateTime'], 'required'],
            [['documentId', 'currentState', 'documentGroupId', 'isFinished', 'employeeId', 'groupId'], 'integer'],
            [['createDateTime'], 'safe'],
            [['documentId'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'documentWorkflowId' => 'Document Workflow ID',
            'documentId' => 'Document ID',
            'currentState' => 'Current State',
            'documentGroupId' => 'Document Group ID',
            'isFinished' => 'Is Finished',
            'employeeId' => 'Employee ID',
            'groupId' => 'Group ID',
            'createDateTime' => 'Create Date Time',
        ];
    }
}
