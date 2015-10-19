<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "theater".
 *
 * @property string $theaterId
 * @property string $branchId
 * @property string $title
 * @property string $description
 * @property integer $seats
 * @property string $staffId
 * @property string $startTime
 * @property string $endTime
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class TheaterMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'theater';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branchId', 'title', 'seats', 'staffId', 'startTime', 'createDateTime'], 'required'],
            [['branchId', 'seats', 'staffId', 'status'], 'integer'],
            [['description'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 200],
            [['startTime', 'endTime'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'theaterId' => 'Theater ID',
            'branchId' => 'Branch ID',
            'title' => 'Title',
            'description' => 'Description',
            'seats' => 'Seats',
            'staffId' => 'Staff ID',
            'startTime' => 'Start Time',
            'endTime' => 'End Time',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
        ];
    }
}
