<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "memo_log".
 *
 * @property integer $memoLogId
 * @property integer $memoId
 * @property integer $employeeId
 * @property string $remark
 * @property integer $status
 * @property string $createDateTime
 */
class MemoLogMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'memo_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['memoId', 'employeeId', 'remark', 'status', 'createDateTime'], 'required'],
            [['memoId', 'employeeId', 'status'], 'integer'],
            [['createDateTime'], 'safe'],
            [['remark'], 'string', 'max' => 2000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'memoLogId' => 'Memo Log ID',
            'memoId' => 'Memo ID',
            'employeeId' => 'Employee ID',
            'remark' => 'Remark',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
        ];
    }
}
