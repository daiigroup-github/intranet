<?php

class Fitfast extends FitfastMaster
{

    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className
     *            active record class name.
     * @return Product the static model class
     */
    public $s;

    public $f;

    const FITFAST_TYPE_PERFORMANCE = 1;
    const FITFAST_TYPE_IMPLEMENT = 2;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     *
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return CMap::mergeArray(parent::rules(), array());
    }

    /**
     *
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return CMap::mergeArray(parent::relations(), array(
            // code here
            'fitfastEmployee' => array(
                self::BELONGS_TO,
                'FitfastEmployee',
                'fitfastEmployeeId'
            ),
            'fitfastTargets' => array(
                self::HAS_MANY,
                'FitfastTarget',
                'fitfastId',
                'order'=>'fitfastTargets.month'
            ),
            'countSF' => array(
                self::HAS_MANY,
                'FitfastTarget',
                'fitfastId',
                'condition' => 'countSF.grade!=0'
            ),
        ));
    }

    /**
     *
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return Cmap::mergeArray(parent::attributeLabels(), array());
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     *         public function search()
     *         {
     *         }
     */

    public function typeArray()
    {
        return array(
            self::FITFAST_TYPE_PERFORMANCE => 'performances',
            self::FITFAST_TYPE_IMPLEMENT => 'implements'
        );
    }

    public function typeText($type)
    {
        $typeArray = $this->typeArray();
        return $typeArray[$type];
    }
}
