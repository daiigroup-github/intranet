<?php

namespace common\models\master;

use Yii;

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
 */
class DocumentItemMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['documentId', 'documentItemName'], 'required'],
            [['documentId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['documentItemName', 'file', 'description', 'remark', 'id', 'value', 'table', 'unit', 'description8', 'description9', 'description10'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'documentItemId' => 'Document Item ID',
            'documentId' => 'Document ID',
            'documentItemName' => 'Document Item Name',
            'file' => 'File',
            'description' => 'Description',
            'remark' => 'Remark',
            'id' => 'ID',
            'value' => 'Value',
            'table' => 'Table',
            'unit' => 'Unit',
            'description8' => 'Description8',
            'description9' => 'Description9',
            'description10' => 'Description10',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
        ];
    }
}
