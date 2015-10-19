<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "qsaf_product_image".
 *
 * @property integer $productImageId
 * @property integer $status
 * @property string $imageUrl
 * @property integer $productId
 */
class QsafProductImageMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qsaf_product_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'productId'], 'integer'],
            [['imageUrl', 'productId'], 'required'],
            [['imageUrl'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'productImageId' => 'Product Image ID',
            'status' => 'Status',
            'imageUrl' => 'Image Url',
            'productId' => 'Product ID',
        ];
    }
}
