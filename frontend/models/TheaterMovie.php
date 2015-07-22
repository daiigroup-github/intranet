<?php

namespace frontend\models;

use Yii;
use \common\models\master\TheaterMovieMaster;

/**
 * This is the model class for table "theater_movie".
 *
 * @property string $theaterMovieId
 * @property string $theaterCategoryId
 * @property string $title
 * @property string $description
 * @property string $length
 * @property string $url
 * @property string $image
 * @property string $screenshotImage
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
class TheaterMovie extends \common\models\master\TheaterMovieMaster
*/
class TheaterMovie extends TheaterMovieMaster
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
