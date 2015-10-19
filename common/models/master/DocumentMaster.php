<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "document".
 *
 * @property string $documentId
 * @property string $documentCode
 * @property string $documentTypeId
 * @property integer $employeeId
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property integer $status
 * @property integer $isRead
 */
class DocumentMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['documentCode', 'documentTypeId', 'employeeId', 'createDateTime'], 'required'],
            [['documentTypeId', 'employeeId', 'status', 'isRead'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['documentCode'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'documentId' => 'Document ID',
            'documentCode' => 'Document Code',
            'documentTypeId' => 'Document Type ID',
            'employeeId' => 'Employee ID',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
            'status' => 'Status',
            'isRead' => 'Is Read',
        ];
    }
}
