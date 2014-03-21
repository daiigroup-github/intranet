<?php

/**
 * This is the model class for table "fit_and_fast".
 *
 * The followings are the available columns in table 'fit_and_fast':
 * @property string $fitAndFastId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property string $employeeId
 * @property string $title
 * @property string $description
 * @property integer $type
 * @property double $sumS
 * @property double $sumF
 * @property string $sumGrade
 * @property string $forYear
 * @property string $targetJan
 * @property integer $statusJan
 * @property string $actualJan
 * @property string $actualJanDateTime
 * @property string $gradeJan
 * @property string $gradeJanDateTime
 * @property string $fileJan
 * @property string $fileJanDateTime
 * @property string $targetFeb
 * @property integer $statusFeb
 * @property string $actualFeb
 * @property string $actualFebDateTime
 * @property string $gradeFeb
 * @property string $gradeFebDateTime
 * @property string $fileFeb
 * @property string $fileFebDateTime
 * @property string $targetMar
 * @property integer $statusMar
 * @property string $actualMar
 * @property string $actualMarDateTime
 * @property string $gradeMar
 * @property string $gradeMarDateTime
 * @property string $fileMar
 * @property string $fileMarDateTime
 * @property string $targetApr
 * @property integer $statusApr
 * @property string $actualApr
 * @property string $actualAprDateTime
 * @property string $gradeApr
 * @property string $gradeAprDateTime
 * @property string $fileApr
 * @property string $fileAprDateTime
 * @property string $targetMay
 * @property integer $statusMay
 * @property string $actualMay
 * @property string $actualMayDateTime
 * @property string $gradeMay
 * @property string $gradeMayDateTime
 * @property string $fileMay
 * @property string $fileMayDateTime
 * @property string $targetJun
 * @property integer $statusJun
 * @property string $actualJun
 * @property string $actualJunDateTime
 * @property string $gradeJun
 * @property string $gradeJunDateTime
 * @property string $fileJun
 * @property string $fileJunDateTime
 * @property string $targetJul
 * @property integer $statusJul
 * @property string $actualJul
 * @property string $actualJulDateTime
 * @property string $gradeJul
 * @property string $gradeJulDateTime
 * @property string $fileJul
 * @property string $fileJulDateTime
 * @property string $targetAug
 * @property integer $statusAug
 * @property string $actualAug
 * @property string $actualAugDateTime
 * @property string $gradeAug
 * @property string $gradeAugDateTime
 * @property string $fileAug
 * @property string $fileAugDateTime
 * @property string $targetSep
 * @property integer $statusSep
 * @property string $actualSep
 * @property string $actualSepDateTime
 * @property string $gradeSep
 * @property string $gradeSepDateTime
 * @property string $fileSep
 * @property string $fileSepDateTime
 * @property string $targetOct
 * @property integer $statusOct
 * @property string $actualOct
 * @property string $actualOctDateTime
 * @property string $gradeOct
 * @property string $gradeOctDateTime
 * @property string $fileOct
 * @property string $fileOctDateTime
 * @property string $targetNov
 * @property integer $statusNov
 * @property string $actualNov
 * @property string $actualNovDateTime
 * @property string $gradeNov
 * @property string $gradeNovDateTime
 * @property string $fileNov
 * @property string $fileNovDateTime
 * @property string $targetDec
 * @property integer $statusDec
 * @property string $actualDec
 * @property string $actualDecDateTime
 * @property string $gradeDec
 * @property string $gradeDecDateTime
 * @property string $fileDec
 * @property string $fileDecDateTime
 */
