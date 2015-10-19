<?php

namespace frontend\models;

use Yii;
use \common\models\master\TheaterCategoryMaster;

/**
 * This is the model class for table "theater_category".
 *
 * @property string $theaterCategoryId
 * @property string $title
 * @property string $description
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
class TheaterCategory extends \common\models\master\TheaterCategoryMaster
*/
class TheaterCategory extends TheaterCategoryMaster
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
