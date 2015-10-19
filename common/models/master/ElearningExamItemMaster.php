<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "elearning_exam_item".
 *
 * @property string $id
 * @property integer $elearningExamId
 * @property integer $questionId
 * @property integer $choiceId
 * @property integer $isCorrect
 */
class ElearningExamItemMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'elearning_exam_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['elearningExamId', 'questionId', 'choiceId', 'isCorrect'], 'required'],
            [['elearningExamId', 'questionId', 'choiceId', 'isCorrect'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'elearningExamId' => 'Elearning Exam ID',
            'questionId' => 'Question ID',
            'choiceId' => 'Choice ID',
            'isCorrect' => 'Is Correct',
        ];
    }
}
