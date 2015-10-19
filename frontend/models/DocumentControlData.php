<?php

namespace frontend\models;

use Yii;
use \common\models\master\DocumentControlDataMaster;

/**
 * This is the model class for table "document_control_data".
 *
 * @property integer $documentControlDataId
 * @property string $documentControlDataName
 * @property string $dataModel
 * @property string $dataMethod
 * @property string $fieldId
 * @property string $fieldValue
class DocumentControlData extends \common\models\master\DocumentControlDataMaster
*/
class DocumentControlData extends DocumentControlDataMaster
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
    public function getDocumentControlDataItems()
    {
        return $this->hasMany(DocumentControlDataItem::className(), ['documentControlDataId'=>'documentControlDataId']);
    }
}
