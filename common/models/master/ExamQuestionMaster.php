<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "exam_question".
 *
 * @property integer $examQuestionId
 * @property integer $status
 * @property string $title
 * @property string $description
 * @property integer $questionType
 * @property integer $startRange
 * @property integer $stopRange
 * @property string $weight
 */
class ExamQuestionMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam_question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'questionType', 'startRange', 'stopRange'], 'integer'],
            [['title', 'questionType'], 'required'],
            [['description'], 'string'],
            [['weight'], 'number'],
            [['title'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'examQuestionId' => 'Exam Question ID',
            'status' => 'Status',
            'title' => 'Title',
            'description' => 'Description',
            'questionType' => 'Question Type',
            'startRange' => 'Start Range',
            'stopRange' => 'Stop Range',
            'weight' => 'Weight',
        ];
    }
}
