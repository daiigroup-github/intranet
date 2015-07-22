<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "content_group".
 *
 * @property integer $contentGroupId
 * @property integer $websiteId
 * @property string $title
 * @property string $code
 * @property string $description
 * @property integer $status
 * @property string $customView
 * @property string $customForm
 * @property string $customCategoryFunction
 * @property integer $isShowHome
 * @property integer $sortOrder
 * @property string $viewType
 * @property integer $showSideBar
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ContentGroupMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['websiteId', 'title', 'code', 'description', 'createDateTime'], 'required'],
            [['websiteId', 'status', 'isShowHome', 'sortOrder', 'showSideBar'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 50],
            [['code'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 1000],
            [['customView', 'customForm', 'viewType'], 'string', 'max' => 100],
            [['customCategoryFunction'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'contentGroupId' => 'Content Group ID',
            'websiteId' => 'Website ID',
            'title' => 'Title',
            'code' => 'Code',
            'description' => 'Description',
            'status' => 'Status',
            'customView' => 'Custom View',
            'customForm' => 'Custom Form',
            'customCategoryFunction' => 'Custom Category Function',
            'isShowHome' => 'Is Show Home',
            'sortOrder' => 'Sort Order',
            'viewType' => 'View Type',
            'showSideBar' => 'Show Side Bar',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
        ];
    }
}
