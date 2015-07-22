<?php

namespace frontend\models;

use Yii;
use \common\models\master\DocumentTemplateFieldMaster;

/**
 * This is the model class for table "document_template_field".
 *
 * @property string $documentTemplateFieldId
 * @property string $documentTemplateFieldName
 * @property integer $status
 * @property string $createDateTime
class DocumentTemplateField extends \common\models\master\DocumentTemplateFieldMaster
*/
class DocumentTemplateField extends DocumentTemplateFieldMaster
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
