<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "leave".
 *
 * @property integer $leaveId
 * @property integer $status
 * @property string $documentId
 * @property integer $leaveType
 * @property integer $isLate
 * @property string $filePath
 */
class LeaveMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'leave';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'documentId', 'leaveType', 'isLate'], 'integer'],
            [['documentId', 'leaveType'], 'required'],
            [['filePath'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'leaveId' => 'Leave ID',
            'status' => 'Status',
            'documentId' => 'Document ID',
            'leaveType' => 'Leave Type',
            'isLate' => 'Is Late',
            'filePath' => 'File Path',
        ];
    }
}
