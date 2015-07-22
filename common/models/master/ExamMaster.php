<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "exam".
 *
 * @property integer $examId
 * @property integer $status
 * @property string $createDateTime
 * @property string $title
 * @property string $description
 * @property integer $creator
 */
class ExamMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'creator'], 'integer'],
            [['createDateTime'], 'safe'],
            [['title', 'creator'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'examId' => 'Exam ID',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'title' => 'Title',
            'description' => 'Description',
            'creator' => 'Creator',
        ];
    }
}
