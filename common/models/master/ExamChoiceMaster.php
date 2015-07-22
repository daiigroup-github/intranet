<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "exam_choice".
 *
 * @property string $examChoiceId
 * @property integer $status
 * @property string $title
 * @property string $value
 */
class ExamChoiceMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam_choice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['title', 'value'], 'required'],
            [['title', 'value'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'examChoiceId' => 'Exam Choice ID',
            'status' => 'Status',
            'title' => 'Title',
            'value' => 'Value',
        ];
    }
}
