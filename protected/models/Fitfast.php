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
                'order' => 'fitfastTargets.month'
            ),
            'countSF' => array(
                self::HAS_MANY,
                'FitfastTarget',
                'fitfastId',
                'condition' => 'countSF.grade!=0'
            ),
            'fitfastTargetsWaitingForGrade' => array(
                self::HAS_MANY,
                'FitfastTarget',
                'fitfastId',
                'condition' => 'fitfastTargetsWaitingForGrade.status=2'
            ),
            'employee'=>array(
                self::BELONGS_TO,
                'Employee',
                'employeeId',
            ),
        ));
    }

    /**
     *
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return Cmap::mergeArray(parent::attributeLabels(), array(
            'halfS' => 's',
            'SS' => 'SS',
        ));
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     *         public function search()
     *         {
     *         }
     */

    public function getFitfastTypeArray()
    {
        return array(
            self::FITFAST_TYPE_PERFORMANCE => 'performances',
            self::FITFAST_TYPE_IMPLEMENT => 'implements'
        );
    }

    public function getFitfastTypeText()
    {
        $typeArray = $this->getFitfastTypeArray();
        return $typeArray[$this->type];
    }

    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

//        $criteria->compare('fitfastId',$this->fitfastId,true);
//        $criteria->compare('status',$this->status);
//        $criteria->compare('createDateTime',$this->createDateTime,true);
//        $criteria->compare('updateDateTime',$this->updateDateTime,true);
//        $criteria->compare('fitfastEmployeeId',$this->fitfastEmployeeId,true);
        $criteria->compare('employeeId',$this->employeeId,false, 'AND');
        $criteria->compare('title',$this->title,true, 'AND');
//        $criteria->compare('description',$this->description,true);
        $criteria->compare('type',$this->type, false, 'OR');
//        $criteria->compare('halfS',$this->halfS);
//        $criteria->compare('S',$this->S);
//        $criteria->compare('SS',$this->SS);
//        $criteria->compare('F',$this->F);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
