<?php

namespace frontend\models;

use Yii;
use \common\models\master\TheaterEmployeeMovieRequireMaster;

/**
 * This is the model class for table "theater_employee_movie_require".
 *
 * @property string $theaterEmployeeMovieRequireId
 * @property string $employeeId
 * @property string $description
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
class TheaterEmployeeMovieRequire extends \common\models\master\TheaterEmployeeMovieRequireMaster
*/
class TheaterEmployeeMovieRequire extends TheaterEmployeeMovieRequireMaster
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
