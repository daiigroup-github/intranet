<?php

namespace frontend\models;

use Yii;
use \common\models\master\ContentMaster;

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
class Content extends \common\models\master\ContentMaster
*/
class Content extends ContentMaster
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
    public function getContentGroup()
    {
        return $this->hasOne(ContentGroup::className(), ['contentGroupId'=>'contentGroupId']);
    }
}
