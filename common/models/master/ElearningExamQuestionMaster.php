<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "elearning_exam_question".
 *
 * @property integer $questionId
 * @property integer $status
 * @property string $title
 * @property string $description
 * @property string $elearningId
 */
class ElearningExamQuestionMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'elearning_exam_question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['title'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['elearningId'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'questionId' => 'Question ID',
            'status' => 'Status',
            'title' => 'Title',
            'description' => 'Description',
            'elearningId' => 'Elearning ID',
        ];
    }
}
