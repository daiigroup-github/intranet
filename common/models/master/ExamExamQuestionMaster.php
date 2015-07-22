<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "exam_exam_question".
 *
 * @property string $id
 * @property integer $status
 * @property integer $examId
 * @property integer $examQuestionId
 */
class ExamExamQuestionMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam_exam_question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'examId', 'examQuestionId'], 'integer'],
            [['examId', 'examQuestionId'], 'required']
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
            'examId' => 'Exam ID',
            'examQuestionId' => 'Exam Question ID',
        ];
    }
}
