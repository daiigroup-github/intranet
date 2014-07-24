<?php

class FitfastEmployee extends FitfastEmployeeMaster
{

    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className
     *            active record class name.
     * @return Product the static model class
     */
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
            'fitfasts' => array(
                self::HAS_MANY,
                'Fitfast',
                'fitfastEmployeeId'
            ),
            'employee' => array(
                self::BELONGS_TO,
                'Employee',
                'employeeId'
            ),
            'performances' => array(
                self::HAS_MANY,
                'Fitfast',
                'fitfastEmployeeId',
                'condition' => 'performances.type=1',
            ),
            'implements' => array(
                self::HAS_MANY,
                'Fitfast',
                'fitfastEmployeeId',
                'condition' => 'implements.type=2'
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
    public function summaryGradeByEmployeeIdAndYear($employeeId, $forYear)
    {
        $fitfastEmployeeModel = FitfastEmployee::model()->find(array(
            'condition' => 'employeeId=:employeeId AND forYear=:forYear',
            'params' => array(
                ':employeeId' => $employeeId,
                ':forYear' => $forYear
            )
        ));

        $grade['summary'] = $fitfastEmployeeModel->sumS / ($fitfastEmployeeModel->sumS - $fitfastEmployeeModel->sumF);

        return $grade;
    }

    /*
    public function countGrade($fitfastEmployeeModel)
    {
        $sumGrade = 0;
        foreach ($fitfastEmployeeModel->fitfasts as $fitfast) {
            $sumGrade += sizeof($fitfast->countSF);
        }

        return $sumGrade;
    }
    */

    public function countGrade()
    {
        return array(
            's' => $this->halfS,
            'S' => $this->S,
            'SS' => $this->SS,
            'F' => $this->F
        );
    }

    public function calculatePercent()
    {
        // % = ( $sum1 / $sum2 ) * 100
        $sum1 = $this->halfS * FitfastTarget::GRADE_s + $this->S + $this->SS * FitfastTarget::GRADE_SS;
        $sum2 = $this->halfS + $this->S + $this->SS * FitfastTarget::GRADE_SS - $this->F;

        return ($sum2 == 0) ? 0 : number_format(($sum1 / $sum2) * 100, 2);
    }

    public function calculatePercentByEmployeeIdAndYear($employeeId, $forYear)
    {
        $model = $this->find(array(
            'condition' => 'employeeId=:employeeId AND forYear=:forYear',
            'params' => array(
                ':employeeId' => $employeeId,
                ':forYear' => $forYear
            )
        ));

        return array(
            'percent' => isset($model) ? $model->calculatePercent() : 0,
            'grades' => isset($model) ? $model->countGrade() : [],
        );
    }

    public function calculatePercentByDivisionId($companyId, $divisionId, $forYear)
    {
        $sumPercent = 0;
        $employees = Employee::model()->findAll(array(
            'condition' => 'companyId=:companyId AND companyDivisionId=:companyDivisionId AND status=1',
            'params' => array(
                ':companyId' => $companyId,
                ':companyDivisionId' => $divisionId
            )
        ));

        foreach ($employees as $employee) {
            $fitfastEmployeeModel = FitfastEmployee::model()->find(array(
                'condition' => 'employeeId=:employeeId AND forYear=:forYear',
                'params' => array(
                    ':employeeId' => $employee->employeeId,
                    ':forYear' => $forYear
                )
            ));

            if (isset($fitfastEmployeeModel))
                $sumPercent += $fitfastEmployeeModel->calculatePercent();
        }

        return number_format($sumPercent / sizeof($employees), 2);
    }
}
