<?php

namespace frontend\models;

use Yii;
use \common\models\master\TheaterShowtimeMaster;

/**
 * This is the model class for table "theater_showtime".
 *
 * @property string $theaterShowtimeId
 * @property string $theaterId
 * @property string $theaterMovieId
 * @property string $showDate
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
class TheaterShowtime extends \common\models\master\TheaterShowtimeMaster
*/
class TheaterShowtime extends TheaterShowtimeMaster
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
