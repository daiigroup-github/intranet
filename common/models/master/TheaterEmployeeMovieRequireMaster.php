<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "theater_employee_movie_require".
 *
 * @property string $theaterEmployeeMovieRequireId
 * @property string $employeeId
 * @property string $description
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class TheaterEmployeeMovieRequireMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'theater_employee_movie_require';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employeeId', 'description', 'createDateTime'], 'required'],
            [['employeeId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['description'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'theaterEmployeeMovieRequireId' => 'Theater Employee Movie Require ID',
            'employeeId' => 'Employee ID',
            'description' => 'Description',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
        ];
    }
}
