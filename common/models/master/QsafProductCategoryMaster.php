<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "qsaf_product_category".
 *
 * @property integer $productCategoryId
 * @property integer $websiteId
 * @property integer $status
 * @property string $name
 * @property string $description
 * @property string $shortDescription
 * @property string $imageUrl
 * @property integer $parentId
 */
class QsafProductCategoryMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qsaf_product_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['websiteId'], 'required'],
            [['websiteId', 'status', 'parentId'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 45],
            [['shortDescription'], 'string', 'max' => 200],
            [['imageUrl'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'productCategoryId' => 'Product Category ID',
            'websiteId' => 'Website ID',
            'status' => 'Status',
            'name' => 'Name',
            'description' => 'Description',
            'shortDescription' => 'Short Description',
            'imageUrl' => 'Image Url',
            'parentId' => 'Parent ID',
        ];
    }
}
