<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "document_document_group".
 *
 * @property string $id
 * @property integer $documentId
 * @property integer $documentGroupId
 */
class DocumentDocumentGroupMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document_document_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['documentId', 'documentGroupId'], 'required'],
            [['documentId', 'documentGroupId'], 'integer'],
            [['documentGroupId'], 'unique']
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
            'documentGroupId' => 'Document Group ID',
        ];
    }
}
