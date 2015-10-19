<?php

namespace frontend\models;

use Yii;
use \common\models\master\CalendarMaster;

/**
 * This is the model class for table "calendar".
 *
 * @property integer $calendarId
 * @property integer $status
 * @property string $title
 * @property string $description
 * @property integer $type
 * @property string $date
 * @property string $startTime
 * @property string $endTime
class Calendar extends \common\models\master\CalendarMaster
*/
class Calendar extends CalendarMaster
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
