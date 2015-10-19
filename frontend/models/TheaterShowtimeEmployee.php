<?php

namespace frontend\models;

use Yii;
use \common\models\master\TheaterShowtimeEmployeeMaster;

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
class TheaterShowtimeEmployee extends \common\models\master\TheaterShowtimeEmployeeMaster
*/
class TheaterShowtimeEmployee extends TheaterShowtimeEmployeeMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }
}
