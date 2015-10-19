<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "notice".
 *
 * @property integer $noticeId
 * @property string $title
 * @property string $headline
 * @property string $description
 * @property string $imageUrl
 * @property integer $employeeId
 * @property integer $status
 * @property integer $noticeTypeId
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class NoticeMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'employeeId', 'status', 'noticeTypeId'], 'required'],
            [['employeeId', 'status', 'noticeTypeId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title', 'headline'], 'string', 'max' => 500],
            [['description'], 'string', 'max' => 2000],
            [['imageUrl'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'noticeId' => 'Notice ID',
            'title' => 'Title',
            'headline' => 'Headline',
            'description' => 'Description',
            'imageUrl' => 'Image Url',
            'employeeId' => 'Employee ID',
            'status' => 'Status',
            'noticeTypeId' => 'Notice Type ID',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
        ];
    }
}
