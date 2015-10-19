<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "theater_showtime_employee".
 *
 * @property string $id
 * @property string $reserveCode
 * @property string $theaterShowTimeId
 * @property string $employeeId
 * @property string $cancelRemark
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class TheaterShowtimeEmployeeMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'theater_showtime_employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['theaterShowTimeId', 'employeeId', 'createDateTime'], 'required'],
            [['theaterShowTimeId', 'employeeId', 'status'], 'integer'],
            [['cancelRemark'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['reserveCode'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reserveCode' => 'Reserve Code',
            'theaterShowTimeId' => 'Theater Show Time ID',
            'employeeId' => 'Employee ID',
            'cancelRemark' => 'Cancel Remark',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
        ];
    }
}
