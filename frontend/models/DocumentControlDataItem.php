<?php

namespace frontend\models;

use Yii;
use \common\models\master\DocumentControlDataItemMaster;

/**
 * This is the model class for table "document_control_data_item".
 *
 * @property integer $documentControlDataItemId
 * @property integer $documentControlDataId
 * @property integer $documentControlDataItemUseId
 * @property string $documentControlDataItemValue
class DocumentControlDataItem extends \common\models\master\DocumentControlDataItemMaster
*/
class DocumentControlDataItem extends DocumentControlDataItemMaster
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
    public function getDocumentControlData()
    {
        return $this->hasOne(DocumentControlDataItem::className(), ['documentControlDataId'=>'documentControlDataId']);
    }
}
