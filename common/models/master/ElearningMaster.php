<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "elearning".
 *
 * @property integer $elearningId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property string $title
 * @property string $description
 * @property string $pdfFile
 * @property integer $numberOfQuestion
 * @property integer $parentId
 */
class ElearningMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'elearning';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'numberOfQuestion', 'parentId'], 'integer'],
            [['createDateTime', 'title', 'numberOfQuestion'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['description'], 'string'],
            [['title', 'pdfFile'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'elearningId' => 'Elearning ID',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
            'title' => 'Title',
            'description' => 'Description',
            'pdfFile' => 'Pdf File',
            'numberOfQuestion' => 'Number Of Question',
            'parentId' => 'Parent ID',
        ];
    }
}
