<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "document_document_template_field".
 *
 * @property string $id
 * @property string $documentId
 * @property string $documentTemplateFieldId
 * @property string $value
 */
class DocumentDocumentTemplateFieldMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document_document_template_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['documentId', 'documentTemplateFieldId', 'value'], 'required'],
            [['documentId', 'documentTemplateFieldId'], 'integer'],
            [['value'], 'string', 'max' => 2000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'documentId' => 'Document ID',
            'documentTemplateFieldId' => 'Document Template Field ID',
            'value' => 'Value',
        ];
    }
}
