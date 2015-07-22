<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "exam_question_exam_choice".
 *
 * @property string $id
 * @property integer $status
 * @property integer $examQuestionId
 * @property string $examChoiceId
 */
class ExamQuestionExamChoiceMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam_question_exam_choice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'examQuestionId', 'examChoiceId'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'examQuestionId' => 'Exam Question ID',
            'examChoiceId' => 'Exam Choice ID',
        ];
    }
}
