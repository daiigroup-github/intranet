<?php

class FitfastTarget extends FitfastTargetMaster
{

    const GRADE_s = 0.5;
    const GRADE_S = 1;
    const GRADE_SS = 2;
    const GRADE_F = -1;

    const STATUS_NA = 0;
    const STATUS_CREATED = 0x1;
    const STATUS_UPLOADED = 0x2;
    const STATUS_GRADED = 0x4;
    const STATUS_CANCEL = 0x8;

    const UPLOAD_DATE = 20;

    public $sumGrade;

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
            'fitfast' => array(
                self::BELONGS_TO,
                'Fitfast',
                'fitfastId'
            ),
            'parent' => array(
                self::BELONGS_TO,
                'FitfastTarget',
                'parentId'
            ),
            'employee' => array(
                self::BELONGS_TO,
                'Employee',
                'employeeId'
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
    public function gradeArray()
    {
        return array(
            strval(self::GRADE_s) => 's',
            self::GRADE_S => 'S',
            self::GRADE_SS => 'SS',
            strval(self::GRADE_F) => 'F'
        );
    }

    public function gradeValue($grade)
    {
        return array_search($grade, $this->gradeArray());
    }

    public function gradeText($grade)
    {
        $gradeArray = $this->gradeArray();
        return $gradeArray[strval($grade)];
    }

    public function countGradeByFitfastId($fitfastId)
    {
        $grade['s'] = $this->count(array(
            'condition' => 'fitfastId=:fitfastId AND grade=:grade',
            'params' => array(
                ':fitfastId' => $fitfastId,
                ':grade' => self::GRADE_s
            )
        ));

        $grade['S'] = $this->count(array(
            'condition' => 'fitfastId=:fitfastId AND grade=:grade',
            'params' => array(
                ':fitfastId' => $fitfastId,
                ':grade' => self::GRADE_S
            )
        ));

        $grade['SS'] = $this->count(array(
            'condition' => 'fitfastId=:fitfastId AND grade=:grade',
            'params' => array(
                ':fitfastId' => $fitfastId,
                ':grade' => self::GRADE_SS
            )
        ));

        $grade['F'] = $this->count(array(
            'condition' => 'fitfastId=:fitfastId AND grade=:grade',
            'params' => array(
                ':fitfastId' => $fitfastId,
                ':grade' => self::GRADE_F
            )
        ));

        return $grade;
    }

    public function countGradeByFitfastModels($fitfastModels)
    {
        $s = 0;
        $S = 0;
        $SS = 0;
        $F = 0;
        foreach ($fitfastModels as $fitfastModel) {
            $grade = $this->countGradeByFitfastId($fitfastModel->fitfastId);
            $s += $grade['s'];
            $S += $grade['S'];
            $SS += $grade['SS'];
            $F += $grade['F'];
        }

        return array(
            's' => $s,
            'S' => $S,
            'SS' => $SS,
            'F' => $F
        );
    }

    public function statusArray()
    {
        return array(
            self::STATUS_CREATED => 'Create',
            self::STATUS_UPLOADED => 'Upload',
            self::STATUS_GRADED => 'Grade',
            self::STATUS_CANCEL => 'Cancel',
        );
    }

    /**
     * @param $month
     * @param int $type 1=>employee, 2=manager
     */
    public function countGradeByMonth($month, $type = 1)
    {
        $isManager = ($type == 1) ? 0 : 1;
        $employeeModels = Employee::model()->findAll(array(
            'condition' => 'employeeId!=1 AND status=1 AND isManager=:isManager',
            'params' => array(
                ':isManager' => $isManager
            )
        ));

        $res = array();

        foreach ($this->gradeArray() as $k => $v) {
            $criteria = new CDbCriteria();
            $criteria->condition = 'month=:month AND grade=:grade';
            $criteria->params = array(
                ':month' => $month,
                ':grade' => $k,
            );
            $criteria->addInCondition('employeeId', CHtml::listData($employeeModels, 'employeeId', 'employeeId'));

            $res[$v] = $this->count($criteria);

            if ($v == 'SS')
                $res[$v] *= 2;
        }

        return array_sum($res);
    }

    public function sumGradeByMonth($month, $type = 1)
    {
        $isManager = ($type == 1) ? 0 : 1;

        $employeeModels = Employee::model()->findAll(array(
            'condition' => 'employeeId!=1 AND status=1 AND isManager=:isManager',
            'params' => array(
                ':isManager' => $isManager
            )
        ));

        $res = array();

        foreach ($this->gradeArray() as $k => $v) {
            if ($v == 'F')
                continue;

            $criteria = new CDbCriteria();
            $criteria->condition = 'month=:month AND grade=:grade';
            $criteria->params = array(
                ':month' => $month,
                ':grade' => $k,
            );
            $criteria->addInCondition('employeeId', CHtml::listData($employeeModels, 'employeeId', 'employeeId'));
            $criteria->select = 'sum(grade) as sumGrade';

            $sumGrade = FitfastTarget::model()->find($criteria);

            $res[$v] = !empty($sumGrade->sumGrade) ? $sumGrade->sumGrade : 0;
        }

        return array_sum($res);
    }

    public function calculateGradeByMonth($month, $type = 1)
    {
        return ($this->countGradeByMonth($month, $type) == 0) ? 0 : number_format(($this->sumGradeByMonth($month, $type) / $this->countGradeByMonth($month, $type)) * 100, 2);
    }

    /**
     * Grade F for last month if not upload
     */
    public function gradeForDidNotUpload()
    {
        foreach ($this->allDidNotUpload() as $model) {
            $model->grade = -1;

            //update Fitfast
            $fitfastModel = $model->fitfast;
            $fitfastModel->F -= 1;

            //update FitfastEmployee
            $fitfastEmployeeModel = $model->fitfast->fitfastEmployee;
            $fitfastEmployeeModel->F -= 1;
            $fitfastEmployeeModel->percent = $fitfastEmployeeModel->calculatePercent();

            //save all
            $model->save();
            $fitfastModel->save();
            $fitfastEmployeeModel->save();
        }

    }

    public function allDidNotUpload()
    {
        $lastMonth = date('m') - 1;

        return $this->findAll(array(
            'condition' => 'grade=0 AND month=:lastMonth',
            'params' => array(
                ':lastMonth' => $lastMonth
            ),
        ));
    }
}
