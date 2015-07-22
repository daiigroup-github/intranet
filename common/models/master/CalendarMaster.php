<?php

namespace common\models\master;

use Yii;

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
 */
class CalendarMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calendar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'type'], 'integer'],
            [['title', 'date'], 'required'],
            [['description'], 'string'],
            [['startTime', 'endTime'], 'safe'],
            [['title'], 'string', 'max' => 80],
            [['date'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'calendarId' => 'Calendar ID',
            'status' => 'Status',
            'title' => 'Title',
            'description' => 'Description',
            'type' => 'Type',
            'date' => 'Date',
            'startTime' => 'Start Time',
            'endTime' => 'End Time',
        ];
    }
}
