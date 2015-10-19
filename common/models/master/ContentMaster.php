<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "content".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $imageSmall
 * @property string $image
 * @property integer $status
 * @property integer $contentGroupId
 * @property integer $sortOrder
 * @property string $parentId
 * @property integer $categoryId
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ContentMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'createDateTime'], 'required'],
            [['description', 'image'], 'string'],
            [['status', 'contentGroupId', 'sortOrder', 'categoryId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 50],
            [['imageSmall', 'parentId'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'imageSmall' => 'Image Small',
            'image' => 'Image',
            'status' => 'Status',
            'contentGroupId' => 'Content Group ID',
            'sortOrder' => 'Sort Order',
            'parentId' => 'Parent ID',
            'categoryId' => 'Category ID',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
        ];
    }
}
