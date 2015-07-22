<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "memo_to".
 *
 * @property integer $id
 * @property integer $memoId
 * @property integer $employeeId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class MemoToMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'memo_to';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['memoId', 'employeeId', 'status', 'createDateTime'], 'required'],
            [['memoId', 'employeeId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'memoId' => 'Memo ID',
            'employeeId' => 'Employee ID',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
        ];
    }
}
