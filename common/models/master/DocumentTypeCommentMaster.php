<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "document_type_comment".
 *
 * @property integer $id
 * @property integer $documentTypeId
 * @property integer $employeeId
 * @property string $comment
 * @property string $createDateTime
 */
class DocumentTypeCommentMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document_type_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['documentTypeId', 'employeeId', 'comment', 'createDateTime'], 'required'],
            [['documentTypeId', 'employeeId'], 'integer'],
            [['createDateTime'], 'safe'],
            [['comment'], 'string', 'max' => 3000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'documentTypeId' => 'Document Type ID',
            'employeeId' => 'Employee ID',
            'comment' => 'Comment',
            'createDateTime' => 'Create Date Time',
        ];
    }
}
