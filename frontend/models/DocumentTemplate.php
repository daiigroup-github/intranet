<?php

namespace frontend\models;

use Yii;
use \common\models\master\DocumentTemplateMaster;

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
class DocumentTemplate extends \common\models\master\DocumentTemplateMaster
*/
class DocumentTemplate extends DocumentTemplateMaster
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
    public function getDucomentType()
    {
        return $this->hasOne(DocumentType::className(), ['documentTypeId'=>'documentTypeId']);
    }

    public function getDocumentTemplateField()
    {
        return $this->hasOne(DocumentTemplateField::className(), ['documentTemplateFieldId'=>'documentTemplateFieldId']);
    }

    public function getDocumentControlType()
    {
        return $this->hasOne(DocumentControlType::className(), ['documentControlTypeId'=>'documentControlTypeId']);
    }

    public function getDocumentControlData()
    {
        return $this->hasOne(DocumentControlData::className(), ['documentControlDataId'=>'documentControlDataId']);
    }
}
