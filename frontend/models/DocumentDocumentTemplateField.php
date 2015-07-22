<?php

namespace frontend\models;

use Yii;
use \common\models\master\DocumentDocumentTemplateFieldMaster;

/**
 * This is the model class for table "document_document_template_field".
 *
 * @property string $id
 * @property string $documentId
 * @property string $documentTemplateFieldId
 * @property string $value
class DocumentDocumentTemplateField extends \common\models\master\DocumentDocumentTemplateFieldMaster
*/
class DocumentDocumentTemplateField extends DocumentDocumentTemplateFieldMaster
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
