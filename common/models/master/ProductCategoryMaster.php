<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "product_category".
 *
 * @property integer $productCatId
 * @property integer $status
 * @property integer $productCatValue
 * @property string $productCatName
 * @property integer $companyId
 */
class ProductCategoryMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'productCatValue', 'companyId'], 'integer'],
            [['companyId'], 'required'],
            [['productCatName'], 'string', 'max' => 120]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'productCatId' => 'Product Cat ID',
            'status' => 'Status',
            'productCatValue' => 'Product Cat Value',
            'productCatName' => 'Product Cat Name',
            'companyId' => 'Company ID',
        ];
    }
}
