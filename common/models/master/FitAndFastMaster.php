<?php

namespace common\models\master;

use Yii;

/**
 * This is the model class for table "fit_and_fast".
 *
 * @property integer $fitAndFastId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property integer $employeeId
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
class FitAndFastMaster extends \common\models\MasterModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fit_and_fast';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'employeeId', 'type', 'statusJan', 'statusFeb', 'statusMar', 'statusApr', 'statusMay', 'statusJun', 'statusJul', 'statusAug', 'statusSep', 'statusOct', 'statusNov', 'statusDec'], 'integer'],
            [['createDateTime', 'updateDateTime', 'employeeId', 'title', 'type', 'forYear'], 'required'],
            [['createDateTime', 'updateDateTime', 'actualJanDateTime', 'gradeJanDateTime', 'fileJanDateTime', 'actualFebDateTime', 'gradeFebDateTime', 'fileFebDateTime', 'actualMarDateTime', 'gradeMarDateTime', 'fileMarDateTime', 'actualAprDateTime', 'gradeAprDateTime', 'fileAprDateTime', 'actualMayDateTime', 'gradeMayDateTime', 'fileMayDateTime', 'actualJunDateTime', 'gradeJunDateTime', 'fileJunDateTime', 'actualJulDateTime', 'gradeJulDateTime', 'fileJulDateTime', 'actualAugDateTime', 'gradeAugDateTime', 'fileAugDateTime', 'actualSepDateTime', 'gradeSepDateTime', 'fileSepDateTime', 'actualOctDateTime', 'gradeOctDateTime', 'fileOctDateTime', 'actualNovDateTime', 'gradeNovDateTime', 'fileNovDateTime', 'actualDecDateTime', 'gradeDecDateTime', 'fileDecDateTime'], 'safe'],
            [['title', 'description', 'sumGrade', 'targetJan', 'targetFeb', 'targetMar', 'targetApr', 'targetMay', 'targetJun', 'targetJul', 'targetAug', 'targetSep', 'targetOct', 'targetNov', 'targetDec'], 'string'],
            [['sumS', 'sumF'], 'number'],
            [['forYear'], 'string', 'max' => 4],
            [['actualJan', 'actualFeb', 'actualMar', 'actualApr', 'actualMay', 'actualJun', 'actualJul', 'actualAug', 'actualSep', 'actualOct', 'actualNov', 'actualDec'], 'string', 'max' => 45],
            [['gradeJan', 'gradeFeb', 'gradeMar', 'gradeApr', 'gradeMay', 'gradeJun', 'gradeJul', 'gradeAug', 'gradeSep', 'gradeOct', 'gradeNov', 'gradeDec'], 'string', 'max' => 5],
            [['fileJan', 'fileFeb', 'fileMar', 'fileApr', 'fileMay', 'fileJun', 'fileJul', 'fileAug', 'fileSep', 'fileOct', 'fileNov', 'fileDec'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fitAndFastId' => 'Fit And Fast ID',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
            'employeeId' => 'Employee ID',
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
        ];
    }
}
