<?php

class CancelFixedTimeCommand extends CConsoleCommand
{

	public function writeToFile($filename, $string, $mode = 'w+')
	{
		$handle = fopen($filename, $mode);
		fwrite($handle, $string);
		fclose($handle);
	}

	public function run()
	{
		/**
		 * @todo Cancel Leave
		 * 1 find leave status=0
		 * 2 set status=2 ( cancel all sick, Personal & Vocation check startDate before 23rd 12.00)
		 * 	2.1 cancel doc
		 * 	2.2 add workflow log : currentState = 0,
		 * 	2.3 documentWorkflow : isFinish = 1, currentState = 0
		 *
		 */
		//find all unapproved doc
		//documentCodePrefix = ETI
		$documentTypeModel = DocumentType::model()->find('documentCodePrefix=:documentCodePrefix', array(
			':documentCodePrefix'=>'ETI'));

		//$thisMonth = date('Y-m') . '-22';
		//$lastMonth = date('Y-m-d', mktime(0, 0, 0, date("m") - 1, 23, date("Y")));

		$thisMonth = '2013-02-22';
		$lastMonth = '2013-01-23';

		$criteria = new CDbCriteria();
		$criteria->with = array(
			'document');
		$criteria->condition = 'document.documentTypeId=:documentTypeId AND (t.documentItemName BETWEEN :lastMonth AND :thisMonth) AND t.status=1';
		$criteria->params = array(
			'documentTypeId'=>$documentTypeModel->documentTypeId,
			':lastMonth'=>$lastMonth,
			':thisMonth'=>$thisMonth);

		$documentItemModels = DocumentItem::model()->findAll($criteria);

		$documentIds = array(
			);
		$documentItemIds = array(
			);

		foreach($documentItemModels as $documentItemModel)
		{
			$documentItemIds[] = $documentItemModel->documentItemId;

			if(!in_array($documentItemModel->documentId, $documentIds))
			{
				$documentIds[] = $documentItemModel->documentId;
			}
		}

		DocumentItem::model()->updateAll(array(
			'status'=>1), 'documentItemId IN (' . implode(',', $documentItemIds) . ')');

		//DocumentWorkflow : set currentState=0, isFinish=1
		DocumentWorkflow::model()->updateAll(array(
			'currentState'=>0,
			'isFinish'=>1), 'documentId IN (' . implode(',', $documentIds) . ')');

		//update document
		foreach($documentIds as $documentId)
		{
			WorkflowLog::model()->saveWorkflowLog($documentId, 0, 'เอกสารถูกยกเลิกโดยระบบ เนื่องจากไม่ได้รับการอนุมัติตามเวลาที่กำหนด', 0);
		}
	}

}
