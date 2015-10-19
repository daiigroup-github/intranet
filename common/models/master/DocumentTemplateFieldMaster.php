<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "document_template_field".
 *
 * @property string $documentTemplateFieldId
 * @property string $documentTemplateFieldName
 * @property integer $status
 * @property string $createDateTime
 */
class DocumentTemplateFieldMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document_template_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['documentTemplateFieldName', 'status', 'createDateTime'], 'required'],
            [['status'], 'integer'],
            [['createDateTime'], 'safe'],
            [['documentTemplateFieldName'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'documentTemplateFieldId' => 'Document Template Field ID',
            'documentTemplateFieldName' => 'Document Template Field Name',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
        ];
    }
}
