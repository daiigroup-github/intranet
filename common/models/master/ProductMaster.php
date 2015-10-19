<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $productId
 * @property integer $status
 * @property integer $productValue
 * @property string $productName
 * @property string $productDetail
 * @property integer $companyValue
 */
class ProductMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'productValue', 'companyValue'], 'integer'],
            [['productValue', 'productName', 'productDetail'], 'required'],
            [['productName'], 'string', 'max' => 80],
            [['productDetail'], 'string', 'max' => 100]
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
            'productValue' => 'Product Value',
            'productName' => 'Product Name',
            'productDetail' => 'Product Detail',
            'companyValue' => 'Company Value',
        ];
    }
}
