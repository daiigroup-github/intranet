<?php

namespace frontend\models;

use Yii;
use \common\models\master\DocumentDocumentGroupMaster;

/**
 * This is the model class for table "document_document_group".
 *
 * @property string $id
 * @property integer $documentId
 * @property integer $documentGroupId
class DocumentDocumentGroup extends \common\models\master\DocumentDocumentGroupMaster
*/
class DocumentDocumentGroup extends DocumentDocumentGroupMaster
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
