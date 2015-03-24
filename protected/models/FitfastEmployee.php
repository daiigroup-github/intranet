<?php

class FitfastEmployee extends FitfastEmployeeMaster
{
    const GRADE_HALF_S = 0.5;
    const GRADE_S = 1;
    const GRADE_SS = 2;
    const GRADE_F = -1;

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
        return Cmap::mergeArray(parent::attributeLabels(), array(
            'halfS' => 's',
            'forYear' => 'Year',
            'updateDateTime' => 'Last Update'
        ));
    }

    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

//        $criteria->compare('fitfastEmployeeId',$this->fitfastEmployeeId,true);
//        $criteria->compare('status',$this->status);
//        $criteria->compare('createDateTime',$this->createDateTime,true);
//        $criteria->compare('updateDateTime',$this->updateDateTime,true);
        $criteria->compare('t.employeeId', $this->employeeId, false);
//        $criteria->compare('halfS',$this->halfS);
//        $criteria->compare('S',$this->S);
//        $criteria->compare('SS',$this->SS);
//        $criteria->compare('F',$this->F);
        $criteria->compare('forYear', $this->forYear, true);
        $criteria->with = 'employee';
//        $criteria->addCondition('employee.status=1');
        $criteria->order = 'employee.fnTh';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function summaryGradeByEmployeeIdAndYear($employeeId, $forYear)
    {
        $fitfastEmployeeModel = FitfastEmployee::model()->find(array(
            'condition' => 'employeeId=:employeeId AND forYear=:forYear',
            'params' => array(
                ':employeeId' => $employeeId,
                ':forYear' => $forYear
            ),
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

    public function sumGrade()
    {
        return $this->halfS + $this->S + $this->SS * self::GRADE_SS - $this->F;
    }

    public function calculatePercent()
    {
        // % = ( $sum1 / $sum2 ) * 100
        $sum1 = $this->halfS * self::GRADE_HALF_S + $this->S + $this->SS * self::GRADE_SS;

        return ($this->sumGrade() == 0) ? 0 : number_format(($sum1 / $this->sumGrade()) * 100, 2);
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

    public function calculatePercentByDivisionId($companyId, $divisionId, $forYear, $isManager=0)
    {
        $sumPercent = 0;
        $employees = Employee::model()->findAll(array(
            'condition' => 'companyId=:companyId AND companyDivisionId=:companyDivisionId AND status=1 AND isManager=:isManager',
            'params' => array(
                ':companyId' => $companyId,
                ':companyDivisionId' => $divisionId,
                ':isManager'=>$isManager
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

    public function waitForGradeByEmployeeIdAndYear($employeeId, $forYear)
    {
        $w = array();
        $model = $this->find(array(
            'condition' => 'employeeId=:employeeId AND forYear=:forYear',
            'params' => array(
                ':employeeId' => $employeeId,
                ':forYear' => $forYear
            )
        ));

        foreach ($model->fitfasts as $fitfastModel) {
            if ($fitfastModel->fitfastTargetsWaitingForGrade !== array()) {
                $w[$fitfastModel->fitfastId]['title'] = $fitfastModel->title;

                foreach ($fitfastModel->fitfastTargetsWaitingForGrade as $fitfastTargetModel) {
                    $w[$fitfastModel->fitfastId]['fitfastTarget'][$fitfastTargetModel->fitfastTargetId]['target'] = $fitfastTargetModel->target;
                    $w[$fitfastModel->fitfastId]['fitfastTarget'][$fitfastTargetModel->fitfastTargetId]['month'] = $fitfastTargetModel->month;
                    $w[$fitfastModel->fitfastId]['fitfastTarget'][$fitfastTargetModel->fitfastTargetId]['file'] = $fitfastTargetModel->file;
                    $w[$fitfastModel->fitfastId]['fitfastTarget'][$fitfastTargetModel->fitfastTargetId]['updateDateTime'] = $fitfastTargetModel->updateDateTime;
                }
            }
        }

        return $w;
    }

    public function waitingForGradeInDivisionByManagerId($managerId)
    {
        $models = $this->with(array(
            'employee' => array(
                'joinType' => 'INNER JOIN',
                'condition' => 'employee.managerId=:managerId AND isManager=0',
                'params' => array(':managerId' => Yii::app()->user->id)
            )
        ))->findAll();

        $w = array();
        foreach ($models as $model) {
            $fe = array();
            foreach ($model->fitfasts as $fitfastModel) {
                if ($fitfastModel->fitfastTargetsWaitingForGrade === array())
                    continue;

                $fe[$fitfastModel->fitfastId]['title'] = $fitfastModel->title;
                foreach ($fitfastModel->fitfastTargetsWaitingForGrade as $fitfastTargetModel) {
                    $fe[$fitfastModel->fitfastId]['fitfastTarget'][$fitfastTargetModel->fitfastTargetId]['target'] = $fitfastTargetModel->target;
                    $fe[$fitfastModel->fitfastId]['fitfastTarget'][$fitfastTargetModel->fitfastTargetId]['month'] = $fitfastTargetModel->month;
                    $fe[$fitfastModel->fitfastId]['fitfastTarget'][$fitfastTargetModel->fitfastTargetId]['file'] = $fitfastTargetModel->file;
                    $fe[$fitfastModel->fitfastId]['fitfastTarget'][$fitfastTargetModel->fitfastTargetId]['updateDateTime'] = $fitfastTargetModel->updateDateTime;
                    $fe[$fitfastModel->fitfastId]['fitfastTarget'][$fitfastTargetModel->fitfastTargetId] = $fitfastTargetModel;
                }
            }

            if ($fe === array())
                continue;

            $w[$model->fitfastEmployeeId]['fitfast'] = $fe;
            $w[$model->fitfastEmployeeId]['name'] = $model->employee->fnTh;
        }

        return $w;
    }
}
