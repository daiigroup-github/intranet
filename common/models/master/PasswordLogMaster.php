<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "password_log".
 *
 * @property integer $id
 * @property integer $employeeId
 * @property string $createDateTime
 * @property string $password
 */
class PasswordLogMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'password_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employeeId', 'createDateTime', 'password'], 'required'],
            [['employeeId'], 'integer'],
            [['createDateTime'], 'safe'],
            [['password'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employeeId' => 'Employee ID',
            'createDateTime' => 'Create Date Time',
            'password' => 'Password',
        ];
    }
}
