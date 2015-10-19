<?php

namespace common\models\master;

use Yii;

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
 */
class TheaterMovieMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'theater_movie';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['theaterCategoryId', 'title', 'image', 'createDateTime'], 'required'],
            [['theaterCategoryId', 'status'], 'integer'],
            [['description'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 200],
            [['length'], 'string', 'max' => 20],
            [['url', 'image', 'screenshotImage'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'theaterMovieId' => 'Theater Movie ID',
            'theaterCategoryId' => 'Theater Category ID',
            'title' => 'Title',
            'description' => 'Description',
            'length' => 'Length',
            'url' => 'Url',
            'image' => 'Image',
            'screenshotImage' => 'Screenshot Image',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
        ];
    }
}