class FitAndFastMaster extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fit_and_fast';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('createDateTime, updateDateTime, employeeId, title, type, forYear', 'required'),
			array('status, type, statusJan, statusFeb, statusMar, statusApr, statusMay, statusJun, statusJul, statusAug, statusSep, statusOct, statusNov, statusDec', 'numerical', 'integerOnly'=>true),
			array('sumS, sumF', 'numerical'),
			array('employeeId', 'length', 'max'=>10),
			array('forYear', 'length', 'max'=>4),
			array('actualJan, actualFeb, actualMar, actualApr, actualMay, actualJun, actualJul, actualAug, actualSep, actualOct, actualNov, actualDec', 'length', 'max'=>45),
			array('gradeJan, gradeFeb, gradeMar, gradeApr, gradeMay, gradeJun, gradeJul, gradeAug, gradeSep, gradeOct, gradeNov, gradeDec', 'length', 'max'=>5),
			array('fileJan, fileFeb, fileMar, fileApr, fileMay, fileJun, fileJul, fileAug, fileSep, fileOct, fileNov, fileDec', 'length', 'max'=>255),
			array('description, sumGrade, targetJan, actualJanDateTime, gradeJanDateTime, fileJanDateTime, targetFeb, actualFebDateTime, gradeFebDateTime, fileFebDateTime, targetMar, actualMarDateTime, gradeMarDateTime, fileMarDateTime, targetApr, actualAprDateTime, gradeAprDateTime, fileAprDateTime, targetMay, actualMayDateTime, gradeMayDateTime, fileMayDateTime, targetJun, actualJunDateTime, gradeJunDateTime, fileJunDateTime, targetJul, actualJulDateTime, gradeJulDateTime, fileJulDateTime, targetAug, actualAugDateTime, gradeAugDateTime, fileAugDateTime, targetSep, actualSepDateTime, gradeSepDateTime, fileSepDateTime, targetOct, actualOctDateTime, gradeOctDateTime, fileOctDateTime, targetNov, actualNovDateTime, gradeNovDateTime, fileNovDateTime, targetDec, actualDecDateTime, gradeDecDateTime, fileDecDateTime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('fitAndFastId, status, createDateTime, updateDateTime, employeeId, title, description, type, sumS, sumF, sumGrade, forYear, targetJan, statusJan, actualJan, actualJanDateTime, gradeJan, gradeJanDateTime, fileJan, fileJanDateTime, targetFeb, statusFeb, actualFeb, actualFebDateTime, gradeFeb, gradeFebDateTime, fileFeb, fileFebDateTime, targetMar, statusMar, actualMar, actualMarDateTime, gradeMar, gradeMarDateTime, fileMar, fileMarDateTime, targetApr, statusApr, actualApr, actualAprDateTime, gradeApr, gradeAprDateTime, fileApr, fileAprDateTime, targetMay, statusMay, actualMay, actualMayDateTime, gradeMay, gradeMayDateTime, fileMay, fileMayDateTime, targetJun, statusJun, actualJun, actualJunDateTime, gradeJun, gradeJunDateTime, fileJun, fileJunDateTime, targetJul, statusJul, actualJul, actualJulDateTime, gradeJul, gradeJulDateTime, fileJul, fileJulDateTime, targetAug, statusAug, actualAug, actualAugDateTime, gradeAug, gradeAugDateTime, fileAug, fileAugDateTime, targetSep, statusSep, actualSep, actualSepDateTime, gradeSep, gradeSepDateTime, fileSep, fileSepDateTime, targetOct, statusOct, actualOct, actualOctDateTime, gradeOct, gradeOctDateTime, fileOct, fileOctDateTime, targetNov, statusNov, actualNov, actualNovDateTime, gradeNov, gradeNovDateTime, fileNov, fileNovDateTime, targetDec, statusDec, actualDec, actualDecDateTime, gradeDec, gradeDecDateTime, fileDec, fileDecDateTime', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fitAndFastId' => 'Fit And Fast',
			'status' => 'Status',
			'createDateTime' => 'Create Date Time',
			'updateDateTime' => 'Update Date Time',
			'employeeId' => 'Employee',
			'title' => 'Title',
			'description' => 'Description',
			'type' => 'Type',
			'sumS' => 'Sum S',
			'sumF' => 'Sum F',
			'sumGrade' => 'Sum Grade',
			'forYear' => 'For Year',
			'targetJan' => 'Target Jan',
			'statusJan' => 'Status Jan',
			'actualJan' => 'Actual Jan',
			'actualJanDateTime' => 'Actual Jan Date Time',
			'gradeJan' => 'Grade Jan',
			'gradeJanDateTime' => 'Grade Jan Date Time',
			'fileJan' => 'File Jan',
			'fileJanDateTime' => 'File Jan Date Time',
			'targetFeb' => 'Target Feb',
			'statusFeb' => 'Status Feb',
			'actualFeb' => 'Actual Feb',
			'actualFebDateTime' => 'Actual Feb Date Time',
			'gradeFeb' => 'Grade Feb',
			'gradeFebDateTime' => 'Grade Feb Date Time',
			'fileFeb' => 'File Feb',
			'fileFebDateTime' => 'File Feb Date Time',
			'targetMar' => 'Target Mar',
			'statusMar' => 'Status Mar',
			'actualMar' => 'Actual Mar',
			'actualMarDateTime' => 'Actual Mar Date Time',
			'gradeMar' => 'Grade Mar',
			'gradeMarDateTime' => 'Grade Mar Date Time',
			'fileMar' => 'File Mar',
			'fileMarDateTime' => 'File Mar Date Time',
			'targetApr' => 'Target Apr',
			'statusApr' => 'Status Apr',
			'actualApr' => 'Actual Apr',
			'actualAprDateTime' => 'Actual Apr Date Time',
			'gradeApr' => 'Grade Apr',
			'gradeAprDateTime' => 'Grade Apr Date Time',
			'fileApr' => 'File Apr',
			'fileAprDateTime' => 'File Apr Date Time',
			'targetMay' => 'Target May',
			'statusMay' => 'Status May',
			'actualMay' => 'Actual May',
			'actualMayDateTime' => 'Actual May Date Time',
			'gradeMay' => 'Grade May',
			'gradeMayDateTime' => 'Grade May Date Time',
			'fileMay' => 'File May',
			'fileMayDateTime' => 'File May Date Time',
			'targetJun' => 'Target Jun',
			'statusJun' => 'Status Jun',
			'actualJun' => 'Actual Jun',
			'actualJunDateTime' => 'Actual Jun Date Time',
			'gradeJun' => 'Grade Jun',
			'gradeJunDateTime' => 'Grade Jun Date Time',
			'fileJun' => 'File Jun',
			'fileJunDateTime' => 'File Jun Date Time',
			'targetJul' => 'Target Jul',
			'statusJul' => 'Status Jul',
			'actualJul' => 'Actual Jul',
			'actualJulDateTime' => 'Actual Jul Date Time',
			'gradeJul' => 'Grade Jul',
			'gradeJulDateTime' => 'Grade Jul Date Time',
			'fileJul' => 'File Jul',
			'fileJulDateTime' => 'File Jul Date Time',
			'targetAug' => 'Target Aug',
			'statusAug' => 'Status Aug',
			'actualAug' => 'Actual Aug',
			'actualAugDateTime' => 'Actual Aug Date Time',
			'gradeAug' => 'Grade Aug',
			'gradeAugDateTime' => 'Grade Aug Date Time',
			'fileAug' => 'File Aug',
			'fileAugDateTime' => 'File Aug Date Time',
			'targetSep' => 'Target Sep',
			'statusSep' => 'Status Sep',
			'actualSep' => 'Actual Sep',
			'actualSepDateTime' => 'Actual Sep Date Time',
			'gradeSep' => 'Grade Sep',
			'gradeSepDateTime' => 'Grade Sep Date Time',
			'fileSep' => 'File Sep',
			'fileSepDateTime' => 'File Sep Date Time',
			'targetOct' => 'Target Oct',
			'statusOct' => 'Status Oct',
			'actualOct' => 'Actual Oct',
			'actualOctDateTime' => 'Actual Oct Date Time',
			'gradeOct' => 'Grade Oct',
			'gradeOctDateTime' => 'Grade Oct Date Time',
			'fileOct' => 'File Oct',
			'fileOctDateTime' => 'File Oct Date Time',
			'targetNov' => 'Target Nov',
			'statusNov' => 'Status Nov',
			'actualNov' => 'Actual Nov',
			'actualNovDateTime' => 'Actual Nov Date Time',
			'gradeNov' => 'Grade Nov',
			'gradeNovDateTime' => 'Grade Nov Date Time',
			'fileNov' => 'File Nov',
			'fileNovDateTime' => 'File Nov Date Time',
			'targetDec' => 'Target Dec',
			'statusDec' => 'Status Dec',
			'actualDec' => 'Actual Dec',
			'actualDecDateTime' => 'Actual Dec Date Time',
			'gradeDec' => 'Grade Dec',
			'gradeDecDateTime' => 'Grade Dec Date Time',
			'fileDec' => 'File Dec',
			'fileDecDateTime' => 'File Dec Date Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('fitAndFastId',$this->fitAndFastId,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('createDateTime',$this->createDateTime,true);
		$criteria->compare('updateDateTime',$this->updateDateTime,true);
		$criteria->compare('employeeId',$this->employeeId,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('sumS',$this->sumS);
		$criteria->compare('sumF',$this->sumF);
		$criteria->compare('sumGrade',$this->sumGrade,true);
		$criteria->compare('forYear',$this->forYear,true);
		$criteria->compare('targetJan',$this->targetJan,true);
		$criteria->compare('statusJan',$this->statusJan);
		$criteria->compare('actualJan',$this->actualJan,true);
		$criteria->compare('actualJanDateTime',$this->actualJanDateTime,true);
		$criteria->compare('gradeJan',$this->gradeJan,true);
		$criteria->compare('gradeJanDateTime',$this->gradeJanDateTime,true);
		$criteria->compare('fileJan',$this->fileJan,true);
		$criteria->compare('fileJanDateTime',$this->fileJanDateTime,true);
		$criteria->compare('targetFeb',$this->targetFeb,true);
		$criteria->compare('statusFeb',$this->statusFeb);
		$criteria->compare('actualFeb',$this->actualFeb,true);
		$criteria->compare('actualFebDateTime',$this->actualFebDateTime,true);
		$criteria->compare('gradeFeb',$this->gradeFeb,true);
		$criteria->compare('gradeFebDateTime',$this->gradeFebDateTime,true);
		$criteria->compare('fileFeb',$this->fileFeb,true);
		$criteria->compare('fileFebDateTime',$this->fileFebDateTime,true);
		$criteria->compare('targetMar',$this->targetMar,true);
		$criteria->compare('statusMar',$this->statusMar);
		$criteria->compare('actualMar',$this->actualMar,true);
		$criteria->compare('actualMarDateTime',$this->actualMarDateTime,true);
		$criteria->compare('gradeMar',$this->gradeMar,true);
		$criteria->compare('gradeMarDateTime',$this->gradeMarDateTime,true);
		$criteria->compare('fileMar',$this->fileMar,true);
		$criteria->compare('fileMarDateTime',$this->fileMarDateTime,true);
		$criteria->compare('targetApr',$this->targetApr,true);
		$criteria->compare('statusApr',$this->statusApr);
		$criteria->compare('actualApr',$this->actualApr,true);
		$criteria->compare('actualAprDateTime',$this->actualAprDateTime,true);
		$criteria->compare('gradeApr',$this->gradeApr,true);
		$criteria->compare('gradeAprDateTime',$this->gradeAprDateTime,true);
		$criteria->compare('fileApr',$this->fileApr,true);
		$criteria->compare('fileAprDateTime',$this->fileAprDateTime,true);
		$criteria->compare('targetMay',$this->targetMay,true);
		$criteria->compare('statusMay',$this->statusMay);
		$criteria->compare('actualMay',$this->actualMay,true);
		$criteria->compare('actualMayDateTime',$this->actualMayDateTime,true);
		$criteria->compare('gradeMay',$this->gradeMay,true);
		$criteria->compare('gradeMayDateTime',$this->gradeMayDateTime,true);
		$criteria->compare('fileMay',$this->fileMay,true);
		$criteria->compare('fileMayDateTime',$this->fileMayDateTime,true);
		$criteria->compare('targetJun',$this->targetJun,true);
		$criteria->compare('statusJun',$this->statusJun);
		$criteria->compare('actualJun',$this->actualJun,true);
		$criteria->compare('actualJunDateTime',$this->actualJunDateTime,true);
		$criteria->compare('gradeJun',$this->gradeJun,true);
		$criteria->compare('gradeJunDateTime',$this->gradeJunDateTime,true);
		$criteria->compare('fileJun',$this->fileJun,true);
		$criteria->compare('fileJunDateTime',$this->fileJunDateTime,true);
		$criteria->compare('targetJul',$this->targetJul,true);
		$criteria->compare('statusJul',$this->statusJul);
		$criteria->compare('actualJul',$this->actualJul,true);
		$criteria->compare('actualJulDateTime',$this->actualJulDateTime,true);
		$criteria->compare('gradeJul',$this->gradeJul,true);
		$criteria->compare('gradeJulDateTime',$this->gradeJulDateTime,true);
		$criteria->compare('fileJul',$this->fileJul,true);
		$criteria->compare('fileJulDateTime',$this->fileJulDateTime,true);
		$criteria->compare('targetAug',$this->targetAug,true);
		$criteria->compare('statusAug',$this->statusAug);
		$criteria->compare('actualAug',$this->actualAug,true);
		$criteria->compare('actualAugDateTime',$this->actualAugDateTime,true);
		$criteria->compare('gradeAug',$this->gradeAug,true);
		$criteria->compare('gradeAugDateTime',$this->gradeAugDateTime,true);
		$criteria->compare('fileAug',$this->fileAug,true);
		$criteria->compare('fileAugDateTime',$this->fileAugDateTime,true);
		$criteria->compare('targetSep',$this->targetSep,true);
		$criteria->compare('statusSep',$this->statusSep);
		$criteria->compare('actualSep',$this->actualSep,true);
		$criteria->compare('actualSepDateTime',$this->actualSepDateTime,true);
		$criteria->compare('gradeSep',$this->gradeSep,true);
		$criteria->compare('gradeSepDateTime',$this->gradeSepDateTime,true);
		$criteria->compare('fileSep',$this->fileSep,true);
		$criteria->compare('fileSepDateTime',$this->fileSepDateTime,true);
		$criteria->compare('targetOct',$this->targetOct,true);
		$criteria->compare('statusOct',$this->statusOct);
		$criteria->compare('actualOct',$this->actualOct,true);
		$criteria->compare('actualOctDateTime',$this->actualOctDateTime,true);
		$criteria->compare('gradeOct',$this->gradeOct,true);
		$criteria->compare('gradeOctDateTime',$this->gradeOctDateTime,true);
		$criteria->compare('fileOct',$this->fileOct,true);
		$criteria->compare('fileOctDateTime',$this->fileOctDateTime,true);
		$criteria->compare('targetNov',$this->targetNov,true);
		$criteria->compare('statusNov',$this->statusNov);
		$criteria->compare('actualNov',$this->actualNov,true);
		$criteria->compare('actualNovDateTime',$this->actualNovDateTime,true);
		$criteria->compare('gradeNov',$this->gradeNov,true);
		$criteria->compare('gradeNovDateTime',$this->gradeNovDateTime,true);
		$criteria->compare('fileNov',$this->fileNov,true);
		$criteria->compare('fileNovDateTime',$this->fileNovDateTime,true);
		$criteria->compare('targetDec',$this->targetDec,true);
		$criteria->compare('statusDec',$this->statusDec);
		$criteria->compare('actualDec',$this->actualDec,true);
		$criteria->compare('actualDecDateTime',$this->actualDecDateTime,true);
		$criteria->compare('gradeDec',$this->gradeDec,true);
		$criteria->compare('gradeDecDateTime',$this->gradeDecDateTime,true);
		$criteria->compare('fileDec',$this->fileDec,true);
		$criteria->compare('fileDecDateTime',$this->fileDecDateTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FitAndFastMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
