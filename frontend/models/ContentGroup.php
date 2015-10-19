<?php

namespace frontend\models;

use Yii;
use \common\models\master\ContentGroupMaster;

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
class ContentGroup extends \common\models\master\ContentGroupMaster
*/
class ContentGroup extends ContentGroupMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }

    /**
     * relation
     */
    public function getContents()
    {
        return $this->hasMany(Content::className(), ['contentGroupId'=>'contentGroupId']);
    }
}
