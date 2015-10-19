<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "document_template".
 *
 * @property string $id
 * @property string $documentTypeId
 * @property string $documentTemplateFieldId
 * @property integer $documentControlTypeId
 * @property integer $status
 * @property string $createDateTime
 * @property integer $documentControlDataId
 * @property integer $isItem
 * @property string $documentItemField
 * @property string $editState
 * @property string $addState
 * @property integer $fieldType
 */
class DocumentTemplateMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document_template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['documentTypeId', 'documentTemplateFieldId', 'documentControlTypeId', 'status', 'createDateTime'], 'required'],
            [['documentTypeId', 'documentTemplateFieldId', 'documentControlTypeId', 'status', 'documentControlDataId', 'isItem', 'fieldType'], 'integer'],
            [['createDateTime'], 'safe'],
            [['documentItemField'], 'string', 'max' => 100],
            [['editState', 'addState'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'documentTypeId' => 'Document Type ID',
            'documentTemplateFieldId' => 'Document Template Field ID',
            'documentControlTypeId' => 'Document Control Type ID',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'documentControlDataId' => 'Document Control Data ID',
            'isItem' => 'Is Item',
            'documentItemField' => 'Document Item Field',
            'editState' => 'Edit State',
            'addState' => 'Add State',
            'fieldType' => 'Field Type',
        ];
    }
}
