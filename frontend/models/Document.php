<?php

namespace frontend\models;

use Yii;
use \common\models\master\DocumentMaster;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "document".
 *
 * @property string $documentId
 * @property string $documentCode
 * @property string $documentTypeId
 * @property integer $employeeId
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property integer $status
 * @property integer $isRead
class Document extends \common\models\master\DocumentMaster
 */
class Document extends DocumentMaster
{
    public $maxCode;
    public $currentStatus;
    public $statusName;
    public $isFinished;
    //Search
    public $startDate;
    public $endDate;
    public $isOwner;
    public $workflowStatusId;

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
    public function getDocumentType()
    {
        return $this->hasOne(DocumentType::className(), ['documentTypeId' => 'documentTypeId']);
    }

    public function getDocumentItems()
    {
        return $this->hasMany(DocumentItem::className(), ['documentId' => 'documentId']);
    }

    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['employeeId' => 'employeeId']);
    }

    // relation

    public function getCurrentStatusByDocumentId($documentId)
    {
        $model = Document::find()
//        ->leftJoin('workflow_log wl', 'wl.documentId=document.documentId')
//        ->leftJoin('workflow_state ws', 'ws.workflowStateId=wl.workflowStateId')
//        ->leftJoin('workflow w', 'w.workflowId=ws.currentState')
//        ->leftJoin('workflow_status ws2', 'ws2.workflowStatusId=ws.workflowStatusId')
                ->select('ws2.workflowStatusName as statusName, w.workflowName as currentStatus')
            ->join('LEFT JOIN', 'workflow_log wl', 'wl.documentId=document.documentId')
            ->join('LEFT JOIN', 'workflow_state ws', 'ws.workflowStateId=wl.workflowStateId')
            ->join('LEFT JOIN', 'workflow w', 'w.workflowId=ws.currentState')
            ->join('LEFT JOIN', 'workflow_status ws2', 'ws2.workflowStatusId=ws.workflowStatusId')
            ->andWhere(['=', 'document.documentId', $documentId])
            ->orderBy('wl.workflowLogId DESC')
            ->one();

        return isset($model->statusName) ? $model->currentStatus.' ('.$model->statusName.')' : 'Draft';
    }

    public function documentHistory()
    {
        $workFlowLogModels = WorkflowLog::find()
        ->where(['documentId'=>$this->documentId])
        ->orderBy('createDateTime DESC');

        return new ActiveDataProvider([
            'query' => $workFlowLogModels
        ]);

    }
}
