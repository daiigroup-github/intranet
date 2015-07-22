<?php

namespace frontend\models;

use Yii;
use \common\models\master\DocumentItemMaster;

/**
 * This is the model class for table "document_item".
 *
 * @property integer $documentItemId
 * @property integer $documentId
 * @property string $documentItemName
 * @property string $file
 * @property string $description
 * @property string $remark
 * @property string $id
 * @property string $value
 * @property string $table
 * @property string $unit
 * @property string $description8
 * @property string $description9
 * @property string $description10
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
class DocumentItem extends \common\models\master\DocumentItemMaster
*/
class DocumentItem extends DocumentItemMaster
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
    public function getDocument()
    {
        return $this->hasOne(DocumentItem::className(), ['documentId'=>'documentId']);
    }
}
