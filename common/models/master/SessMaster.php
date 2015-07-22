<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "sess".
 *
 * @property integer $employeeId
 * @property string $sessId
 * @property string $datetime
 */
class SessMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sess';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employeeId', 'sessId', 'datetime'], 'required'],
            [['employeeId'], 'integer'],
            [['datetime'], 'safe'],
            [['sessId'], 'string', 'max' => 40],
            [['sessId'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'employeeId' => 'Employee ID',
            'sessId' => 'Sess ID',
            'datetime' => 'Datetime',
        ];
    }
}
