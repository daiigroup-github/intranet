<?php

namespace frontend\models\search;

use Yii;
use frontend\models\Document;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "document".
 *
 * @property string $documentId
 * @property string $documentCode
 * @property string $documentTypeId
 * @property integer $employeeId
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property integer $status
 * @property integer $isRead
class Document extends \common\models\master\DocumentMaster
 */
class DocumentSearch extends Document
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employeeId', 'documentTypeId', 'documentCode'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }

    public function searchInbox($params)
    {
        $employeeId = Yii::$app->user->identity->id;
        $query = Document::find()//->where(['employeeId'=>Yii::$app->user->identity->id])
        ->join('LEFT JOIN', 'document_workflow dw', 'dw.documentId=document.documentId')
            ->join('LEFT OUTER JOIN', 'group_member gm', 'gm.groupId=dw.groupId')
            ->andWhere(['like', 'document.documentCode', strtoupper($this->documentCode)])
            ->andWhere(['=', 'dw.employeeId', $employeeId])
            ->orWhere(['=', 'gm.employeeId', $employeeId])
            ->andWhere('dw.currentState!=0')
            ->andWhere('document.status=1')
            ->groupBy('document.documentId')
            ->orderBy('document.createDateTime DESC');

//        ->andWhere(['=', 't.documentcode', strtoupper($this->documentCode)]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->joinWith('employee');
        $query->andFilterWhere(['=', 'document.documentTypeId', $this->documentTypeId])
            ->andFilterWhere(['like', 'employee.fnTh', $this->employeeId]);


        return $dataProvider;
    }
}
