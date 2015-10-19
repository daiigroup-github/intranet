<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "document_group".
 *
 * @property string $documentGroupId
 * @property string $documentGroupName
 * @property integer $status
 */
class DocumentGroupMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['documentGroupName', 'status'], 'required'],
            [['status'], 'integer'],
            [['documentGroupName'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'documentGroupId' => 'Document Group ID',
            'documentGroupName' => 'Document Group Name',
            'status' => 'Status',
        ];
    }
}
