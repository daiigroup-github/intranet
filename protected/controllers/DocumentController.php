<?php

class DocumentController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/cl2';
    public $documentId;

    public function filters()
    {
        return array(
            //'accessControl', // perform access control for CRUD operations
            'rights',
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    /* public function accessRules()
      {
      return array(
      array('allow',  // allow all users to perform 'index' and 'view' actions
      'actions'=>array('index','view','admin','document','inbox','outbox'),
      'users'=>array('*'),
      ),
      array('allow', // allow authenticated user to perform 'create' and 'update' actions
      'actions'=>array('create','update','admin'),
      'users'=>array('@'),
      ),
      array('allow', // allow admin user to perform 'admin' and 'delete' actions
      'actions'=>array('admin','delete'),
      'users'=>array('admin'),
      ),
      array('deny',  // deny all users
      'users'=>array('*'),
      ),
      );
      } */

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        if (isset($_REQUEST["device"])) {
            if ($_REQUEST["device"] == "mobile") {
                $this->layout = "//layouts/cl1";
            }
        }
        $model = $this->loadModel($id);
        $documentType = DocumentType::model()->findByPk($model->documentTypeId);
        $workflowStateModel = new WorkflowState();
        $workflowLogModel = new WorkflowLog("search");
        $historyLog = WorkflowLog::model()->findAllByDocumentId($id);
        $documentWorkflowModel = DocumentWorkflow::model()->findByPk($model->documentWorkflow->documentWorkflowId);
        $previousState;
        $errorMsg = "";
        $dateNow = new CDbExpression('NOW()');
        if (isset($_POST["previousState"])) { // For check more submit
            $previousState = $_POST["previousState"];
        }

        $docDocumentWorkflow = Document::model()->findAllFieldByDocumentId($id);

        if (isset($_POST['WorkflowState'])) {
            if (isset($_POST['WorkflowState']['workflowStatusId']) && empty($_POST['WorkflowState']['workflowStatusId'])) {
                $this->redirect(array(
                    'view',
                    'id' => $id,
                    'errorMsg' => "errorWorkflowStatus"
                ));
            }
            $transaction = Yii::app()->db->beginTransaction();

            try {
                $flag = true;

                //DocumentDocumentTemplate
                if (isset($_POST["DocumentDocumentTemplateField"]["value"])) {
                    foreach ($_POST["DocumentDocumentTemplateField"]["value"] as $k => $v) {

                        $docDocTemplate = DocumentDocumentTemplateField::model()->find("id=:id", array(
                            ":id" => $k));
                        $image = CUploadedFile::getInstanceByName("DocumentDocumentTemplateField[value][$k]");

                        if (isset($image) || !empty($image)) {
                            $file_array = explode(".", $image->name);
                            $fileType = $file_array[count($file_array) - 1];
                            $imageUrl = 'images/document/' . time() . '-' . $this->guid() . "." . $fileType;
                            //$imageUrl = 'images/document/'.time().'-'.$image->name;
                            $imagePath = '/../' . $imageUrl;
                            $v = Yii::app()->baseUrl . '/' . $imageUrl;

                            $image->saveAs(Yii::app()->getBasePath() . $imagePath);
                        } else {
                            if (isset($_POST["DocumentDocumentTemplateField"]["oldFieldFile"][$k])) {
                                $v = $_POST["DocumentDocumentTemplateField"]["oldFieldFile"][$k];
                            }
                        }

                        if (!isset($v) || empty($v)) {
                            $v = 0;
                        }
                        $docDocTemplate->value = $v;

                        if (!$docDocTemplate->save()) {
                            throw new Exception(11111);
                        }
                    }
                }
                //DocumentDocumentTemplate
                //DocumentItem 18/06/2555

                if (isset($_POST["DocumentItem"])) {
                    //update
                    if (isset($_POST["DocumentItem"]['update']["documentItemName"])) {
                        foreach ($_POST["DocumentItem"]['update']["documentItemName"] as $k => $v) {
                            if (!empty($v) || $v == "0") {
                                $documentItem = DocumentItem::model()->findByPk($k);

                                $image2 = CUploadedFile::getInstanceByName("DocumentItem[update][file][$k]");

                                if (isset($image2)) {
                                    $imageUrl2 = 'images/document/' . time() . '-' . $image2->name;
                                    $file_array = explode(".", $image2->name);
                                    $fileType = $file_array[count($file_array) - 1];
                                    $imageUrl2 = 'images/document/' . time() . '-' . $this->guid() . "." . $fileType;
                                    $imagePath2 = '/../' . $imageUrl2;
                                    $image2->saveAs(Yii::app()->getBasePath() . $imagePath2);
                                    $imageUrlUpdate = Yii::app()->baseUrl . '/' . $imageUrl2;
                                } else {

                                    if (isset($_POST["DocumentItem"]['update']["oldFile"][$k])) {
                                        $imageUrlUpdate = $_POST["DocumentItem"]['update']["oldFile"][$k];
                                    } else {
                                        $imageUrlUpdate = null;
                                    }
                                }

                                $w = array(
                                );
                                if (isset($_POST["DocumentItem"]['update']["documentItemNameNew"][$k])) {
                                    $w['documentItemName'] = $_POST["DocumentItem"]['update']["documentItemNameNew"][$k];
                                } else {
                                    if (isset($v)) {
                                        $w['documentItemName'] = $v;
                                    } else {
                                        $w['documentItemName'] = " ";
                                    }
                                }

                                $w["file"] = isset($imageUrlUpdate) ? $imageUrlUpdate : null;

                                if (isset($_POST["DocumentItem"]['update']["description"][$k])) {
                                    $w["description"] = $_POST["DocumentItem"]['update']["description"][$k];
                                } else {
                                    if (isset($_POST["DocumentItem"]['update']["oldDescription"][$k])) {
                                        $w["description"] = $_POST["DocumentItem"]['update']["oldDescription"][$k];
                                    } else {
                                        $w["description"] = null;
                                    }
                                }
                                if (isset($_POST["DocumentItem"]['update']["remark"][$k])) {
                                    $w["remark"] = $_POST["DocumentItem"]['update']["remark"][$k];
                                } else {
                                    if (isset($_POST["DocumentItem"]['update']["oldRemark"][$k])) {
                                        $w["remark"] = $_POST["DocumentItem"]['update']["oldRemark"][$k];
                                    } else {
                                        $w["remark"] = null;
                                    }
                                }

                                if (isset($_POST["DocumentItem"]['update']["id"][$k])) {
                                    $w["id"] = $_POST["DocumentItem"]['update']["id"][$k];
                                } else {
                                    if (isset($_POST["DocumentItem"]['update']["oldId"][$k])) {
                                        $w["id"] = $_POST["DocumentItem"]['update']["oldId"][$k];
                                    } else {
                                        $w["id"] = null;
                                    }
                                }

                                if (isset($_POST["DocumentItem"]['update']["value"][$k])) {
                                    $w["value"] = $_POST["DocumentItem"]['update']["value"][$k];
                                } else {
                                    if (isset($_POST["DocumentItem"]['update']["oldValue"][$k])) {
                                        $w["value"] = $_POST["DocumentItem"]['update']["oldValue"][$k];
                                    } else {
                                        $w["value"] = null;
                                    }
                                }

                                if (isset($_POST["DocumentItem"]['update']["table"][$k])) {
                                    $w["table"] = $_POST["DocumentItem"]['update']["table"][$k];
                                } else {
                                    if (isset($_POST["DocumentItem"]['update']["oldTable"][$k])) {
                                        $w["table"] = $_POST["DocumentItem"]['update']["oldTable"][$k];
                                    } else {
                                        $w["table"] = null;
                                    }
                                }

                                if (isset($_POST["DocumentItem"]['update']["unit"][$k])) {
                                    $w["unit"] = $_POST["DocumentItem"]['update']["unit"][$k];
                                } else {
                                    if (isset($_POST["DocumentItem"]['update']["oldUnit"][$k])) {
                                        $w["unit"] = $_POST["DocumentItem"]['update']["oldUnit"][$k];
                                    } else {
                                        $w["unit"] = null;
                                    }
                                }

                                if (isset($_POST["DocumentItem"]['update']["description8"][$k])) {
                                    $w["description8"] = $_POST["DocumentItem"]['update']["description8"][$k];
                                } else {
                                    if (isset($_POST["DocumentItem"]['update']["oldDescription8"][$k])) {
                                        $w["description8"] = $_POST["DocumentItem"]['update']["oldDescription8"][$k];
                                    } else {
                                        $w["description8"] = null;
                                    }
                                }

                                if (isset($_POST["DocumentItem"]['update']["description9"][$k])) {
                                    $w["description9"] = $_POST["DocumentItem"]['update']["description9"][$k];
                                } else {
                                    if (isset($_POST["DocumentItem"]['update']["oldDescription9"][$k])) {
                                        $w["description9"] = $_POST["DocumentItem"]['update']["oldDescription9"][$k];
                                    } else {
                                        $w["description9"] = null;
                                    }
                                }

                                if (isset($_POST["DocumentItem"]['update']["description10"][$k])) {
                                    $w["description10"] = $_POST["DocumentItem"]['update']["description10"][$k];
                                } else {
                                    if (isset($_POST["DocumentItem"]['update']["oldDescription10"][$k])) {
                                        $w["description10"] = $_POST["DocumentItem"]['update']["oldDescription10"][$k];
                                    } else {
                                        $w["description10"] = null;
                                    }
                                }

                                if (isset($_POST["DocumentItem"]['update']["status"][$k])) {
                                    $w["status"] = $_POST["DocumentItem"]['update']["status"][$k];
                                } else {
                                    if (isset($_POST["DocumentItem"]['update']["oldStatus"][$k])) {
                                        $w["status"] = $_POST["DocumentItem"]['update']["oldStatus"][$k];
                                    } else {
                                        $w["status"] = 1;
                                    }
                                }

                                $w["updateDateTime"] = $dateNow;

                                $documentItem->attributes = $w;

                                if (!$documentItem->save()) {
                                    throw new Exception("ไม่สามารถ บันทึก ไอเทมของเอกสารได้");
                                }
                            }
                        }
                    }

                    //create new
                    if (isset($_POST["DocumentItem"]["documentItemName"])) {
                        foreach ($_POST["DocumentItem"]["documentItemName"] as $k => $v) {
                            if (!empty($v) || $v == "0") {
                                $documentItem = new DocumentItem();
                                $imageNew = CUploadedFile::getInstanceByName("DocumentItem[file][$k]");
                                if (!empty($imageNew)) {
                                    $imageUrlNew = 'images/document/' . time() . '-' . $imageNew->name;
                                    $imagePathNew = '/../' . $imageUrlNew;
                                    $imageNew->saveAs(Yii::app()->getBasePath() . $imagePathNew);
                                    $imageUrlNew = Yii::app()->baseUrl . '/' . $imageUrlNew;
                                } else {
                                    $imageUrlNew = null;
                                }

                                $w = array(
                                );
                                $w['documentItemName'] = $v;
                                $w["file"] = isset($imageUrlNew) ? $imageUrlNew : null;
                                $w["description"] = isset($_POST["DocumentItem"]["description"][$k]) ? $_POST["DocumentItem"]["description"][$k] : null;
                                $w["remark"] = isset($_POST["DocumentItem"]["remark"][$k]) ? $_POST["DocumentItem"]["remark"][$k] : null;
                                $w["id"] = isset($_POST["DocumentItem"]["id"][$k]) ? $_POST["DocumentItem"]["id"][$k] : null;
                                $w["value"] = isset($_POST["DocumentItem"]["value"][$k]) ? $_POST["DocumentItem"]["value"][$k] : null;
                                $w["table"] = isset($_POST["DocumentItem"]["table"][$k]) ? $_POST["DocumentItem"]["table"][$k] : null;
                                $w["unit"] = isset($_POST["DocumentItem"]["unit"][$k]) ? $_POST["DocumentItem"]["unit"][$k] : null;
                                $w["description8"] = isset($_POST["DocumentItem"]["description8"][$k]) ? $_POST["DocumentItem"]["description8"][$k] : null;
                                $w["description9"] = isset($_POST["DocumentItem"]["description9"][$k]) ? $_POST["DocumentItem"]["description9"][$k] : null;
                                $w["description10"] = isset($_POST["DocumentItem"]["description10"][$k]) ? $_POST["DocumentItem"]["description10"][$k] : null;
                                $w["status"] = 1;
                                $w["createDateTime"] = $dateNow;
                                $w['documentId'] = $model->documentId;

                                $documentItem->attributes = $w; //$this->writeToFile('/tmp/doc_view', print_r($documentItem->attributes, true));

                                if (!$documentItem->save()) {
                                    throw new Exception("ไม่สามารถ เพิ่ม ไอเทมของเอกสารได้");
                                }
                            }
                        }
                    }
                }
                //DocumentItem
                //Document Workflow
                $workflowStateResult = WorkflowState::model()->getWorkflowStateByCurrentStateAndWrokflowStatusIdAndWorkflowGroupId($model->documentWorkflow->currentState, $_POST['WorkflowState']['workflowStatusId'], $model->documentType->workflowGroupId);

                if (isset($previousState) && isset($workflowStateResult->currentState)) {
                    if ($previousState == $workflowStateResult->currentState) {
                        //Check Info. Confirm
                        if (isset($_POST["WorkflowState"]["staffPwd"])) {
                            $checkMatckPwdOwner = Employee::model()->checkMatchEmployeeIdAndPassword($documentWorkflowModel->document->employeeId, $_POST["WorkflowState"]["ownerPwd"]);
                            $checkMatckPwdStaff = false;
                            if (isset($documentWorkflowModel->employeeId)) {
                                $checkMatckPwdStaff = Employee::model()->checkMatchEmployeeIdAndPassword($documentWorkflowModel->employeeId, $_POST["WorkflowState"]["staffPwd"]);
                            } else {
                                $groupMember = GroupMember::model()->findAll("groupId = :groupId", array(
                                    ":groupId" => $documentWorkflowModel->groupId));
                                $i = 0;
                                foreach ($groupMember as $employee) {
                                    $i++;
                                    $checkMatckPwdStaff = Employee::model()->checkMatchEmployeeIdAndPassword($employee->employeeId, $_POST["WorkflowState"]["staffPwd"]);
                                    if ($checkMatckPwdStaff == 1) {
                                        break 1;
                                    }
                                } //throw new Exception($i." ".$checkMatckPwdStaff);
                            }
                            if (!($checkMatckPwdOwner AND $checkMatckPwdStaff)) {
                                $flag = false;
                                $wfS = WorkflowStatus::model()->findByPk($_POST['WorkflowState']['workflowStatusId']);
                                if (isset($wfS) && $wfS->workflowStatusGroup = "reject") {
                                    $flag = true;
                                }
                                $errorMsg = "errorConfirm";
                            } else {
                                $errorMsg = null;
                            }
                        }
                        //Check Info. Confirm
                        //Draft State
                        if ($workflowStateResult->currentState == 0 && $workflowStateResult->nextState == 0) {
                            $documentWorkflowModel->currentState = 0;
                            $documentWorkflowModel->employeeId = $model->employeeId;
                            $documentWorkflowModel->groupId = null;
                            $documentWorkflowModel->isFinished = 0;
                        } else {
                            if (isset($workflowStateResult->nextState)) {
                                //Finish
                                if ($workflowStateResult->nextState == 0) {
                                    $documentWorkflowModel->isFinished = 1;
                                    $documentWorkflowModel->currentState = 0;
                                    $documentWorkflowModel->employeeId = null;
                                    $documentWorkflowModel->groupId = null;
                                } else {
                                    /* if($workflowStateResult->nextState->employeeId == 0 && $workflowStateResult->nextState->groupId == 0)
                                      {
                                      $documentWorkflowModel->employeeId = $model->employeeId;
                                      $documentWorkflowModel->currentState = 0;
                                      }
                                      else
                                      { */
                                    $documentWorkflowModel->currentState = $workflowStateResult->nextState;
                                    //}
                                }
                            }
                            $documentWorkflowModel->createDateTime = $dateNow;

                            if (isset($workflowStateResult->workflowNext)) {
                                //find employee or group
                                if ($workflowStateResult->workflowNext->employeeId > 0) {
                                    $documentWorkflowModel->employeeId = $workflowStateResult->workflowNext->employeeId;
                                    if ($workflowStateResult->workflowNext->groupId > 0) {
                                        $documentWorkflowModel->groupId = $workflowStateResult->workflowNext->groupId;
                                    } else {
                                        $documentWorkflowModel->groupId = null;
                                    }
                                }
                                //back to doc creator
                                else if ($workflowStateResult->workflowNext->employeeId == -1) {
                                    $documentWorkflowModel->employeeId = $model->employeeId;
                                    $documentWorkflowModel->groupId = null;
                                    if ($workflowStateResult->workflowNext->groupId > 0) {
                                        $documentWorkflowModel->groupId = $workflowStateResult->workflowNext->groupId;
                                    } else {
                                        $documentWorkflowModel->groupId = null;
                                    }
                                } else {
                                    //division manager
                                    if ($workflowStateResult->workflowNext->groupId == 0) {
                                        $employee = Employee::model()->findByPk(Yii::app()->user->id);
                                        if ($employee->level->level >= 7 || $employee->username == "nmk") {
                                            $documentWorkflowModel->employeeId = Yii::app()->user->id;
                                            if ($workflowStateResult->workflowStatus->workflowStatusGroup == "creator") {
                                                $documentWorkflowModel->employeeId = $model->employee->managerId;
                                            }
                                        } else {
                                            //$documentWorkflowModel->employeeId = $employee->managerId;
                                            $documentWorkflowModel->employeeId = $model->employee->managerId;
                                        }
                                        $documentWorkflowModel->groupId = null;
                                    } else {
                                        $documentWorkflowModel->employeeId = null;
                                        $documentWorkflowModel->groupId = $workflowStateResult->workflowNext->groupId;
                                    }
                                }
                            }
                            /* if(isset($workflowStateResult->workflowNext))
                              {
                              if($workflowStateResult->workflowNext->groupId != 0)
                              {
                              $documentWorkflowModel->groupId = $workflowStateResult->workflowNext->groupId;
                              }
                              else {
                              $documentWorkflowModel->groupId = null;
                              }
                              } */
                        }

                        if ($documentWorkflowModel->save()) {

                            //Workflow Log
                            $w['documentId'] = $id;
                            //$w['workflowStateId'] = $model->documentWorkflow->currentState;
                            $w['workflowStateId'] = $workflowStateResult->workflowStateId;
                            $w['employeeId'] = Yii::app()->user->id;
                            if (isset($model->documentWorkflow->workflowCurrent)) {
                                if ($model->documentWorkflow->workflowCurrent->groupId > 0) {
                                    $w['groupId'] = $model->documentWorkflow->workflowCurrent->groupId;
                                }
                            }

                            $w['createDateTime'] = $dateNow;
                            $w['remarks'] = $_POST['WorkflowLog']['remarks'];
                            $workflowLogModel->attributes = $w; //Controller::writeToFile('/tmp/doc_view', print_r($workflowLogModel->attributes, true));
                            //if($documentWorkflowModel->save() || !$workflowLogModel->save())
                            $hourToWork = $workflowStateResult->workflowGroup->getHourToWork($workflowStateResult, $model->documentId);
                            if (isset($hourToWork)) {
                                $workflowLogModel->estimateHour = $workflowStateModel->estimateHour;
                                $workflowLogModel->numHour = $hourToWork["hourToWork"];
                                $workflowLogModel->isOverEstimate = $hourToWork["isOverEstimate"];
                            }
                            if (!$workflowLogModel->save()) {
                                $flag = false;
                            }

                            if ($flag) {
                                $errorMsg = null;
                                if (!empty($model->documentType->itemTable) && $workflowStateResult->workflowStatus->workflowStatusGroup == "receive") {
                                    $itemTableStr = ucfirst($model->documentType->itemTable);
                                    $itemTable = new $itemTableStr();

                                    $quantity = $model->documentType->itemTable . "stockQuantity";
                                    if (isset($itemTable)) {
                                        foreach ($model->documentItem as $item) {
                                            //$base = $itemTable->findByPk($item->documentItemName);
                                            $base = $itemTable->findAll("stockDetailId =:stockDetailId AND companyId =:companyId ORDER BY createDateTime ASC", array(
                                                ":stockDetailId" => $item->documentItemName,
                                                ":companyId" => $model->employee->companyId
                                            ));
                                            $flagStock = 1;
                                            $quantity = 0;
                                            foreach ($base as $stock) {
                                                if ($item->value <= $stock->stockQuantity) {
                                                    $stock->stockQuantity = $stock->stockQuantity - $item->value;
                                                    $quantity = $item->value;
                                                    $flagStock = 0;
                                                } else {
                                                    $item->value = $item->value - $stock->stockQuantity;
                                                    $quantity = $stock->stockQuantity;
                                                    $stock->stockQuantity = 0;
                                                    $flagStock = 1;
                                                }
                                                if ($stock->save()) {
                                                    $transTableStr = ucfirst($model->documentType->transactionTable);
                                                    $stockTransaction = new $transTableStr();
                                                    $stockTransaction->stockId = $stock->stockId;
                                                    $stockTransaction->documentId = $model->documentId;
                                                    $stockTransaction->stockTransactionQuantity = $quantity * -1;
                                                    $stockTransaction->stockTransactionUnitPrice = $stock->stockUnitPrice;
                                                    $stockTransaction->stockTransactionTotalPrice = $quantity * $stock->stockUnitPrice;
                                                    $stockTransaction->createDateTime = $dateNow;
                                                    if ($stockTransaction->save()) {

                                                    }
                                                    if ($flagStock == 0) {
                                                        break 1;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                $transaction->commit();
                                $emailController = new EmailSend();
                                $website = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/document/";
                                $docAction = "";
                                if (isset($workflowStateResult->workflowCurrent)) {
                                    $docAction .= $workflowStateResult->workflowCurrent->workflowName . " ";
                                }
                                if (isset($workflowStateResult->workflowStatus)) {
                                    $docAction .= "(" . $workflowStateResult->workflowStatus->workflowStatusName . ")";
                                }
                                $docRemark = $workflowLogModel->remarks;
                                if ($documentWorkflowModel->employeeId > 0 && $documentWorkflowModel->isFinished != 1) {
                                    $emailName = $documentWorkflowModel->employee->fnTh . "  " . $documentWorkflowModel->employee->lnTh;
                                    $emailEmail = $documentWorkflowModel->employee->email . "@daiigroup.com";
                                    $emailController->mailsend($emailName, $model->documentType->documentTypeName, $model->documentCode, $emailEmail, $model->documentId, $website, $docAction, $docRemark, $model->employee->fnTh . " " . $model->employee->lnTh);
                                }
                                if ($documentWorkflowModel->groupId > 0 && $documentWorkflowModel->isFinished != 1) {
                                    $employees = GroupMember::model()->findAll("groupId=:groupId", array(
                                        ":groupId" => $documentWorkflowModel->groupId));
                                    foreach ($employees as $employee) {
                                        if ($employee->employeeId != 0) {
                                            $emp = Employee::model()->findByPk($employee->employeeId);
                                            $emailName = $emp->fnTh . "  " . $emp->lnTh;
                                            $emailEmail = $emp->email . "@daiigroup.com";
                                            $emailController->mailsend($emailName, $model->documentType->documentTypeName, $model->documentCode, $emailEmail, $model->documentId, $website, $docAction, $docRemark, $model->employee->fnTh . " " . $model->employee->lnTh);
                                        }
                                    }
                                }
                                /* if($documentWorkflowModel->isFinished == 1)
                                  { */ //Send email to creator all step
                                $emailName = $model->employee->fnTh . "  " . $model->employee->lnTh;
                                $emailEmail = $model->employee->email . "@daiigroup.com";
                                $emailController->mailsend($emailName, $model->documentType->documentTypeName, $model->documentCode, $emailEmail, $model->documentId, $website, $docAction, $docRemark, $model->employee->fnTh . " " . $model->employee->lnTh);
                                /* } */
                                $this->redirect(array(
                                    'Inbox'));
                            } else {
                                if (isset($errorMsg)) {
                                    $this->redirect(array(
                                        'view',
                                        'id' => $id,
                                        'errorMsg' => $errorMsg
                                    ));
                                } else {
                                    $this->redirect(array(
                                        'view',
                                        'id' => $id));
                                }
                            }
                        }
                    } else {
                        $this->redirect(array(
                            'Inbox'));
                    }
                }

                $transaction->rollback();
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
                $transaction->rollback();
            }
        }

        if (isset($documentWorkflowModel->employeeId) && $documentWorkflowModel->employeeId > 0) {
            $workflowStatus = WorkflowState::model()->getAllWorkflowStatusByCurrentStateAndWorkflowGroupId($model->documentWorkflow->currentState, $model->documentType->workflowGroupId, Yii::app()->user->id, $model->documentId);
        } else {
            $workflowStatus = WorkflowState::model()->getAllWorkflowStatusByCurrentStateAndWorkflowGroupIdAndMemberGroupId($model->documentWorkflow->currentState, $model->documentType->workflowGroupId, Yii::app()->user->id);
        }

        $currentWorkflowState = WorkflowState::model()->getWorkflowStateByCurrentStateAndWorkflowGroupId($model->documentWorkflow->currentState, $model->documentType->workflowGroupId);
        $stockSummary = null;

        $empAdminIt = Employee::model()->findByPk(Yii::app()->user->id);
        if (isset($empAdminIt) && ($empAdminIt->companyDivisionId == 5 || $empAdminIt->companyDivisionId == 7)) {
            if (count(Workflow::model()->findEmployeeInCurrentState(Yii::app()->user->id, $model->documentWorkflow->currentState)) > 0 && !empty($model->documentType->itemTable)) {
                $stockSummary = Stock::model()->sumStock($model->employee->companyId);
            }
        }

        $this->render('view', array(
            'model' => $model,
            'workflowStateModel' => $workflowStateModel,
            'workflowStatus' => $workflowStatus,
            'workflowLogModel' => $workflowLogModel,
            'documentDocumentTemplateField' => $docDocumentWorkflow,
            'historyLog' => $historyLog,
            'currentWorkflowState' => $currentWorkflowState,
            'documentWorkflowModel' => $documentWorkflowModel,
            'documentType' => $documentType,
            'stockSummary' => $stockSummary,
            'historyLog2' => WorkflowLog::model()->findAll('documentId=:documentId', array(
                'documentId' => $id)),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($documentTypeId)
    {
        $model = new Document;
        $documentItem = new DocumentItem("search");
        $workflowLogModel = new WorkflowLog("search");
        $date_now = new CDbExpression('NOW()');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $documentTypeModel = DocumentType::model();
        $documentType = $documentTypeModel->getDocumentTypeByid($documentTypeId);
        $emp = Employee::model()->findByPk($user = Yii::app()->user->id);
        $documentCode = $this->genDocumentCode($documentType);

        if (isset($_POST['Document'])) {
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $flag = 1;
                $model->attributes = $_POST['Document'];
                $model->documentCode = $documentCode;
                $model->documentTypeId = $documentTypeId;
                $model->employeeId = $emp->employeeId;
                $model->createDateTime = $date_now;
                $model->status = 1;
                if ($model->save()) {
                    $documentId = Yii::app()->db->lastInsertID;
                    if (isset($_POST["DocumentTemplate"])) {
                        foreach ($_POST["DocumentTemplate"]["control"] as $k => $v) {
                            $w = array(
                            );
                            $image = CUploadedFile::getInstanceByName("DocumentTemplate[control][$k]");
                            if (isset($image) || !empty($image)) {
                                $file_array = explode(".", $image->name);
                                $fileType = $file_array[count($file_array) - 1];
                                $imageUrl = 'images/document/' . time() . '-' . $this->guid() . "." . $fileType;
                                //$imageUrl = 'images/document/'.time().'-'.$image->name;
                                $imagePath = '/../' . $imageUrl;
                                $v = Yii::app()->baseUrl . '/' . $imageUrl;
                                $image->saveAs(Yii::app()->getBasePath() . $imagePath);
                            }
                            $docDocTemplateField = new DocumentDocumentTemplateField();
                            $docDocTemplateField->documentId = $documentId;
                            $w["documentTemplateFieldId"] = $k;
                            if (!isset($v) || empty($v)) {
                                $v = 0;
                                if (isset($_POST["DocumentTemplate"]["fieldType"][$k]) && $_POST["DocumentTemplate"]["fieldType"][$k] == 2) {
                                    $v = null;
                                    //$docDocTemplateField->addError("errorText", "กรุณาระบุข้อมูล ตาม * ให้ครบถ้วน");
                                    $model->addError("documentId", "กรุณาระบุข้อมูล ตาม * ให้ครบถ้วน ");
                                }
                            }
                            $w["value"] = $v;
                            $docDocTemplateField->attributes = $w;
                            if (!$docDocTemplateField->save()) {
                                $flag = 0;
                                break;
                            }
                        }
                    }
                    if (isset($_POST["DocumentItem"])) {
                        foreach ($_POST["DocumentItem"]["documentItemName"] as $k => $v) {
                            $w = array(
                            );
                            if (!empty($v) || $v == "0") {

                                $documentItem = new DocumentItem();
                                if (isset($_POST["DocumentItem"]["file"][$k])) {
                                    $image2 = CUploadedFile::getInstanceByName("DocumentItem[file][$k]");
                                    if (isset($image2)) {
                                        $file_array = explode(".", $image2->name);
                                        $fileType = $file_array[count($file_array) - 1];
                                        $imageUrl2 = 'images/document/' . time() . '-' . $this->guid() . "." . $fileType;
                                        //$imageUrl2 = 'images/document/'.time().'-'.$image2->name;
                                        $imagePath2 = '/../' . $imageUrl2;
                                        $image2->saveAs(Yii::app()->getBasePath() . $imagePath2);
                                    } else {
                                        $imageUrl2 = null;
                                    }
                                }

                                $w['documentId'] = $documentId;

                                //$w['documentItemName'] = Yii::app()->baseUrl.'/'.$imageUrl;
                                $w['documentItemName'] = $v;
                                if (isset($imageUrl2)) {
                                    $w["file"] = Yii::app()->baseUrl . '/' . $imageUrl2;
                                } else {
                                    if (isset($_POST["DocumentItem"]["isRequire"]["file"][$k]) && $_POST["DocumentItem"]["isRequire"]["file"][$k] == 2) {
                                        $documentItem->addError("file", "กรุณาระบุข้อมูลให้ครบถ้วน");
                                        $rule = array(
                                            'file',
                                            'required');
                                    }
                                    $w["file"] = null;
                                }

                                if (isset($_POST["DocumentItem"]["description"][$k])) {
                                    $w["description"] = $_POST["DocumentItem"]["description"][$k];
                                } else {
                                    if (isset($_POST["DocumentItem"]["isRequire"]["description"][$k]) && $_POST["DocumentItem"]["isRequire"]["description"][$k] == 2) {
                                        $documentItem->addError("description", "กรุณาระบุข้อมูลให้ครบถ้วน");
                                        $rule = array(
                                            'description',
                                            'required');
                                    }
                                    $w["description"] = null;
                                }

                                if (isset($_POST["DocumentItem"]["remark"][$k])) {
                                    $w["remark"] = $_POST["DocumentItem"]["remark"][$k];
                                } else {
                                    if (isset($_POST["DocumentItem"]["isRequire"]["remark"][$k]) && $_POST["DocumentItem"]["isRequire"]["remark"][$k] == 2) {
                                        $documentItem->addError("description", "กรุณาระบุข้อมูลให้ครบถ้วน");
                                    }
                                    $w["remark"] = null;
                                }

                                if (isset($_POST["DocumentItem"]["id"][$k])) {
                                    $w["id"] = $_POST["DocumentItem"]["id"][$k];
                                } else {
                                    if (isset($_POST["DocumentItem"]["isRequire"]["id"][$k]) && $_POST["DocumentItem"]["isRequire"]["id"][$k] == 2) {
                                        $documentItem->addError("id", "กรุณาระบุข้อมูลให้ครบถ้วน");
                                    }
                                    $w["id"] = null;
                                }

                                if (isset($_POST["DocumentItem"]["value"][$k])) {
                                    $w["value"] = $_POST["DocumentItem"]["value"][$k];
                                } else {
                                    if (isset($_POST["DocumentItem"]["isRequire"]["value"][$k]) && $_POST["DocumentItem"]["isRequire"]["value"][$k] == 2) {
                                        $documentItem->addError("value", "กรุณาระบุข้อมูลให้ครบถ้วน");
                                    }
                                    $w["value"] = null;
                                }

                                if (isset($_POST["DocumentItem"]["table"][$k])) {
                                    $w["table"] = $_POST["DocumentItem"]["table"][$k];
                                } else {
                                    if (isset($_POST["DocumentItem"]["isRequire"]["table"][$k]) && $_POST["DocumentItem"]["isRequire"]["table"][$k] == 2) {
                                        $documentItem->addError("table", "กรุณาระบุข้อมูลให้ครบถ้วน");
                                    }
                                    $w["table"] = null;
                                }

                                if (isset($_POST["DocumentItem"]["unit"][$k])) {
                                    $w["unit"] = $_POST["DocumentItem"]["unit"][$k];
                                } else {
                                    if (isset($_POST["DocumentItem"]["isRequire"]["unit"][$k]) && $_POST["DocumentItem"]["isRequire"]["unit"][$k] == 2) {
                                        $documentItem->addError("unit", "กรุณาระบุข้อมูลให้ครบถ้วน");
                                    }
                                    $w["unit"] = null;
                                }

                                if (isset($_POST["DocumentItem"]["description8"][$k])) {
                                    $w["description8"] = $_POST["DocumentItem"]["description8"][$k];
                                } else {
                                    if (isset($_POST["DocumentItem"]["isRequire"]["description8"][$k]) && $_POST["DocumentItem"]["isRequire"]["description8"][$k] == 2) {
                                        $documentItem->addError("description8", "กรุณาระบุข้อมูลให้ครบถ้วน");
                                    }
                                    $w["description8"] = null;
                                }

                                if (isset($_POST["DocumentItem"]["description9"][$k])) {
                                    $w["description9"] = $_POST["DocumentItem"]["description9"][$k];
                                } else {
                                    if (isset($_POST["DocumentItem"]["isRequire"]["description9"][$k]) && $_POST["DocumentItem"]["isRequire"]["description9"][$k] == 2) {
                                        $documentItem->addError("description9", "กรุณาระบุข้อมูลให้ครบถ้วน");
                                    }
                                    $w["description9"] = null;
                                }

                                if (isset($_POST["DocumentItem"]["description10"][$k])) {
                                    $w["description10"] = $_POST["DocumentItem"]["description10"][$k];
                                } else {
                                    if (isset($_POST["DocumentItem"]["isRequire"]["description10"][$k]) && $_POST["DocumentItem"]["isRequire"]["description10"][$k] == 2) {
                                        $documentItem->addError("description10", "กรุณาระบุข้อมูลให้ครบถ้วน");
                                    }
                                    $w["description10"] = null;
                                }

                                $w["status"] = 1;
                                $w["createDateTime"] = $date_now;
                                //$w["documentItemName"] = $v;
                                //$documentItem->description1 = CUploadedFile::getInstanceByName("DocumentItem[description1][$k]");
                                //$documentItem->description1->saveAs(Yii::app()->getBasePath().'/../images/documentItem/'.$documentId.'-'.$documentItem->description1);
                                //Comment on check require documentItem 05062013
                                //$documentItem->unsetAttributes();
                                //Comment on check require documentItem 05062013
                                //CMap::mergeArray($documentItem->rules(), $rule);
                                $documentItem->attributes = $w;

                                if (!$documentItem->save()) {
                                    $flag = 0;
                                    break;
                                }
                            } else {
                                if (isset($_POST["DocumentItem"]["isRequire"]["documentItemName"][$k]) && $_POST["DocumentItem"]["isRequire"]["documentItemName"][$k] == 2) {
                                    $documentItem->addError("file", "กรุณาระบุข้อมูลให้ครบถ้วน");
                                    $rule = array(
                                        'documentItemName',
                                        'required');
                                }
                                $w["documentItemName"] = null;
                                $flag = 0;
                            }
                        }
                    }

                    //save document_workflow : documentId, currentState, docuemntGroupId
                    $documentWorkflow = new DocumentWorkflow;
                    $workflowStates = $documentType->workflowGroup->workflowState;

                    if ($workflowStates[0]->currentState == 0 && $workflowStates[0]->nextState == 0) {
                        $documentWorkflow->currentState = 0;
                        $documentWorkflow->employeeId = Yii::app()->user->id;
                        $documentWorkflow->groupId = null;
                        $documentWorkflow->isFinished = 0;
                    } else {
                        $documentWorkflow->currentState = $workflowStates[0]->nextState;

                        if ($workflowStates[0]->nextState == 0) {
                            $documentWorkflow->isFinished = 1;
                        }
                        if (isset($workflowStates[0]->workflowNext->employeeId)) {
                            if ($workflowStates[0]->workflowNext->employeeId != 0) {
                                $documentWorkflow->employeeId = $workflowStates[0]->workflowNext->employeeId;
                            } else {
                                if ($workflowStates[0]->workflowNext->groupId == 0) {
                                    $employee = Employee::model()->findByPk(Yii::app()->user->id);
                                    if ($employee->level->level >= 7 || $employee->username == "nmk") {
                                        $documentWorkflow->employeeId = Yii::app()->user->id;
                                    } else {
                                        $documentWorkflow->employeeId = $employee->managerId;
                                    }
                                }
                            }
                        }
                        if ($workflowStates[0]->workflowNext->groupId != 0) {
                            $documentWorkflow->groupId = $workflowStates[0]->workflowNext->groupId;
                        } else {
                            $documentWorkflow->groupId = null;
                        }
                    }

                    $documentWorkflow->createDateTime = $date_now;
                    $documentWorkflow->documentId = $documentId;

                    if (!$documentWorkflow->save()) {
                        $flag = false;
                    } else {
                        //Workflow Log
                        $workflowLogModel = new WorkflowLog("search");
                        $w['documentId'] = $documentId;
                        //$w['workflowStateId'] = $model->documentWorkflow->currentState;
                        $w['workflowStateId'] = $workflowStates[0]->workflowStateId;
                        $w['employeeId'] = Yii::app()->user->id;
                        $w['createDateTime'] = $date_now;
                        if (isset($_POST["WorkflowLog"]["remarks"])) {
                            $w['remarks'] = $_POST["WorkflowLog"]["remarks"];
                        } else {
                            $w['remarks'] = "";
                        }
                        $hourToWork = $workflowStates[0]->workflowGroup->getHourToWork($workflowStates[0], $documentId);
                        if (isset($hourToWork)) {
                            $workflowLogModel->numHour = $hourToWork["hourToWork"];
                            $workflowLogModel->isOverEstimate = $hourToWork["isOverEstimate"];
                            $workflowLogModel->estimateHour = $hourToWork["estimateHour"];
                        }
                        $workflowLogModel->attributes = $w; //Controller::writeToFile('/tmp/doc_view', print_r($workflowLogModel->attributes, true));
                        //if($documentWorkflowModel->save() || !$workflowLogModel->save())

                        if (!$workflowLogModel->save()) {
                            throw new Exception(print_r($workflowLogModel->errors, true));
                            $flag = false;
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        /*
                          $emailController = new EmailSend();
                          $website = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/document/";
                          $docAction = "ส่งเอกสาร";
                          $docRemark = $workflowLogModel->remarks;
                          if ($documentWorkflow->employeeId > 0 && $documentWorkflow->currentState != 0)
                          {
                          $emailName = $documentWorkflow->employee->fnTh . "  " . $documentWorkflow->employee->lnTh;
                          $emailEmail = $documentWorkflow->employee->email . "@daiigroup.com";
                          $emailController->mailsend($emailName, $model->documentType->documentTypeName, $documentCode, $emailEmail, $documentId, $website, $docAction, $docRemark, $model->employee->fnTh . " " . $model->employee->lnTh);
                          }
                          if ($documentWorkflow->groupId > 0 && $documentWorkflow->currentState != 0)
                          {
                          $employees = GroupMember::model()->findAll("groupId=:groupId", array(
                          ":groupId" => $documentWorkflow->groupId));
                          foreach ($employees as $employee)
                          {
                          $emp = Employee::model()->findByPk($employee->employeeId);
                          $emailName = $emp->fnTh . "  " . $emp->lnTh;
                          $emailEmail = $emp->email . "@daiigroup.com";
                          $emailController->mailsend($emailName, $model->documentType->documentTypeName, $documentCode, $emailEmail, $documentId, $website, $docAction, $docRemark, $model->employee->fnTh . " " . $model->employee->lnTh);
                          }
                          }
                         */

                        $documentModel = $this->loadModel($documentId);
                        if ($documentModel->documentTypeId == 36) {
                            $url = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/document/viewFixTime/";
                        } else {
                            $url = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/document/";
                        }

                        $docAction = "ส่งเอกสาร";
                        $docRemark = $workflowLogModel->remarks;

                        $this->sendEmail($url, $documentModel, $docAction, $docRemark);

                        $this->redirect(array(
                            'Outbox'));
                    }
                }
                $transaction->rollback();
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
                $transaction->rollback();
            }
        }

        $this->render('create', array(
            'model' => $model,
            'documentType' => $documentType,
            'emp' => $emp,
            'documentItem' => $documentItem,
            'documentCode' => $documentCode,
            'workflowLogModel' => $workflowLogModel,
        ));
    }

    /**
     * Mobile.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionMobile()
    {
        $codePrefix = $_GET["prefix"];
        $model = new Document;
        $documentItem = new DocumentItem("search");
        $workflowLogModel = new WorkflowLog("search");
        $date_now = date("Y-m-d H:i:s");
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $documentResult = $model->findDocumentByDocumentCode(strtoupper($codePrefix));
        $documentTypeModel = DocumentType::model();
        $documentType = $documentTypeModel->getDocumentTypeByPrefix(strtoupper($codePrefix));
        $isnewDocument = false;
        if (isset($_POST["DocumentItem"])) {
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $flag = true;
                $document = new Document();
                $documentId = 0;
                $documentToday = $model->findDocumentByDocumentCode(strtoupper($codePrefix), "today");

                if (count($documentToday) > 0) {
                    $document = $documentToday[0];
                    $documentId = $document->documentId;
                } else {
                    $isnewDocument = true;
                    $documentCode = $this->genDocumentCode($documentType);
                    $document->documentCode = $documentCode;
                    $document->documentTypeId = $documentType->documentTypeId;
                    $document->employeeId = Yii::app()->user->id;

                    $document->createDateTime = $date_now;
                    $document->status = 1;
                    if (!$document->save()) {
                        $flag = false;
                    } else {
                        $documentId = Yii::app()->db->lastInsertID;

                        $documentWorkflow = new DocumentWorkflow;
                        $documentWorkflow->currentState = 0;
                        $documentWorkflow->documentId = $documentId;
                        $documentWorkflow->employeeId = Yii::app()->user->id;
                        $documentWorkflow->groupId = null;
                        $documentWorkflow->isFinished = 0;
                        $documentWorkflow->createDateTime = $date_now;
                        if (!$documentWorkflow->save()) {
                            $flag = false;
                        }
                    }
                }

                $workflowStates = $documentType->workflowGroup->workflowState;
                //Workflow Log
                $workflowLogModel = new WorkflowLog("search");
                $w['documentId'] = $documentId;
                //$w['workflowStateId'] = $model->documentWorkflow->currentState;
                $w['workflowStateId'] = $workflowStates[0]->workflowStateId;
                $w['employeeId'] = Yii::app()->user->id;
                $w['createDateTime'] = $date_now;
                $w['remarks'] = "mobile";
                $workflowLogModel->attributes = $w; //Controller::writeToFile('/tmp/doc_view', print_r($workflowLogModel->attributes, true));
                //if($documentWorkflowModel->save() || !$workflowLogModel->save())

                if (!$workflowLogModel->save()) {
                    $flag = false;
                }

                foreach ($_POST["DocumentItem"]["documentItemName"] as $k => $v) {
                    if (!empty($v)) {
                        $documentItem = new DocumentItem();
                        $documentItem->documentId = $documentId;

                        $image2 = CUploadedFile::getInstanceByName("DocumentItem[file][$k]");

                        if (isset($image2)) {
                            $imageUrl2 = 'images/document/' . time() . '-' . $image2->name;
                            $imagePath2 = '/../' . $imageUrl2;
                            $image2->saveAs(Yii::app()->getBasePath() . $imagePath2);
                            $imageUrlUpdate = Yii::app()->baseUrl . '/' . $imageUrl2;
                        }

                        $w = array(
                        );

                        if (isset($v)) {
                            $w['documentItemName'] = $v;
                        } else {
                            $w['documentItemName'] = " ";
                        }

                        $w["file"] = isset($imageUrlUpdate) ? $imageUrlUpdate : null;

                        if (isset($_POST["DocumentItem"]["description"][$k])) {
                            $w["description"] = $_POST["DocumentItem"]["description"][$k];
                        }
                        if (isset($_POST["DocumentItem"]["remark"][$k])) {
                            $w["remark"] = $_POST["DocumentItem"]["remark"][$k];
                        }

                        if (isset($_POST["DocumentItem"]["id"][$k])) {
                            $w["id"] = $_POST["DocumentItem"]["id"][$k];
                        }

                        if (isset($_POST["DocumentItem"]["value"][$k])) {
                            $w["value"] = $_POST["DocumentItem"]["value"][$k];
                        }

                        if (isset($_POST["DocumentItem"]["table"][$k])) {
                            $w["table"] = $_POST["DocumentItem"]["table"][$k];
                        }

                        if (isset($_POST["DocumentItem"]["unit"][$k])) {
                            $w["unit"] = $_POST["DocumentItem"]["unit"][$k];
                        }

                        if (isset($_POST["DocumentItem"]["description8"][$k])) {
                            $w["description8"] = $_POST["DocumentItem"]["description8"][$k];
                        }

                        if (isset($_POST["DocumentItem"]["description9"][$k])) {
                            $w["description9"] = $_POST["DocumentItem"]["description9"][$k];
                        }

                        if (isset($_POST["DocumentItem"]["description10"][$k])) {
                            $w["description10"] = $_POST["DocumentItem"]["description10"][$k];
                        }
                        $w["status"] = 1;
                        $w["createDateTime"] = $date_now;

                        $documentItem->attributes = $w;

                        if (!$documentItem->save()) {
                            $flag = false;
                        }
                    }
                }
                if ($flag) {
                    $transaction->commit();
                    $res = array(
                    );

                    $res['result'] = true;
                    if ($isnewDocument) {
                        $res['documentId'] = $documentId;
                        $res['documentCode'] = $document->documentCode;
                        $res['createDateTime'] = $document->createDateTime;
                    }
                    $this->jsonEncode($res);
                } else {
                    $res = array(
                    );
                    $res['result'] = false;
                    $res['error'] = "flag = false";
                    $this->jsonEncode($res);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $res = array(
                );
                $res['result'] = false;
                $res['error'] = $ex->getMessage();
                $this->jsonEncode($res);
            }
        } else {
            $this->writeToFile('/tmp/doc_mobile', print_r($documentResult, true));
            if (count($documentResult)) {
                $res = $this->generateMobileDocument($documentType, $documentResult);
                $this->jsonEncode($res);
            } else {
                $res = $this->generateMobileDocument($documentType, null);
                $this->jsonEncode($res);
            }
        }
    }

    public function generateMobileDocument($documentType, $document)
    {
        $res = array(
        );
        $res['documentTypeId'] = $documentType->documentTypeId;
        if (isset($document)) {
            $n = 0;
            foreach ($document as $doc) {
                $res['data'][$n]['documentId'] = $doc->documentId;
                $res['data'][$n]['createDateTime'] = $doc->createDateTime;
                $res['data'][$n]['documentCode'] = $doc->documentCode;
                $n++;
            }
        }
        if (isset($documentType->documentTemplate)) {
            $i = 0;
            foreach ($documentType->documentTemplate as $template) {
                if ($template->status == 1) {
                    if ($template->isItem == 1) {
                        $inputName = 'inputsItem';
                        $res[$inputName][$i]['documentItemField'] = $template->documentItemField;
                    } else {
                        $inputName = 'inputsDoc';
                    }
                    $res[$inputName][$i]['fieldId'] = $template->documentTemplateField->documentTemplateFieldId;
                    $res[$inputName][$i]['fieldName'] = $template->documentTemplateField->documentTemplateFieldName;
                    $res[$inputName][$i]['inputType'] = $template->documentControlType->documentControlTypeName;
                    $res[$inputName][$i]['editState'] = $template->editState;
                    $res[$inputName][$i]['addState'] = $template->addState;

                    if ($template->documentControlDataId > 0) {
                        if (empty($template->documentControlData->dataModel)) {
                            $j = 0;
                            $docControlDataItem = DocumentControlDataItem::model()->findAllItemByDocumentControlDataId($template->documentControlDataId);
                            foreach ($docControlDataItem as $controlDataItem) {
                                $res[$inputName][$i]['controlData'][$j]['id'] = $controlDataItem->documentControlDataItemId;
                                $res[$inputName][$i]['controlData'][$j]['value'] = $controlDataItem->documentControlDataItemValue;
                                $j++;
                            }
                        } else {
                            $modelString = $template->documentControlData["dataModel"];
                            $id = $template->documentControlDataId;
                            //throw new Exception($modelString." ".$id);
                            $methodString = $template->documentControlData["dataMethod"];
                            $dataItem = new $modelString;
                            $items = $dataItem->$methodString();
                            $k = 0;
                            foreach ($items as $key => $value) {
                                $res[$inputName][$i]['controlData'][$k]['id'] = $key;
                                $res[$inputName][$i]['controlData'][$k]['value'] = $value;
                                $k++;
                            }
                        }
                    }
                    $i++;
                }
            }
        }

        return $res;
    }

    public function actionViewDocMobileInfo($id)
    {
        $model = new Document();
        $document = $model->findByPk($id);
        $res = array(
        );
        $res['documentId'] = $document->documentId;
        $res['documentTypeId'] = $document->documentTypeId;
        $docDocTemplateField = new DocumentDocumentTemplateField();
        $docDocTemplateField = $docDocTemplateField->findAll("documentId =:documentId", array(
            ":documentId" => $id));
        $i = 0;
        if (count($docDocTemplateField) > 0) {
            foreach ($docDocTemplateField as $docField) {
                $templateField = DocumentTemplateField::model()->find("documentTemplateFieldId =:documentTemplateFieldId", array(
                    ":documentTemplateFieldId" => $docField->documentTemplateFieldId));
                $res['fieldsDoc'][$i]["Id"] = $docField->id;
                $res['fieldsDoc'][$i]["fieldId"] = $docField->documentTemplateFieldId;
                $res['fieldsDoc'][$i]["fieldName"] = $templateField->documentTemplateFieldName;
                $res['fieldsDoc'][$i]["fieldName"] = $docField->value;
                $i++;
            }
        }

        $documentItem = DocumentItem::model()->findAll("documentId = :documentId", array(
            ":documentId" => $id));
        if (count($documentItem) > 0) {
            $i = 0;
            foreach ($documentItem as $docItem) {
                $res['ItemsDoc'][$i]["documentItemId"] = $docItem->documentItemId;
                $res['ItemsDoc'][$i]["documentId"] = $id;
                if (isset($docItem->documentItemName) && !empty($docItem->documentItemName))
                    $res['ItemsDoc'][$i]["documentItemName"] = $docItem->documentItemName;
                if (isset($docItem->file) && !empty($docItem->file))
                    $res['ItemsDoc'][$i]["file"] = $docItem->file;
                if (isset($docItem->description) && !empty($docItem->description))
                    $res['ItemsDoc'][$i]["description"] = $docItem->description;
                if (isset($docItem->remark) && !empty($docItem->remark))
                    $res['ItemsDoc'][$i]["remark"] = $docItem->remark;
                if (isset($docItem->id) && !empty($docItem->id))
                    $res['ItemsDoc'][$i]["id"] = $docItem->id;
                if (isset($docItem->value) && !empty($docItem->value))
                    $res['ItemsDoc'][$i]["value"] = $docItem->value;
                if (isset($docItem->table) && !empty($docItem->table))
                    $res['ItemsDoc'][$i]["table"] = $docItem->table;
                if (isset($docItem->unit) && !empty($docItem->unit))
                    $res['ItemsDoc'][$i]["unit"] = $docItem->unit;
                if (isset($docItem->description8) && !empty($docItem->description8))
                    $res['ItemsDoc'][$i]["description8"] = $docItem->description8;
                if (isset($docItem->description9) && !empty($docItem->description9))
                    $res['ItemsDoc'][$i]["description9"] = $docItem->description9;
                if (isset($docItem->description10) && !empty($docItem->description10))
                    $res['ItemsDoc'][$i]["description10"] = $docItem->description10;
                if (isset($docItem->status) && !empty($docItem->status))
                    $res['ItemsDoc'][$i]["status"] = $docItem->status;
                $i++;
            }
        }

        $this->jsonEncode($res);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Document'])) {
            $model->attributes = $_POST['Document'];
            if ($model->save())
                $this->redirect(array(
                    'view',
                    'id' => $model->documentId));
        }

        $this->render('update', array(
            'model' => $model,));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
                    'admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        /* $dataProvider=new CActiveDataProvider('Document');
          $this->render('index',array(
          'dataProvider'=>$dataProvider
          )); */

        if (isset($_POST['device'])) {
            $documentTypeModels = DocumentType::model()->getAllDocumentTypeInMobile();
            $i = 0;
            foreach ($documentTypeModels as $dtm) {
                $res['data'][$i]["documentTypeName"] = $dtm->documentTypeName;
                $res['data'][$i]["documentCodePrefix"] = $dtm->documentCodePrefix;

                $i++;
            }

            $this->jsonEncode($res);
        }

        $model = new DocumentType('searchForCreateDocument');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['DocumentType']))
            $model->attributes = $_GET['DocumentType'];

        $this->render('index', array(
            'model' => $model,));
    }

    public function actionAdmin()
    {
        $model = new Document('search');
        //$model->unsetAttributes(); // clear any default values
        if (isset($_GET['Document']))
            $model->attributes = $_GET['Document'];

        $this->render('admin', array(
            'model' => $model,));
    }

    /**
     * Manages all models.
     */
    public function actionDocument()
    {
        $model = new Document('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Document']))
            $model->attributes = $_GET['Document'];

        $this->render('document', array(
            'model' => $model,));
    }

    /**
     * Manages all Inbox.
     */
    public function actionDraft()
    {
        $model = new Document('search');
        //$model->unsetAttributes(); // clear any default values
        if (isset($_GET['Document']))
            $model->attributes = $_GET['Document'];

        $this->render('draft', array(
            'model' => $model,));
    }

    /**
     * Manages all Inbox.
     */
    public function actionInbox()
    {
        $model = new Document('search');
        //$model->unsetAttributes(); // clear any default values
        if (isset($_GET['Document']))
            $model->attributes = $_GET['Document'];

        $this->render('inbox', array(
            'model' => $model,));
    }

    /**
     * Manages all Outbox.
     */
    public function actionOutbox()
    {
        $model = new Document('search');
        //$model->unsetAttributes(); // clear any default values
        if (isset($_GET['Document']))
            $model->attributes = $_GET['Document'];

        $this->render('outbox', array(
            'model' => $model,));
    }

    /**
     * Manages all History.
     */
    public function actionHistory()
    {
        $model = new Document('search');
        //$model->unsetAttributes(); // clear any default values
        if (isset($_GET['Document']))
            $model->attributes = $_GET['Document'];

        $this->render('history', array(
            'model' => $model,));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Document::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'document-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function genDocumentCode($documentType)
    {
        $prefix = $documentType->documentCodePrefix;
        $max_code = Document::model()->findMaxCode($documentType);
        $max_code += 1;
        return $prefix . date("Ym") . str_pad($max_code, 4, "0", STR_PAD_LEFT);
    }

    public function selectControlType($model, $form, $control, $template)
    {
        if ($control != "control") {
            $fieldId = "";
            //$fieldId = $template->documentTemplateFieldId;
            //$endName = "[$template->documentTemplateFieldId][]";
            $endName = "";
        } else {
            $endName = "";
            $fieldId = $template->documentTemplateFieldId;
        }
        $fieldType = $template->documentControlType->documentControlTypeName;
        if ($fieldType == "textBox") {
            echo $form->textField($model, $control . '[' . $fieldId . ']', array(
                'class' => 'input-small'));
        } else if ($fieldType == "dropdownList") {
            if (!isset($template->documentControlData["dataModel"]) || $template->documentControlData["dataModel"] == null) {
                $w = array(
                    '' => 'Choose');
                $documentControlDataItem = new DocumentControlDataItem();
                $items = DocumentControlDataItem::model()->findAll("documentControlDataId =:documentControlDataId", array(
                    ":documentControlDataId" => $template->documentControlDataId));
                foreach ($items as $item) {
                    $w[isset($item->documentControlDataItemUseId) ? $item->documentControlDataItemUseId : $item->documentControlDataItemId] = isset($item->documentControlDataItemValue) ? $item->documentControlDataItemValue : "-";
                }
                echo $form->dropdownlist($model, $control . '[' . $fieldId . ']', $w);
            } else {
                try {
                    $modelString = $template->documentControlData["dataModel"];
                    $id = $template->documentControlDataId;
                    //throw new Exception($modelString." ".$id);
                    $methodString = $template->documentControlData["dataMethod"];
                    $dataItem = new $modelString;
                    $items = $dataItem->$methodString();
                    //throw new Exception(count($items));
                    echo $form->dropdownlist($model, $control . '[' . $fieldId . ']', $items, array(
                        'class' => 'input-medium'));
                } catch (Exception $ex) {
                    throw new Exception($ex->getMessage());
                }
            }
        } else if ($fieldType == "checkBox") {
            if (!isset($template->documentControlData["dataModel"]) || $template->documentControlData["dataModel"] == null) {
                $w = array(
                );
                $documentControlDataItem = new DocumentControlDataItem();
                $items = DocumentControlDataItem::model()->findAll("documentControlDataId =:documentControlDataId", array(
                    ":documentControlDataId" => $template->documentControlDataId));
                foreach ($items as $item) {
                    $w[isset($item->documentControlDataItemId) ? $item->documentControlDataItemId : 0] = isset($item->documentControlDataItemValue) ? $item->documentControlDataItemValue : "-";
                }
                //return $form->dropdownlist($model,$attributes,$w,array('name'=>$name));
                echo $form->checkBoxList($model, $control . '[' . $fieldId . ']', $w);
            } else {
                try {
                    $modelString = $template->documentControlData["dataModel"];
                    $id = $template->documentControlDataId;
                    //throw new Exception($modelString." ".$id);
                    $methodString = $template->documentControlData["dataMethod"];
                    $dataItem = new $modelString;
                    $items = $dataItem->$methodString();
                    //throw new Exception(count($items));
                    //return $form->dropdownlist($model,$attributes,$items,array('name'=>$name,'class'=>'input-medium'));
                    echo $form->checkBoxList($model, $control . '[' . $fieldId . ']', $items);
                } catch (Exception $ex) {
                    throw new Exception($ex->getMessage());
                }
            }
            //echo $form->checkBox($model,$control.'['.$fieldId.']');
        } else if ($fieldType == "date") {
            $scriptionName = "#datepicker" . $fieldId . $endName;
            Yii::app()->clientScript->registerScript("$scriptionName", "
				$(function(){
					$('$scriptionName').datepicker({
					changeMonth: true,
					changeYear: true,
					dateFormat: 'yy-mm-dd',
					});
				});
			");

            echo $form->textField($model, $control . '[' . $fieldId . ']', array(
                'id' => 'datepicker' . $fieldId . $endName,
                'class' => 'input-small',
            ));
        } else if ($fieldType == "textArea") {
            echo $form->textArea($model, $control . '[' . $fieldId . ']');
        } else if ($fieldType == "file") {
            echo CHtml::activeFileField($model, $control . '[' . $fieldId . ']', array(
                'class' => 'input-small'));
        } else if ($fieldType == "link") {
            echo $form->hiddenField($model, $control . '[' . $fieldId . ']');
        } else {
            echo "No control";
        }
    }

    public function selectItemControlType($model, $form, $attributes, $name, $template)
    {
        $fieldType = "";
        $fieldId = null;
        if (isset($template->documentTemplateFieldId)) {
            $fieldId = $template->documentTemplateFieldId;
        }
        if (isset($template->documentControlType)) {
            $fieldType = $template->documentControlType->documentControlTypeName;
        }
        if ($fieldType == "textBox") {
            return $form->textField($model, $attributes, array(
                'name' => $name,
                'class' => 'input-small'
            ));
        } else if ($fieldType == "dropdownList") {
            if (!isset($template->documentControlData["dataModel"]) || $template->documentControlData["dataModel"] == null) {
                $w = array(
                    '' => 'Choose');
                $documentControlDataItem = new DocumentControlDataItem();
                $items = DocumentControlDataItem::model()->findAll("documentControlDataId =:documentControlDataId", array(
                    ":documentControlDataId" => $template->documentControlDataId));
                foreach ($items as $item) {
                    $w[isset($item->documentControlDataItemUseId) ? $item->documentControlDataItemUseId : $item->documentControlDataItemId] = isset($item->documentControlDataItemValue) ? $item->documentControlDataItemValue : "-";
                }
                return $form->dropdownlist($model, $attributes, $w, array(
                    'name' => $name));
            } else {
                try {
                    $modelString = $template->documentControlData["dataModel"];
                    $id = $template->documentControlDataId;
                    //throw new Exception($modelString." ".$id);
                    $methodString = $template->documentControlData["dataMethod"];
                    $dataItem = new $modelString;
                    $items = $dataItem->$methodString();
                    //throw new Exception(count($items));
                    return $form->dropdownlist($model, $attributes, $items, array(
                        'name' => $name,
                        'class' => 'input-medium'
                    ));
                } catch (Exception $ex) {
                    throw new Exception($ex->getMessage());
                }
            }
        } else if ($fieldType == "checkBox") {
            if (!isset($template->documentControlData["dataModel"]) || $template->documentControlData["dataModel"] == null) {
                $w = array(
                );
                $documentControlDataItem = new DocumentControlDataItem();
                $items = DocumentControlDataItem::model()->findAll("documentControlDataId =:documentControlDataId", array(
                    ":documentControlDataId" => $template->documentControlDataId));
                foreach ($items as $item) {
                    $w[isset($item->documentControlDataItemId) ? $item->documentControlDataItemId : 0] = isset($item->documentControlDataItemValue) ? $item->documentControlDataItemValue : "-";
                }
                //return $form->dropdownlist($model,$attributes,$w,array('name'=>$name));
                return $form->checkBoxList($model, $attributes, $w, array(
                    'name' => $name));
            } else {
                try {
                    $modelString = $template->documentControlData["dataModel"];
                    $id = $template->documentControlDataId;
                    //throw new Exception($modelString." ".$id);
                    $methodString = $template->documentControlData["dataMethod"];
                    $dataItem = new $modelString;
                    $items = $dataItem->$methodString();
                    //throw new Exception(count($items));
                    //return $form->dropdownlist($model,$attributes,$items,array('name'=>$name,'class'=>'input-medium'));
                    return $form->checkBoxList($model, $attributes, $items, array(
                        'name' => $name));
                } catch (Exception $ex) {
                    throw new Exception($ex->getMessage());
                }
            }
        } else if ($fieldType == "date") {
            $scriptionName = "#datepicker" . $fieldId;
            Yii::app()->clientScript->registerScript("$scriptionName", "
			$(function(){
			$('$scriptionName').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd',
		});
		});
		");
            return $form->textField($model, $attributes, array(
                'name' => $name,
                'id' => 'datepicker' . $fieldId,
                'class' => 'input-small'
            ));

            // $form->widget('zii.widgets.jui.CJuiDatePicker',$datePickerConfig);
        } else if ($fieldType == "textArea") {
            return $form->textArea($model, $attributes, array(
                'name' => $name));
        } else if ($fieldType == "file") {
            return CHtml::activeFileField($model, $attributes, array(
                'name' => $name,
                'class' => 'input-small'
            ));
        } else if ($fieldType == "link") {
            return $form->hiddenField($model, $control . '[' . $fieldId . ']');
        } else {
            return "No control";
        }
    }

    public function getFieldName($documentTypeId, $documentItemField)
    {
        $documentTemplate = DocumentTemplate::model()->getFieldNameByDocumentTypeIdAndDocumentItemFieldName($documentTypeId, $documentItemField);
        if (isset($documentTemplate->documentTemplateField->documentTemplateFieldName) && !empty($documentTemplate->documentTemplateField->documentTemplateFieldName)) {
            return $documentTemplate->documentTemplateField->documentTemplateFieldName;
        } else {
            return "ไม่มีชื่อฟิลด์";
        }
    }

    public function showDocumentField($canEdit, $fieldName = array(
    ), $fieldValue = array(
    ), $fieldValue2 = array(
    ), $fieldValue3 = array(
    ))
    {
        $itemField = '';

        if ($canEdit) {
            if (count($fieldName) > 0) {
                foreach ($fieldName as $k => $v) {
                    $itemField .= '<div class="control-group">';
                    $itemField .= '<label class="control-label">' . $v . '</label>';
                    $itemField .= '<div class="controls">';
                    $itemField .= nl2br($fieldValue[$k]);
                    if (isset($fieldValue2[$k]))
                        $itemField .= nl2br($fieldValue2[$k]);
                    if (isset($fieldValue3[$k]))
                        $itemField .= nl2br($fieldValue3[$k]);
                    $itemField .= '</div>';
                    $itemField .= '</div>';
                }
            }
        }
        else {
            $itemField = '<div class="alert alert-success">';
            /* $itemField .= '<dl class="dl-horizontal">';
              foreach($fieldName as $k=>$v)
              {
              $itemField .= '<dt >'.$v.'</dt>';
              $itemField .= '<dd>'.nl2br($fieldValue[$k]).'</dd>';
              if(isset($fieldValue2[$k]))
              $itemField .= '<dd>'.nl2br($fieldValue2[$k]).'</dd>';
              if(isset($fieldValue3[$k]))
              $itemField .= '<dd>'.nl2br($fieldValue3[$k]).'</dd>';
              }
              $itemField .= '</dl>'; */
            foreach ($fieldName as $k => $v) {
                $itemField .= '<div class="control-group">';
                $itemField .= '<label class="control-label">' . $v . '</label>';
                $itemField .= '<div class="controls">';
                $itemField .= nl2br($fieldValue[$k]);
                if (isset($fieldValue2[$k]))
                    $itemField .= nl2br($fieldValue2[$k]);
                if (isset($fieldValue3[$k]))
                    $itemField .= nl2br($fieldValue3[$k]);
                $itemField .= '</div>';
                $itemField .= '</div>';
            }
            $itemField .= '</div>';
        }

        return $itemField;
    }

    public function showItemField($itemField)
    {
        $item = '';
        $i = 1;
        foreach ($itemField as $k => $v) {
            $item .= '<div class="alert alert-info">';
            $item .= '<div class="control-group">';
            $item .= '<label class="control-label">ลำดับ</label>';
            $item .= '<div class="controls">';
            $item .= "$i";
            $item .= '</div>';
            $item .= '</div>';
            if ($itemField[$k]['canEdit']) {
                foreach ($itemField[$k]['fieldName'] as $k1 => $v1) {
                    $item .= '<div class="control-group">';
                    $item .= '<label class="control-label">' . $v1 . '</label>';
                    $item .= '<div class="controls">';
                    $item .= nl2br($itemField[$k]['fieldValue'][$k1]);
                    if (isset($itemField[$k]['fieldValue2'][$k1]) && !empty($itemField[$k]['fieldValue2'][$k1])) {
                        $item .= $itemField[$k]['fieldValue2'][$k1];
                    }
                    if (isset($itemField[$k]['delete'][$k1]) && !empty($itemField[$k]['delete'][$k1])) {
                        $item .= $itemField[$k]['delete'][$k1];
                    }
                    if (isset($itemField[$k]['approve'][$k1]) && !empty($itemField[$k]['approve'][$k1])) {
                        $item .= $itemField[$k]['approve'][$k1];
                    }
                    if (isset($itemField[$k]['reject'][$k1]) && !empty($itemField[$k]['reject'][$k1])) {
                        $item .= $itemField[$k]['reject'][$k1];
                    }
                    $item .= '</div>';
                    $item .= '</div>';
                }
            } else {
                $item .= '<dl class="dl-horizontal">';

                foreach ($itemField[$k]['fieldName'] as $k1 => $v1) {
                    $item .= '<dt>' . $v1 . '</dt>';
                    $item .= '<dd>' . nl2br($itemField[$k]['fieldValue'][$k1]) . '</dd>';
                }

                $item .= '</dl>';
            }

            $item .= '</div>';
            $i++;
        }

        return $item;
    }

    public function getDataItemFieldValue($documentTypeId, $documentItemFieldName, $documentItemValue, $canEdit = false)
    {
        $documentTemplate = DocumentTemplate::model()->find("documentTypeId = :documentTypeId AND documentItemField =:documentItemField", array(
            ":documentTypeId" => $documentTypeId,
            ":documentItemField" => $documentItemFieldName
        ));

        if (isset($documentTemplate)) {
            if ($documentTemplate->documentControlDataId > 0) {
                $documentControlData = $documentTemplate->documentControlData;
                if (isset($documentControlData->dataModel) && !empty($documentControlData->dataModel)) {
                    $modelString = new $documentControlData->dataModel;
                    //throw new Exception($modelString." ".$id);
                    $methodString = $documentControlData->dataMethod;
                    //$dataItem = new $modelString;
                    //$items = $dataItem->$methodString();
                    $items = $modelString;

                    $fieldValues = explode(",", $documentControlData->fieldValue);
                    if (!$canEdit) {
                        //$data = $modelString::model()->findByPk($documentItemValue);
                        $data = $modelString->findByPk($documentItemValue);
                        $strField = "";
                        foreach ($fieldValues as $field) {
                            $strField .= " " . $data->$field;
                        }
                        //throw new Exception($strField);
                        return $strField;
                    } else {
                        return $items;
                    }
                } else {
                    $str = "documentControlDataId = :documentControlDataId ";
                    $params = array(
                        ":documentControlDataId" => $documentControlData->documentControlDataId);
                    if (!$canEdit) {
                        $str .= " AND documentControlDataItemId = :documentControlDataItemId";
                        $params[":documentControlDataItemId"] = $documentItemValue;
                    }

                    if (!$canEdit) {
                        $documentControlDataItem = DocumentControlDataItem::model()->find($str, $params);
                        return $documentControlDataItem["documentControlDataItemValue"];
                    } else {
                        $documentControlDataItem = DocumentControlDataItem::model()->findAll($str, $params);
                        $w = array(
                        );
                        foreach ($documentControlDataItem as $item)
                            ; {
                            $w[$item->documentControlDataItemId] = $item->documentControlDataItemValue;
                        }
                        return $w;
                    }
                }
            } else {
                return null;
            }
        }
    }

    public function actionCancelDocument($id)
    {
        $document = Document::model()->findByPk($id);
        if (isset($_POST["WorkflowLog"])) {
            if (!empty($_POST["WorkflowLog"]["remarks"])) {
                if (isset($document)) {
                    $document->status = 0;
                    if (!$document->save()) {
                        echo "failed";
                    } else {
                        $workflowLogModel = new WorkflowLog();
                        $dateNow = new CDbExpression('NOW()');
                        $w = array(
                        );
                        $w['documentId'] = $id;
                        $w['workflowStateId'] = -1;
                        $w['employeeId'] = Yii::app()->user->id;
                        $w['createDateTime'] = $dateNow;
                        $w['remarks'] = $_POST['WorkflowLog']['remarks'];

                        $workflowLogModel->attributes = $w;

                        if (!$workflowLogModel->save(false)) {
                            echo "failed";
                        } else {
                            if (Yii::app()->request->isAjaxRequest) {
                                echo CJSON::encode(array(
                                    'status' => 'success',
                                    'div' => "ลบเอกสารเสร็จสมบูรณ์"
                                ));
                                exit;
                            } else
                                $this->redirect(array(
                                    'outbox'));

                            //echo "success";
                            //$this->redirect(array('outbox'));
                        }
                    }
                }
            }
            else {
                if (Yii::app()->request->isAjaxRequest) {
                    echo CJSON::encode(array(
                        'status' => 'remark',
                        'div' => "กรุณากรอกเหตุผลเพื่อลบเอกสาร"
                    ));
                    exit;
                } else
                    $this->redirect(array(
                        'outbox'));
            }
        }

        if (Yii::app()->request->isAjaxRequest) {
            $workflowLog = new WorkflowLog();

            echo CJSON::encode(array(
                'status' => 'failed',
                'div' => $this->renderPartial('cancelDocument', array(
                    'model' => $document,
                    'workflowLog' => $workflowLog
                ), true)
            ));
            exit;
        } else
            $this->redirect(array(
                'outbox'));
    }

    public function checkCanEditItemField($model, $documentItemFieldName, $currentWorkflowState)
    {
        $template = DocumentTemplate::model()->find("documentTypeId=:documentTypeId AND documentItemField=:documentItemField AND status = :status", array(
            ':documentTypeId' => $model->documentTypeId,
            ':documentItemField' => $documentItemFieldName,
            ':status' => '1'
        ));
        $canEdit = Workflow::model()->checkCanEditState($currentWorkflowState->workflowCurrent->workflowId, isset($template->editState) ? $template->editState : " ", $model->documentId);
        return $canEdit;
    }

    public function getWaitProcess($data, $row = null)
    {
        $waitProcessStr = " ";
        if (isset($data->documentWorkflow->workflowCurrent)) {
            $waitProcessStr .= $data->documentWorkflow->workflowCurrent->workflowName;

            if ($data->documentWorkflow->workflowCurrent->employeeId > 0) {
                $waitProcessStr .= " ( ";
                $waitProcessStr .= $data->documentWorkflow->workflowCurrent->employee->username;
                $waitProcessStr .= " ) ";
            } else if ($data->documentWorkflow->workflowCurrent->employeeId == 0) {
                if ($data->documentWorkflow->workflowCurrent->groupId > 0) {
                    $waitProcessStr .= " ( ";
                    if (isset($data->documentWorkflow->workflowCurrent->group)) {
                        $groupMember = GroupMember::model()->findAll("groupId =:groupId", array(
                            "groupId" => $data->documentWorkflow->workflowCurrent->groupId));
                        $groupFlag = false;
                        foreach ($groupMember as $emp) {
                            $groupFlag = true;
                            $employee = Employee::model()->findByPk($emp->employeeId);
                            $waitProcessStr .= " $employee->username ";
                        }
                    }
                    $waitProcessStr .= " ) ";
                }
            }
        }
        return $waitProcessStr;
    }

    public function guid()
    {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45); // "-"
            $uuid = chr(123)// "{"
            . substr($charid, 0, 8) . $hyphen . substr($charid, 8, 4) . $hyphen . substr($charid, 12, 4) . $hyphen . substr($charid, 16, 4) . $hyphen . substr($charid, 20, 12) . chr(125); // "}"
            return $uuid;
        }
    }

    /**
     * For test customer project process process_sub
     */
    public function actionProject()
    {
        for ($i = 0; $i < rand(1, 10); $i++) {
            $res['pj'][$i]['customerName'] = 'Customer Name : ' . $i;
            $res['pj'][$i]['customerId'] = $i;

            for ($j = 0; $j < rand(1, 10); $j++) {
                $res['pj'][$i]['project'][$j]['projectName'] = 'Project Name : ' . $j;
                $res['pj'][$i]['project'][$j]['projectId'] = $j;

                for ($k = 0; $k < rand(1, 10); $k++) {
                    $res['pj'][$i]['project'][$j]['process'][$k]['processName'] = 'Process Name : ' . $k;
                    $res['pj'][$i]['project'][$j]['process'][$k]['processId'] = $k;

                    for ($l = 0; $l < rand(1, 10); $l++) {
                        $res['pj'][$i]['project'][$j]['process'][$k]['processSub'][$l]['processSubName'] = 'Process Sub Name : ' . $l;
                        $res['pj'][$i]['project'][$j]['process'][$k]['processSub'][$l]['processSubId'] = $l;
                    }
                }
            }
        }

        $this->jsonEncode($res);
    }

    /**
     * Send Email
     */
    public function sendEmail($url, $documentModel, $docAction = null, $docRemark = null)
    {
        $emailController = new EmailSend();
        $documentWorkflowModel = $documentModel->documentWorkflow;

        $creatorName = $documentModel->employee->fnTh . ' ' . $documentModel->employee->lnTh;
        $documentCode = $documentModel->documentCode;
        if ($documentWorkflowModel->currentState != 0) {
            if ($documentWorkflowModel->employeeId > 0 && $documentWorkflowModel->isFinished != 1) {
                $emailName = $documentWorkflowModel->employee->fnTh . "  " . $documentWorkflowModel->employee->lnTh;
                $emailEmail = $documentWorkflowModel->employee->email . "@daiigroup.com";
                $emailController->mailsend($emailName, $documentModel->documentType->documentTypeName, $documentCode, $emailEmail, $documentModel->documentId, $url, $docAction, $docRemark, $creatorName);
            }

            if ($documentWorkflowModel->groupId > 0) {
                $employees = GroupMember::model()->findAll("groupId=:groupId", array(
                    ":groupId" => $documentWorkflowModel->groupId));
                foreach ($employees as $employee) {
                    if ($employee->employeeId != 0) {
                        $emp = Employee::model()->findByPk($employee->employeeId);
                        $emailName = $emp->fnTh . "  " . $emp->lnTh;
                        $emailEmail = $emp->email . "@daiigroup.com";
                        $emailController->mailsend($emailName, $documentModel->documentType->documentTypeName, $documentCode, $emailEmail, $documentModel->documentId, $url, $docAction, $docRemark, $creatorName);
                    }
                }
            }

            $emailEmail = $documentModel->employee->email . '@daiigroup.com';
            $emailController->mailsend($creatorName, $documentModel->documentType->documentTypeName, $documentCode, $emailEmail, $documentModel->documentId, $url, $docAction, $docRemark, $creatorName);
        }
    }

    /**
     * custom action
     */
    public function actionCreateLeave($documentTypeId)
    {
        $documentModel = new Document;
        $workflowLogModel = new WorkflowLog;
        $docomentTypeModel = new DocumentType;
        $documentType = $docomentTypeModel->getDocumentTypeByid($documentTypeId);
        $leaveModel = new Leave;
        $leaveItemModel = new LeaveItem;

        $startDate = null;
        $endDate = null;
        $error = null;

        if (isset($_POST['LeaveItem'])) {
            //check leave quota

            if (isset($_POST['LeaveItem']['leaveTimeType'])) {
                $sumLeaveTime = Leave::model()->sumLeaveTimeByLeaveTimeTypeArray($_POST['LeaveItem']['leaveTimeType']);
                $remainLeave = Leave::model()->remainLeaveDateByLeaveType($_POST['Leave']['leaveType'], Yii::app()->user->id) - Leave::model()->remainWaitApproveLeaveDateByLeaveType($_POST['Leave']['leaveType'], Yii::app()->user->id);

                if ($sumLeaveTime <= $remainLeave) {
                    //save item
                    $documentModel->documentCode = $this->genDocumentCode($documentType);
                    $documentModel->documentTypeId = $documentTypeId;
                    $documentModel->employeeId = Yii::app()->user->id;
                    $documentModel->createDateTime = new CDbExpression('NOW()');

                    $flag = true;

                    $transaction = Yii::app()->db->beginTransaction();
                    try {
                        if ($documentModel->save()) {
                            $this->documentId = Yii::app()->db->lastInsertID;

                            $leaveModel->documentId = $this->documentId;
                            $leaveModel->leaveType = $_POST['Leave']['leaveType'];
                            $leaveModel->isLate = (isset($_POST['Leave']['isLate'])) ? $_POST['Leave']['isLate'] : 0;
                            $image = CUploadedFile::getInstanceByName("Leave[filePath]");

                            if (!empty($image)) {
                                $imageUrl = '/images/document/' . time() . '-' . $image->name;
                                $imagePath = '/../' . $imageUrl;
                                //$v = Yii::app()->baseUrl.'/'.$imageUrl;
                                $v = $imageUrl;
                                $image->saveAs(Yii::app()->getBasePath() . $imagePath);
                                $leaveModel->filePath = $v;
                            }
                            if ($leaveModel->save()) {
                                $leaveId = Yii::app()->db->lastInsertID;
                                $leaveTimeType = $_POST['LeaveItem']['leaveTimeType'];
                                $leaveDate = $_POST['LeaveItem']['leaveDate'];
                                $hasNoleave = false;
                                $hasLeave = false;
                                foreach ($_POST['LeaveItem']['leaveTimeType'] as $k => $leaveTimeType) {
                                    if ($leaveTimeType != 0) {
                                        $hasLeave = true;
                                    }

                                    $leaveItem = new LeaveItem;
                                    $leaveItem->leaveId = $leaveId;
                                    $leaveItem->leaveDate = $leaveDate[$k];
                                    $leaveItem->leaveTimeType = $leaveTimeType;
                                    $leaveItem->leaveTime = $leaveItem->genLeaveTime($leaveTimeType);
                                    if (!$leaveItem->save()) {
                                        $flag = false;
                                        break;
                                    }
                                }
                                if (!$hasLeave) {
                                    $flag = $hasLeave;
                                    $error .= " กรุณาตรวจสอบ เวลาที่ต้องการลา ให้ถูกต้อง(คุณเลือกไม่ลาทั้งหมด)";
                                    $startDate = null;
                                    $endDate = null;
                                    $leaveModel->leaveType = null;
                                }

                                if ($flag) {
                                    //save DocumentWorkflow
                                    if (!DocumentWorkflow::model()->saveDocumentWorkflow($documentType, $this->documentId, $_POST['Leave']['leaveType']))
                                        $flag = false;
                                }

//								if ($flag)
//								{
//									//save DocumentWorkflow
//									if (!DocumentWorkflow::model()->saveDocumentWorkflow($documentType, $this->documentId))
//										$flag = false;
//								}
                                //WorkflowLog
                                if ($flag) {
                                    $workflowLogModel = new WorkflowLog();
                                    $workflowLogModel->documentId = $this->documentId;
                                    $workflowLogModel->workflowStateId = $documentType->workflowGroup->workflowState[0]->workflowStateId;
                                    $workflowLogModel->employeeId = Yii::app()->user->id;
                                    $workflowLogModel->createDateTime = new CDbExpression('NOW()');
                                    $workflowLogModel->remarks = isset($_POST["WorkflowLog"]["remarks"]) ? $_POST["WorkflowLog"]["remarks"] : '';
                                    $hourToWork = $documentType->workflowGroup->workflowState[0]->workflowGroup->getHourToWork($documentType->workflowGroup->workflowState[0], $this->documentId);
                                    if (isset($hourToWork)) {
                                        $workflowLogModel->numHour = $hourToWork["hourToWork"];
                                        $workflowLogModel->isOverEstimate = $hourToWork["isOverEstimate"];
                                        $workflowLogModel->estimateHour = $hourToWork["estimateHour"];
                                    }
                                    if (!$workflowLogModel->save())
                                        $flag = false;
                                }
                            }
                        }
                        else {
                            $flag = false;
                        }

                        if ($flag) {
                            $transaction->commit();


                            $documentModel = $this->loadModel($this->documentId);
                            $url = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/document/viewLeave/";
                            $docAction = "ส่งเอกสาร";
                            $docRemark = $workflowLogModel->remarks;

                            $this->sendEmail($url, $documentModel, $docAction, $docRemark);


                            $this->redirect(array(
                                'viewLeave',
                                'id' => $this->documentId
                            ));
                        } else {
                            $transaction->rollback();
                        }
                    } catch (Exception $e) {
                        throw new Exception($e->getMessage());
                        $transaction->rollback();
                    }
                } else {
                    $error = 'จำนวนวันลาไม่พอ สามารถ' . Leave::model()->leaveTypeText($_POST['Leave']['leaveType']);
                }
            } else {
                $error = 'กรุณาระบุวันที่ และ เวลา ต้องการลา อีกครั้ง';
            }
        }

        if (isset($_POST['Leave']['startDate']) && isset($_POST['Leave']['endDate']) && isset($_POST['Leave']['leaveType'])) {
            if (empty($_POST['Leave']['leaveType'])) {
                $error = 'กรุณาเลือกประเภทการลา';
                $startDate = null;
                $endDate = null;
            } else if (empty($_POST['Leave']['startDate']) && empty($_POST['Leave']['endDate'])) {
                $error = 'กรุณาระบุวันที่ต้องการลา';
                $startDate = null;
                $endDate = null;
            } else {
                $today = date('Y-m-d');
                $sd = explode('/', $_POST['Leave']['startDate']);
                $startDate = $sd[2] . '-' . $sd[1] . '-' . $sd[0];
                $ed = explode('/', $_POST['Leave']['endDate']);
                $endDate = !empty($_POST['Leave']['endDate']) ? $ed[2] . '-' . $ed[1] . '-' . $ed[0] : $startDate;
                $leaveModel->leaveType = $_POST['Leave']['leaveType'];

                $numDate = (strtotime($startDate) - strtotime($today)) / (60 * 60 * 24);
                $todayOfWeek = date('N');
                $numLeaveDate = 0;

                for ($i = 0; $i < ((strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24)) + 1; $i++) {
                    $dayOfWeak = date('N', strtotime($startDate) + (60 * 60 * 24 * $i));

                    $emp = Employee::model()->findByPk(Yii::app()->user->id);
                    if (($dayOfWeak == 6 || $dayOfWeak == 7) & $emp->branchId == 1)
                        continue;

                    $numLeaveDate++;
                }

                $requireDayLeave = ((strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24)) + 1;
                $amountDateLeave = 0;
                $startDayOfWeek = 0;
                for ($i = 0; $i < $requireDayLeave; $i++) {
                    $startDayOfWeek = date('N', strtotime($startDate) + (60 * 60 * 24 * $i));
                    if ($startDayOfWeek != 6 && $startDayOfWeek != 7) {
                        $amountDateLeave++;
                    }
                }

                if ($amountDateLeave > ceil(Leave::model()->remainLeaveDateByLeaveType($leaveModel->leaveType, Yii::app()->user->id) - Leave::model()->remainWaitApproveLeaveDateByLeaveType($leaveModel->leaveType, Yii::app()->user->id))) {
                    $error = 'จำนวนวันที่ต้องการเกินจำนวนวันที่สามารถลาได้';

                    $startDate = null;
                    $endDate = null;
                    $leaveModel->leaveType = null;
                } else if (empty($startDate) || empty($leaveModel->leaveType)) {
                    if (empty($leaveModel->leaveType))
                        $error = 'กรุณาเลือกประเภทการลา';
                    else
                        $error = 'กรุณาเลือกวันที่ต้องการลา';

                    $startDate = null;
                    $endDate = null;
                    $leaveModel->leaveType = null;
                }
                else if (strtotime($startDate) > strtotime($endDate)) {
                    $error = 'กรุณาเลือกลำดับวันให้ถูกต้อง';
                    $startDate = null;
                    $endDate = null;
                    $leaveModel->leaveType = null;
                }

                if ($leaveModel->leaveType == 1) { //sick leave
                    $calendarModel = Calendar::model()->findLastSalaryDate();
                    $lastSalaryDate = $calendarModel->date;
                    $salaryDate = substr($lastSalaryDate, 0, 8) . '22 14:00:00';

                    if (strtotime($startDate) > time() || strtotime($endDate) > time()) {
                        $error = 'ไม่สามารถลาป่วยล่วงหน้าได้';
                        $startDate = null;
                        $endDate = null;
                        $leaveModel->leaveType = null;
                    } else if (time() > strtotime($lastSalaryDate) && (strtotime($startDate) <= strtotime($salaryDate) || strtotime($endDate) <= strtotime($salaryDate))) {
                        $error = 'ไม่สามารถลาย้อนหลังข้ามเดือนได้ เนื่องจากเลยเวลาที่กำหนด';
                        $startDate = null;
                        $endDate = null;
                        $leaveModel->leaveType = null;
                    } else {
                        $numDate = abs((strtotime($endDate) - strtotime($today)) / (60 * 60 * 24));

                        $limit = ($todayOfWeek < 3) ? 5 : 3;

                        if ($numDate > $limit) {
                            $leaveModel->isLate = 1;
                            $error .= 'ทำเอกสารช้ากว่ากำหนด ถูกปรับวันละ 5 บาท';
                        }
                    }
                } else if ($leaveModel->leaveType == 2) { // personal leave
                    $limit = 2;

                    if ($todayOfWeek == 4 || $todayOfWeek == 5)
                        $limit = 4;

                    if ($numDate < $limit) {
                        $error = 'ไม่สามารถทำเอกสารได้ เนื่องจากลากิจต้องทำเอกสารล่วงหน้าอย่างน้อย 2 วัน ไม่นับวันเสาร์และอาทิตย์';
                        $startDate = null;
                        $endDate = null;
                        $leaveModel->leaveType = null;
                    }
                } else if ($leaveModel->leaveType == 3) { // vocation leave
                    if ($numDate < 7) {
                        $error = 'ไม่สามารถทำเอกสารได้ เนื่องจากลาพักร้อนต้องทำรายการล่วงหน้า 5 วันไม่นับวันเสาร์และอาทิตย์';
                        $startDate = null;
                        $endDate = null;
                        $leaveModel->leaveType = null;
                    }
                }
            }
        }

        $this->render('createLeave', array(
            'documentModel' => $documentModel,
            'workflowLogModel' => $workflowLogModel,
            'documentTypeModel' => $docomentTypeModel,
            'documentType' => $documentType,
            'leaveModel' => $leaveModel,
            'leaveItemModel' => $leaveItemModel,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'error' => $error,
        ));
    }

    public function actionViewLeave($id)
    {
        $model = $this->loadModel($id);
        $documentTypeModel = DocumentType::model()->findByPk($model->documentTypeId);
        $documentWorkflowModel = DocumentWorkflow::model()->findByPk($model->documentWorkflow->documentWorkflowId);

        if (isset($documentWorkflowModel->employeeId) && $documentWorkflowModel->employeeId > 0) {
            $workflowStatus = WorkflowState::model()->getAllWorkflowStatusByCurrentStateAndWorkflowGroupId($model->documentWorkflow->currentState, $model->documentType->workflowGroupId, Yii::app()->user->id, $model->documentId);
        } else {
            $workflowStatus = WorkflowState::model()->getAllWorkflowStatusByCurrentStateAndWorkflowGroupIdAndMemberGroupId($model->documentWorkflow->currentState, $model->documentType->workflowGroupId, Yii::app()->user->id);
        }

        $leaveModel = Leave::model()->find('documentId=' . $id);
        $workflowLogModel = new WorkflowLog();
        $currentWorkflowState = WorkflowState::model()->getWorkflowStateByCurrentStateAndWorkflowGroupId($model->documentWorkflow->currentState, $model->documentType->workflowGroupId);

        //Change WorkflowState
        if (isset($_POST['WorkflowState'])) {
            $workflowStateModel = WorkflowState::model()->getWorkflowStateByCurrentStateAndWrokflowStatusIdAndWorkflowGroupId($model->documentWorkflow->currentState, $_POST['WorkflowState']['workflowStatusId'], $model->documentType->workflowGroupId);

            $transaction = Yii::app()->db->beginTransaction();
            try {
                if (DocumentWorkflow::model()->updateDocumentWorkflowByWorkflowStatusModelAndDocumentId($workflowStateModel, $id) && Leave::model()->updateLeaveByDocumentIdAndWorkflowStatusId($id, $_POST['WorkflowState']['workflowStatusId'])) {
                    if (WorkflowLog::model()->saveWorkflowLog($id, $workflowStateModel->workflowStateId, $_POST['WorkflowLog']['remarks'], Yii::app()->user->id)) {
                        if ($leaveModel->leaveType == Leave::LEAVE_TYPE_VOCATION && $_POST['WorkflowState']['workflowStatusId'] == 4) {

                            if (Employee::model()->updateLeaveRemainByLeaveId($leaveModel->leaveId, $model->employeeId)) {
                                $transaction->commit();
                                $this->redirect(array(
                                    'Inbox'));
                            } else {
                                $transaction->rollback();
                            }
                        } else {
                            $transaction->commit();
                            $emailController = new EmailSend();
                            $website = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/document/ViewLeave/";
                            $docAction = "";
                            if (isset($workflowStateModel->workflowCurrent)) {
                                $docAction .= $workflowStateModel->workflowCurrent->workflowName . " ";
                            }
                            if (isset($workflowStateModel->workflowStatus)) {
                                $docAction .= "(" . $workflowStateModel->workflowStatus->workflowStatusName . ")";
                            }
                            $docRemark = $_POST['WorkflowLog']['remarks'];
                            if ($documentWorkflowModel->employeeId > 0 && $documentWorkflowModel->isFinished != 1) {
                                $emailName = $documentWorkflowModel->employee->fnTh . "  " . $documentWorkflowModel->employee->lnTh;
                                $emailEmail = $documentWorkflowModel->employee->email . "@daiigroup.com";
                                $emailController->mailsend($emailName, $model->documentType->documentTypeName, $model->documentCode, $emailEmail, $model->documentId, $website, $docAction, $docRemark, $model->employee->fnTh . " " . $model->employee->lnTh);
                            }
                            if ($documentWorkflowModel->groupId > 0 && $documentWorkflowModel->isFinished != 1) {
                                $employees = GroupMember::model()->findAll("groupId=:groupId", array(
                                    ":groupId" => $documentWorkflowModel->groupId));
                                foreach ($employees as $employee) {
                                    if ($employee->employeeId != 0) {
                                        $emp = Employee::model()->findByPk($employee->employeeId);
                                        $emailName = $emp->fnTh . "  " . $emp->lnTh;
                                        $emailEmail = $emp->email . "@daiigroup.com";
                                        $emailController->mailsend($emailName, $model->documentType->documentTypeName, $model->documentCode, $emailEmail, $model->documentId, $website, $docAction, $docRemark, $model->employee->fnTh . " " . $model->employee->lnTh);
                                    }
                                }
                            }
                            /* if($documentWorkflowModel->isFinished == 1)
                              { */ //Send email to creator all step
                            /* } */
                            $emailName = $model->employee->fnTh . "  " . $model->employee->lnTh;
                            $emailEmail = $model->employee->email . "@daiigroup.com";
                            $emailController->mailsend($emailName, $model->documentType->documentTypeName, $model->documentCode, $emailEmail, $model->documentId, $website, $docAction, $docRemark, $model->employee->fnTh . " " . $model->employee->lnTh);

                            $this->redirect(array(
                                'Inbox'));
                        }
                    } else {
                        $transaction->rollback();
                    }
                } else {
                    $transaction->rollback();
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
                $transaction->rollback();
            }
        }
        $workflowStateModel = new WorkflowState();

        $this->render('viewLeave', array(
            'model' => $model,
            'documentTypeModel' => $documentTypeModel,
            'documentWorkflowModel' => $documentWorkflowModel,
            'workflowStateModel' => $workflowStateModel,
            'workflowStatus' => $workflowStatus,
            'leaveModel' => $leaveModel,
            'workflowLogModel' => $workflowLogModel,
            'currentWorkflowState' => $currentWorkflowState
        ));
    }

    public function actionCancelLeaveDocument($id)
    {
        $model = Document::model()->findByPk($id);
        $flag = true;

        if (isset($_POST['WorkflowLog'])) {
            if (!empty($_POST['WorkflowLog']['remarks'])) {
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    $model->status = 0;

                    //save doc
                    if ($model->save(false)) {
                        $docWorkflow = DocumentWorkflow::model()->find("documentId = :documentId", array(
                            ":documentId" => $id));
                        $docWorkflow->currentState = 0;
                        $docWorkflow->isFinished = 1;
                        $docWorkflow->employeeId = null;
                        $docWorkflow->groupId = null;
                        if ($docWorkflow->save(false)) {
                            //save leave
                            $leaveModel = Leave::model()->find('documentId=' . $id);
                            $leaveModel->status = 2;

                            if ($leaveModel->save(false)) {
                                //save workflow log
                                if (WorkflowLog::model()->saveWorkflowLog($id, -1, $_POST['WorkflowLog']['remarks'])) {
                                    $transaction->commit();
                                    //$this->redirect(Yii::app()->createUrl('document/outbox'));
                                    if (Yii::app()->request->isAjaxRequest) {
                                        echo CJSON::encode(array(
                                            'status' => 'success',
                                            'div' => "ลบเอกสารเสร็จสมบูรณ์"
                                        ));
                                        exit;
                                    }
                                }
                            }
                        }
                    }

                    $transaction->rollback();

                    if (Yii::app()->request->isAjaxRequest) {
                        echo CJSON::encode(array(
                            'status' => 'remark',
                            'div' => 'ไม่สามารถทำรายการได้กรุณาลองใหม่',
                        ));
                    }
                } catch (Exception $e) {
                    throw new Exception($e->getMessage());
                    $transaction->rollback();
                }
            } else {
                if (Yii::app()->request->isAjaxRequest) {
                    echo CJSON::encode(array(
                        'status' => 'remark',
                        'div' => 'กรุณาใส่เหตุผลในการลบหรือยกเลิกเอกสาร',
                    ));
                } else
                    $this->redirect(Yii::app()->createUrl('document/outbox'));
            }
        }
        else {
            if (Yii::app()->request->isAjaxRequest) {
                $workflowLog = new WorkflowLog();

                echo CJSON::encode(array(
                    'status' => 'failed',
                    'div' => $this->renderPartial('cancelDocument', array(
                        'model' => $model,
                        'workflowLog' => $workflowLog
                    ), true),
                ));
                exit();
            } else
                $this->redirect(Yii::app()->createUrl('document/outbox'));
        }
    }

    public function actionViewFixTime($id)
    {
        $documentItem = new DocumentItem();
        $employeeModels = Employee::model()->getDocumentFixTimeItem("", "");
        ;

        if (isset($_POST['DocumentItem'])) {
            $startDate = $_POST['DocumentItem']['startDate'];
            $endDate = $_POST['DocumentItem']['endDate'];
            //$companyId = $_POST['DocumentItem']['companyId'];

            $employeeModels = Employee::model()->getDocumentFixTimeItem($startDate, $endDate);
            $documentItem->startDate = $startDate;
            $documentItem->endDate = $endDate;
        }

        $this->render('viewFixTime', array(
            'documentItem' => $documentItem,
            'employeeModels' => $employeeModels));
    }

    public function actionApproveFixTimeItemStatus($id)
    {
        $result = array(
        );
        $status = 1;
        $documentItemModel = DocumentItem::model()->findByPk($id);
        if ($documentItemModel->status == 1) {
            $documentItemModel->status = 2;
            $transaction = Yii::app()->db->beginTransaction();
            try {
                if ($documentItemModel->save()) {
                    $workflowLog = new WorkflowLog();
                    $workflowLog->documentId = $documentItemModel->documentId;
                    $workflowLog->workflowStateId = 216;
                    //$workflowLog->workflowLogId = 216;
                    $workflowLog->employeeId = Yii::app()->user->id;
                    $workflowLog->groupId = null;
                    $workflowLog->createDateTime = new CDbExpression('NOW()');
                    $workflowLog->remarks = "ผู้จัดการฝ่าย " . Yii::app()->user->id . "อนุมัติรายการที่ " . $id;
                    if ($workflowLog->save()) {
                        $this->checkProcessAllItemFixTime($documentItemModel->documentId);
                        $transaction->commit();
                        $result['status'] = $status;
                        echo CJSON::encode($result);
                    } else {
                        $status = 0;
                        $transaction->rollback();
                        $result['status'] = $status;
                        echo CJSON::encode($result);
                    }
                } else {
                    $status = 0;
                    $transaction->rollback();
                    $result['status'] = $status;
                    echo CJSON::encode($result);
                }
            } catch (Exception $exc) {
                $status = 0;
                $transaction->rollback();
                $result['status'] = $status;
                echo CJSON::encode($result);
                //echo $exc->getTraceAsString();
            }
        } else {
            $status = 2;
            $result['status'] = $status;
            echo CJSON::encode($result);
        }
    }

    public function actionRejectFixTimeItemStatus($id)
    {
        $result = array(
        );
        $status = 1;
        $documentItemModel = DocumentItem::model()->findByPk($id);
        if ($documentItemModel->status == 1) {
            $documentItemModel->status = 3;
            $transaction = Yii::app()->db->beginTransaction();
            try {
                if ($documentItemModel->save()) {
                    $workflowLog = new WorkflowLog();
                    $workflowLog->documentId = $documentItemModel->documentId;
                    $workflowLog->workflowStateId = 217;
                    $workflowLog->employeeId = Yii::app()->user->id;
                    $workflowLog->groupId = null;
                    $workflowLog->createDateTime = new CDbExpression('NOW()');
                    $workflowLog->remarks = "ผู้จัดการฝ่าย " . Yii::app()->user->id . "ไม่อนุมัติรายการที่ " . $id;
                    if ($workflowLog->save()) {
                        $this->checkProcessAllItemFixTime($documentItemModel->documentId);
                        $transaction->commit();
                        $result['status'] = $status;
                        echo CJSON::encode($result);
                    } else {
                        $status = 0;
                        $transaction->rollback();
                        $result['status'] = $status;
                        echo CJSON::encode($result);
                    }
                } else {
                    $status = 0;
                    $transaction->rollback();
                    $result['status'] = $status;
                    echo CJSON::encode($result);
                }
            } catch (Exception $exc) {
                $status = 0;
                $transaction->rollback();
                $result['status'] = $status;
                echo CJSON::encode($result);
            }
        } else {
            $status = 2;
            $result['status'] = $status;
            echo CJSON::encode($result);
        }
    }

    public function checkProcessAllItemFixTime($documentId)
    {
        $document = Document::model()->findByPk($documentId);
        $documentItemModel = DocumentItem::model()->findAll("documentId = :documentId AND status = 1", array(
            ":documentId" => $documentId));
        if (count($documentItemModel) == 0) {

            $documentWorkflow = DocumentWorkflow::model()->find("documentId = :documentId", array(
                ":documentId" => $documentId));
            $currentState = $documentWorkflow->currentState;
            $documentWorkflow->currentState = 0;
            $documentWorkflow->isFinished = 1;
            $documentWorkflow->employeeId = null;
            $documentWorkflow->groupId = null;
            $documentWorkflow->save(false);

            $workflowLog = new WorkflowLog();
            $workflowLog->documentId = $documentId;
            $workflowLog->workflowState = WorkflowState::model()->findByPk($currentState)->nextState;
            $workflowLog->employeeId = Yii::app()->user->id;
            $workflowLog->groupId = null;
            $workflowLog->createDateTime = new CDbExpression('NOW()');
            $workflowLog->remarks = "ดำเนินการให้แล้ว";
            $workflowLog->save(false);

            $emailController = new EmailSend();
            $website = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/document/viewFixTime";
            $docAction = "เอกสารได้ถูกดำเนินการแล้ว";
            $docRemark = "กรุณาเข้าสู่ระบบ เพื่อตรวจสอบ ว่ารายการของท่านได้รับการอนุมัติหรือไม่";
            $emailName = $document->employee->fnTh . "  " . $document->employee->lnTh;
            $emailEmail = $document->employee->email . "@daiigroup.com";
            $emailController->mailsend($emailName, $document->documentType->documentTypeName, $document->documentCode, $emailEmail, $document->documentId, $website, $docAction, $docRemark, $document->employee->fnTh . " " . $document->employee->lnTh);
        }
    }

    public function actionCreateOrdinate($documentTypeId)
    {
        $documentModel = new Document;
        $workflowLogModel = new WorkflowLog;
        $docomentTypeModel = new DocumentType;
        $documentType = $docomentTypeModel->getDocumentTypeByid($documentTypeId);
        $leaveModel = new Leave;
        $leaveItemModel = new LeaveItem;

        $startDate = null;
        $endDate = null;
        $error = null;

        if (isset($_POST['LeaveItem'])) {
            //check leave quota

            if (isset($_POST['LeaveItem']['leaveTimeType'])) {
                $sumLeaveTime = Leave::model()->sumLeaveTimeByLeaveTimeTypeArray($_POST['LeaveItem']['leaveTimeType']);

                if ($sumLeaveTime <= 30) {//Quota of ordinate
                    //save item
                    $documentModel->documentCode = $this->genDocumentCode($documentType);
                    $documentModel->documentTypeId = $documentTypeId;
                    $documentModel->employeeId = Yii::app()->user->id;
                    $documentModel->createDateTime = new CDbExpression('NOW()');

                    $flag = true;

                    $transaction = Yii::app()->db->beginTransaction();
                    try {
                        if ($documentModel->save()) {
                            $this->documentId = Yii::app()->db->lastInsertID;

                            $leaveModel->documentId = $this->documentId;
                            $leaveModel->leaveType = $_POST['Leave']['leaveType'];
                            $leaveModel->isLate = (isset($_POST['Leave']['isLate'])) ? $_POST['Leave']['isLate'] : 0;
                            $image = CUploadedFile::getInstanceByName("Leave[filePath]");

                            if (!empty($image)) {
                                $imageUrl = '/images/document/' . time() . '-' . $image->name;
                                $imagePath = '/../' . $imageUrl;
                                //$v = Yii::app()->baseUrl.'/'.$imageUrl;
                                $v = $imageUrl;
                                $image->saveAs(Yii::app()->getBasePath() . $imagePath);
                                $leaveModel->filePath = $v;
                            }
                            if ($leaveModel->save()) {
                                $leaveId = Yii::app()->db->lastInsertID;
                                $leaveTimeType = $_POST['LeaveItem']['leaveTimeType'];
                                $leaveDate = $_POST['LeaveItem']['leaveDate'];

                                foreach ($_POST['LeaveItem']['leaveTimeType'] as $k => $leaveTimeType) {
                                    if (!$leaveTimeType)
                                        continue;

                                    $leaveItem = new LeaveItem;
                                    $leaveItem->leaveId = $leaveId;
                                    $leaveItem->leaveDate = $leaveDate[$k];
                                    $leaveItem->leaveTimeType = $leaveTimeType;
                                    $leaveItem->leaveTime = $leaveItem->genLeaveTime($leaveTimeType);

                                    if (!$leaveItem->save()) {
                                        $flag = false;
                                        break;
                                    }
                                }

                                if ($flag) {
                                    //save DocumentWorkflow
                                    if (!DocumentWorkflow::model()->saveDocumentWorkflow($documentType, $this->documentId, $_POST['Leave']['leaveType']))
                                        $flag = false;
                                }

//								if ($flag)
//								{
//									//save DocumentWorkflow
//									if (!DocumentWorkflow::model()->saveDocumentWorkflow($documentType, $this->documentId))
//										$flag = false;
//								}
                                //WorkflowLog
                                if ($flag) {
                                    $workflowLogModel = new WorkflowLog();
                                    $workflowLogModel->documentId = $this->documentId;
                                    $workflowLogModel->workflowStateId = $documentType->workflowGroup->workflowState[0]->workflowStateId;
                                    $workflowLogModel->employeeId = Yii::app()->user->id;
                                    $workflowLogModel->createDateTime = new CDbExpression('NOW()');
                                    $workflowLogModel->remarks = isset($_POST["WorkflowLog"]["remarks"]) ? $_POST["WorkflowLog"]["remarks"] : '';

                                    if (!$workflowLogModel->save())
                                        $flag = false;
                                }
                            }
                        }
                        else {
                            $flag = false;
                        }

                        if ($flag) {
                            $transaction->commit();


                            $documentModel = $this->loadModel($this->documentId);
                            $url = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/document/viewLeave/";
                            $docAction = "ส่งเอกสาร";
                            $docRemark = $workflowLogModel->remarks;

                            $this->sendEmail($url, $documentModel, $docAction, $docRemark);


                            $this->redirect(array(
                                'viewOrdinate',
                                'id' => $this->documentId
                            ));
                        } else {
                            $transaction->rollback();
                        }
                    } catch (Exception $e) {
                        throw new Exception($e->getMessage());
                        $transaction->rollback();
                    }
                } else {
                    $error = 'จำนวนวันลาไม่พอ สามารถ' . Leave::model()->leaveTypeText($_POST['Leave']['leaveType']);
                }
            } else {
                $error = 'กรุณาระบุวันที่ และ เวลา ต้องการลา อีกครั้ง';
            }
        }

        if (isset($_POST['Leave']['startDate']) && isset($_POST['Leave']['endDate']) && isset($_POST['Leave']['leaveType'])) {
            if (empty($_POST['Leave']['leaveType'])) {
                $error = 'กรุณาเลือกประเภทการลา';
                $startDate = null;
                $endDate = null;
            } else if (empty($_POST['Leave']['startDate']) && empty($_POST['Leave']['endDate'])) {
                $error = 'กรุณาระบุวันที่ต้องการลา';
                $startDate = null;
                $endDate = null;
            } else {
                $today = date('Y-m-d');
                $sd = explode('/', $_POST['Leave']['startDate']);
                $startDate = $sd[2] . '-' . $sd[1] . '-' . $sd[0];
                $ed = explode('/', $_POST['Leave']['endDate']);
                $endDate = !empty($_POST['Leave']['endDate']) ? $ed[2] . '-' . $ed[1] . '-' . $ed[0] : $startDate;
                $leaveModel->leaveType = $_POST['Leave']['leaveType'];

                $numDate = (strtotime($startDate) - strtotime($today)) / (60 * 60 * 24);
                $todayOfWeek = date('N');
                $numLeaveDate = 0;

                for ($i = 0; $i < ((strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24)) + 1; $i++) {
                    $dayOfWeak = date('N', strtotime($startDate) + (60 * 60 * 24 * $i));

                    if ($dayOfWeak == 6 || $dayOfWeak == 7)
                        continue;

                    $numLeaveDate++;
                }

                $requireDayLeave = ((strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24)) + 1;
                $amountDateLeave = 0;
                $startDayOfWeek = 0;
                for ($i = 0; $i < $requireDayLeave; $i++) {
                    $startDayOfWeek = date('N', strtotime($startDate) + (60 * 60 * 24 * $i));
                    if ($startDayOfWeek != 6 && $startDayOfWeek != 7) {
                        $amountDateLeave++;
                    }
                }

                if ($amountDateLeave > 30) {
                    $error = 'จำนวนวันที่ต้องการเกินจำนวนวันที่สามารถลาได้';

                    $startDate = null;
                    $endDate = null;
                    $leaveModel->leaveType = null;
                } else if (empty($startDate) || empty($leaveModel->leaveType)) {
                    if (empty($leaveModel->leaveType))
                        $error = 'กรุณาเลือกประเภทการลา';
                    else
                        $error = 'กรุณาเลือกวันที่ต้องการลา';

                    $startDate = null;
                    $endDate = null;
                    $leaveModel->leaveType = null;
                }
                else if (strtotime($startDate) > strtotime($endDate)) {
                    $error = 'กรุณาเลือกลำดับวันให้ถูกต้อง';
                    $startDate = null;
                    $endDate = null;
                    $leaveModel->leaveType = null;
                }

                if ($leaveModel->leaveType == 5) { // vocation leave
                    if ($numDate < 7) {
                        $error = 'ไม่สามารถทำเอกสารได้ เนื่องจากลาบวชต้องทำรายการล่วงหน้า 5 วันไม่นับวันเสาร์และอาทิตย์';
                        $startDate = null;
                        $endDate = null;
                        $leaveModel->leaveType = null;
                    }
                }
            }
        }

        $this->render('createOrdinate', array(
            'documentModel' => $documentModel,
            'workflowLogModel' => $workflowLogModel,
            'documentTypeModel' => $docomentTypeModel,
            'documentType' => $documentType,
            'leaveModel' => $leaveModel,
            'leaveItemModel' => $leaveItemModel,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'error' => $error,
        ));
    }

    public function actionViewOrdinate($id)
    {
        $model = $this->loadModel($id);
        $documentTypeModel = DocumentType::model()->findByPk($model->documentTypeId);
        $documentWorkflowModel = DocumentWorkflow::model()->findByPk($model->documentWorkflow->documentWorkflowId);

        if (isset($documentWorkflowModel->employeeId) && $documentWorkflowModel->employeeId > 0) {
            $workflowStatus = WorkflowState::model()->getAllWorkflowStatusByCurrentStateAndWorkflowGroupId($model->documentWorkflow->currentState, $model->documentType->workflowGroupId, Yii::app()->user->id, $model->documentId);
        } else {
            $workflowStatus = WorkflowState::model()->getAllWorkflowStatusByCurrentStateAndWorkflowGroupIdAndMemberGroupId($model->documentWorkflow->currentState, $model->documentType->workflowGroupId, Yii::app()->user->id);
        }

        $leaveModel = Leave::model()->find('documentId=' . $id);
        $workflowLogModel = new WorkflowLog();
        $currentWorkflowState = WorkflowState::model()->getWorkflowStateByCurrentStateAndWorkflowGroupId($model->documentWorkflow->currentState, $model->documentType->workflowGroupId);

        //Change WorkflowState
        if (isset($_POST['WorkflowState'])) {
            $workflowStateModel = WorkflowState::model()->getWorkflowStateByCurrentStateAndWrokflowStatusIdAndWorkflowGroupId($model->documentWorkflow->currentState, $_POST['WorkflowState']['workflowStatusId'], $model->documentType->workflowGroupId);

            $transaction = Yii::app()->db->beginTransaction();
            try {
                $image = CUploadedFile::getInstanceByName("Leave[filePath]");

                if (!empty($image)) {
                    $imageUrl = '/images/document/' . time() . '-' . $image->name;
                    $imagePath = '/../' . $imageUrl;
                    //$v = Yii::app()->baseUrl.'/'.$imageUrl;
                    $v = $imageUrl;
                    $image->saveAs(Yii::app()->getBasePath() . $imagePath);
                    $leaveModel->filePath = $v;
                }
                if ($leaveModel->save()) {
                    if (DocumentWorkflow::model()->updateDocumentWorkflowByWorkflowStatusModelAndDocumentId($workflowStateModel, $id) && Leave::model()->updateLeaveByDocumentIdAndWorkflowStatusId($id, $_POST['WorkflowState']['workflowStatusId'])) {
                        if (WorkflowLog::model()->saveWorkflowLog($id, $workflowStateModel->workflowStateId, $_POST['WorkflowLog']['remarks'], Yii::app()->user->id)) {
                            if ($leaveModel->leaveType == Leave::LEAVE_TYPE_VOCATION && $_POST['WorkflowState']['workflowStatusId'] == 4) {

                                if (Employee::model()->updateLeaveRemainByLeaveId($leaveModel->leaveId, $model->employeeId)) {
                                    $transaction->commit();
                                    $this->redirect(array(
                                        'Inbox'));
                                } else {
                                    $transaction->rollback();
                                }
                            } else {
                                $transaction->commit();
                                $emailController = new EmailSend();
                                $website = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/document/ViewLeave/";
                                $docAction = "";
                                if (isset($workflowStateModel->workflowCurrent)) {
                                    $docAction .= $workflowStateModel->workflowCurrent->workflowName . " ";
                                }
                                if (isset($workflowStateModel->workflowStatus)) {
                                    $docAction .= "(" . $workflowStateModel->workflowStatus->workflowStatusName . ")";
                                }
                                $docRemark = $_POST['WorkflowLog']['remarks'];
                                if ($documentWorkflowModel->employeeId > 0 && $documentWorkflowModel->isFinished != 1) {
                                    $emailName = $documentWorkflowModel->employee->fnTh . "  " . $documentWorkflowModel->employee->lnTh;
                                    $emailEmail = $documentWorkflowModel->employee->email . "@daiigroup.com";
                                    $emailController->mailsend($emailName, $model->documentType->documentTypeName, $model->documentCode, $emailEmail, $model->documentId, $website, $docAction, $docRemark, $model->employee->fnTh . " " . $model->employee->lnTh);
                                }
                                if ($documentWorkflowModel->groupId > 0 && $documentWorkflowModel->isFinished != 1) {
                                    $employees = GroupMember::model()->findAll("groupId=:groupId", array(
                                        ":groupId" => $documentWorkflowModel->groupId));
                                    foreach ($employees as $employee) {
                                        if ($employee->employeeId != 0) {
                                            $emp = Employee::model()->findByPk($employee->employeeId);
                                            $emailName = $emp->fnTh . "  " . $emp->lnTh;
                                            $emailEmail = $emp->email . "@daiigroup.com";
                                            $emailController->mailsend($emailName, $model->documentType->documentTypeName, $model->documentCode, $emailEmail, $model->documentId, $website, $docAction, $docRemark, $model->employee->fnTh . " " . $model->employee->lnTh);
                                        }
                                    }
                                }
                                /* if($documentWorkflowModel->isFinished == 1)
                                  { */ //Send email to creator all step
                                /* } */
                                $emailName = $model->employee->fnTh . "  " . $model->employee->lnTh;
                                $emailEmail = $model->employee->email . "@daiigroup.com";
                                $emailController->mailsend($emailName, $model->documentType->documentTypeName, $model->documentCode, $emailEmail, $model->documentId, $website, $docAction, $docRemark, $model->employee->fnTh . " " . $model->employee->lnTh);

                                $this->redirect(array(
                                    'Inbox'));
                            }
                        } else {
                            $transaction->rollback();
                        }
                    } else {
                        $transaction->rollback();
                    }
                } else {
                    $transaction->rollback();
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
                $transaction->rollback();
            }
        }
        $workflowStateModel = new WorkflowState();

        $this->render('viewOrdinate', array(
            'model' => $model,
            'documentTypeModel' => $documentTypeModel,
            'documentWorkflowModel' => $documentWorkflowModel,
            'workflowStateModel' => $workflowStateModel,
            'workflowStatus' => $workflowStatus,
            'leaveModel' => $leaveModel,
            'workflowLogModel' => $workflowLogModel,
            'currentWorkflowState' => $currentWorkflowState
        ));
    }

    public function actionCancelOrdinate($id)
    {
        $model = Document::model()->findByPk($id);
        $flag = true;

        if (isset($_POST['WorkflowLog'])) {
            if (!empty($_POST['WorkflowLog']['remarks'])) {
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    $model->status = 0;

                    //save doc
                    if ($model->save(false)) {
                        $docWorkflow = DocumentWorkflow::model()->find("documentId = :documentId", array(
                            ":documentId" => $id));
                        $docWorkflow->currentState = 0;
                        $docWorkflow->isFinished = 1;
                        $docWorkflow->employeeId = null;
                        $docWorkflow->groupId = null;
                        if ($docWorkflow->save(false)) {
                            //save leave
                            $leaveModel = Leave::model()->find('documentId=' . $id);
                            $leaveModel->status = 2;

                            if ($leaveModel->save(false)) {
                                //save workflow log
                                if (WorkflowLog::model()->saveWorkflowLog($id, -1, $_POST['WorkflowLog']['remarks'])) {
                                    $transaction->commit();
                                    //$this->redirect(Yii::app()->createUrl('document/outbox'));
                                    if (Yii::app()->request->isAjaxRequest) {
                                        echo CJSON::encode(array(
                                            'status' => 'success',
                                            'div' => "ลบเอกสารเสร็จสมบูรณ์"
                                        ));
                                        exit;
                                    }
                                }
                            }
                        }
                    }

                    $transaction->rollback();

                    if (Yii::app()->request->isAjaxRequest) {
                        echo CJSON::encode(array(
                            'status' => 'remark',
                            'div' => 'ไม่สามารถทำรายการได้กรุณาลองใหม่',
                        ));
                    }
                } catch (Exception $e) {
                    throw new Exception($e->getMessage());
                    $transaction->rollback();
                }
            } else {
                if (Yii::app()->request->isAjaxRequest) {
                    echo CJSON::encode(array(
                        'status' => 'remark',
                        'div' => 'กรุณาใส่เหตุผลในการลบหรือยกเลิกเอกสาร',
                    ));
                } else
                    $this->redirect(Yii::app()->createUrl('document/outbox'));
            }
        }
        else {
            if (Yii::app()->request->isAjaxRequest) {
                $workflowLog = new WorkflowLog();

                echo CJSON::encode(array(
                    'status' => 'failed',
                    'div' => $this->renderPartial('cancelDocument', array(
                        'model' => $model,
                        'workflowLog' => $workflowLog
                    ), true),
                ));
                exit();
            } else
                $this->redirect(Yii::app()->createUrl('document/outbox'));
        }
    }

}
