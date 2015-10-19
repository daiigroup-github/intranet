<?php

namespace frontend\models;

use Yii;
use \common\models\master\DocumentTypeMaster;

/**
 * This is the model class for table "document_type".
 *
 * @property string $documentTypeId
 * @property string $documentTypeName
 * @property string $documentTypeDescription
 * @property string $documentCodePrefix
 * @property integer $status
 * @property integer $workflowGroupId
 * @property integer $employeeId
 * @property string $employeeGroupId
 * @property integer $hasItems
 * @property string $itemTable
 * @property string $transactionTable
 * @property integer $inMobile
 * @property string $groupId
 * @property string $customView
 * @property string $customAction
 * @property integer $canAssign
 * @property integer $companyDivisionId
class DocumentType extends \common\models\master\DocumentTypeMaster
*/
class DocumentType extends DocumentTypeMaster
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
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['ducomentTypeId'=>'ducomentTypeId']);
    }

    public function getWorkflowGroup()
    {
        return $this->hasOne(WorkflowGroup::className(), ['workflowGroupId'=>'workflowGroupId']);
    }

    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['groupId'=>'groupId']);
    }

    public function getDocumentTemplates()
    {
        return $this->hasMany(DocumentTemplate::className(), ['documentTypeId'=>'documentTypeId']);
    }

    public function getCompanyDivision()
    {
        return $this->hasOne(CompanyDivision::className(), ['companyDivisionId'=>'companyDivisionId']);
    }
}
