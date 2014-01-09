<?php

class CancelLeaveCommand extends CConsoleCommand
{

	const WORKFLOW_STATE_ID = 5;

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
		$leaveModels = Leave::model()->findAll('status=0');

		foreach($leaveModels as $leaveModel)
		{
			$this->writeToFile('/tmp/ll', print_r($leaveModel->leaveType, true) . " | ", 'a+');
			if($leaveModel->leaveType != Leave::LEAVE_TYPE_SICK)
			{
				$criteria = new CDbCriteria();
				$criteria->condition = 'leaveId = :leaveId';
				$criteria->params = array(
					':leaveId'=>$leaveModel->leaveId);
				$criteria->order = 'leaveDate';
				$criteria->limit = 1;

				$leaveItemModel = LeaveItem::model()->find($criteria);

				if($leaveItemModel)
				{

					if(strtotime($leaveItemModel->leaveDate) >= strtotime(date('Y-m' . '-23')))
					{
						continue;
					}
				}
			}

			$documentModel = Document::model()->findByPk($leaveModel->documentId);
			$workflowStateModel = WorkflowState::model()
				->getWorkflowStateByCurrentStateAndWrokflowStatusIdAndWorkflowGroupId($documentModel->documentWorkflow->currentState, self::WORKFLOW_STATE_ID, $documentModel->documentType->workflowGroupId);

			Leave::model()->updateLeaveByDocumentIdAndWorkflowStatusId($leaveModel->documentId, self::WORKFLOW_STATE_ID);
			DocumentWorkflow::model()->updateDocumentWorkflowByWorkflowStatusModelAndDocumentId($workflowStateModel, $leaveModel->documentId);
			WorkflowLog::model()->saveWorkflowLog($leaveModel->documentId, 0, 'เอกสารถูกยกเลิกโดยระบบ เนื่องจากไม่ได้รับการอนุมัติตามเวลาที่กำหนด', 0);
		}

		//fixed time
	}

}
