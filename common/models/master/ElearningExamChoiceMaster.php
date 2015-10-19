<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "elearning_exam_choice".
 *
 * @property integer $choiceId
 * @property integer $isCorrect
 * @property string $title
 * @property string $description
 * @property integer $questionId
 */
class ElearningExamChoiceMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'elearning_exam_choice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['isCorrect', 'questionId'], 'integer'],
            [['description'], 'string'],
            [['questionId'], 'required'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'choiceId' => 'Choice ID',
            'isCorrect' => 'Is Correct',
            'title' => 'Title',
            'description' => 'Description',
            'questionId' => 'Question ID',
        ];
    }
}
