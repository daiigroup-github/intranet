<?php

namespace frontend\models;

use Yii;
use \common\models\master\FitAndFastMaster;

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
class FitAndFast extends \common\models\master\FitAndFastMaster
*/
class FitAndFast extends FitAndFastMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }
}
