<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "qsaf_product".
 *
 * @property integer $productId
 * @property integer $status
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $shortDescription
 * @property double $area
 * @property integer $bedroom
 * @property integer $restroom
 * @property integer $garage
 * @property double $priceSt
 * @property double $priceAr
 * @property double $priceOp
 * @property integer $productStyleId
 * @property integer $floor
 * @property string $imageUrl
 * @property integer $productCategoryId
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property string $remarks
 */
class QsafProductMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qsaf_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'bedroom', 'restroom', 'garage', 'productStyleId', 'floor', 'productCategoryId'], 'integer'],
            [['code', 'name', 'description', 'shortDescription', 'area', 'bedroom', 'restroom', 'garage', 'priceSt', 'priceAr', 'priceOp', 'productStyleId', 'floor', 'productCategoryId', 'createDateTime', 'updateDateTime'], 'required'],
            [['description', 'remarks'], 'string'],
            [['area', 'priceSt', 'priceAr', 'priceOp'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['code'], 'string', 'max' => 10],
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
            'productId' => 'Product ID',
            'status' => 'Status',
            'code' => 'Code',
            'name' => 'Name',
            'description' => 'Description',
            'shortDescription' => 'Short Description',
            'area' => 'Area',
            'bedroom' => 'Bedroom',
            'restroom' => 'Restroom',
            'garage' => 'Garage',
            'priceSt' => 'Price St',
            'priceAr' => 'Price Ar',
            'priceOp' => 'Price Op',
            'productStyleId' => 'Product Style ID',
            'floor' => 'Floor',
            'imageUrl' => 'Image Url',
            'productCategoryId' => 'Product Category ID',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
            'remarks' => 'Remarks',
        ];
    }
}
