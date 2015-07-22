<?php

namespace common\models\master;

use Yii;

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
 */
class DocumentTypeMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['documentTypeName', 'status', 'groupId'], 'required'],
            [['status', 'workflowGroupId', 'employeeId', 'employeeGroupId', 'hasItems', 'inMobile', 'groupId', 'canAssign', 'companyDivisionId'], 'integer'],
            [['documentTypeName'], 'string', 'max' => 500],
            [['documentTypeDescription'], 'string', 'max' => 3000],
            [['documentCodePrefix'], 'string', 'max' => 5],
            [['itemTable', 'transactionTable', 'customView'], 'string', 'max' => 200],
            [['customAction'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'documentTypeId' => 'Document Type ID',
            'documentTypeName' => 'Document Type Name',
            'documentTypeDescription' => 'Document Type Description',
            'documentCodePrefix' => 'Document Code Prefix',
            'status' => 'Status',
            'workflowGroupId' => 'Workflow Group ID',
            'employeeId' => 'Employee ID',
            'employeeGroupId' => 'Employee Group ID',
            'hasItems' => 'Has Items',
            'itemTable' => 'Item Table',
            'transactionTable' => 'Transaction Table',
            'inMobile' => 'In Mobile',
            'groupId' => 'Group ID',
            'customView' => 'Custom View',
            'customAction' => 'Custom Action',
            'canAssign' => 'Can Assign',
            'companyDivisionId' => 'Company Division ID',
        ];
    }
}
