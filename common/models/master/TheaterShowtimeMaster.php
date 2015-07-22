<?php

namespace common\models\master;

use Yii;

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
 */
class TheaterShowtimeMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'theater_showtime';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['theaterId', 'theaterMovieId', 'showDate', 'createDateTime'], 'required'],
            [['theaterId', 'theaterMovieId', 'status'], 'integer'],
            [['showDate', 'createDateTime', 'updateDateTime'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'theaterShowtimeId' => 'Theater Showtime ID',
            'theaterId' => 'Theater ID',
            'theaterMovieId' => 'Theater Movie ID',
            'showDate' => 'Show Date',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
        ];
    }
}
