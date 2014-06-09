<?php

class ReserveController extends MasterController
{

	public function actionReserve()
	{
		$errorCode = "";
		if(isset($_GET["theaterShowTimeId"]))
		{
			$reserve = new TheaterShowtimeEmployee();
			$reserveDup = TheaterShowtimeEmployee::model()->find("theaterShowtimeId = :theaterShowtimeId AND employeeId = :employeeId AND status = 1", array(
				":theaterShowtimeId"=>$_GET["theaterShowTimeId"],
				':employeeId'=>Yii::app()->user->id));
			if(!isset($reserveDup))
			{
				$showtime = TheaterShowtime::model()->findByPk($_GET["theaterShowTimeId"]);
				$noOfReserved = count(TheaterShowtimeEmployee::model()->findAll("theaterShowtimeId = :theaterShowtimeId AND status = 1", array(
						":theaterShowtimeId"=>$_GET["theaterShowTimeId"])));
				if($noOfReserved < $showtime->theater->seats)
				{
					if($this->checkNoOfReserve($showtime->showDate, Yii::app()->user->id))
					{
						$reserveQueue = TheaterShowtimeEmployee::model()->find("theaterShowtimeId = :theaterShowtimeId AND employeeId = :employeeId AND status = 2", array(
							":theaterShowtimeId"=>$_GET["theaterShowTimeId"],
							':employeeId'=>Yii::app()->user->id));
						if(isset($reserveQueue))
						{
							$reserve = $reserveQueue;
							$reserve->status = 1;
						}
						else
						{
							$reserve->reserveCode = TheaterShowtimeEmployee::model()->generateReserveCode($_GET["theaterShowTimeId"]);
							$reserve->theaterShowTimeId = $_GET["theaterShowTimeId"];
							$reserve->employeeId = Yii::app()->user->id;
						}

						if(!$reserve->save())
						{
							$errorCode = "ระบบไม่สามารถบันทึกการจองได้ในขณะนี้ กรุณาลองใหม่อีกครั้ง";
						}
						else
						{
							$emailController = new EmailSend();
							$emp = Employee::model()->findByPk(Yii::app()->user->id);
							$toName = $emp->fnTh . "  " . $emp->lnTh;
							$toEmail = $emp->email . "@daiigroup.com";
							$movieName = $showtime->movie->title;
							$showDate = $this->dateThai($showtime->showDate, 2, FALSE);
							$reservedUrl = Yii::app()->createUrl(Yii::app()->baseUrl . "/theater/reserve/myReservedList");
							$emailController->mailReserve($toEmail, $toName, $movieName, $showDate, $toName, $reservedUrl, FALSE);

							//Send Email To Manager
							$toName2 = $emp->manager->fnTh . "  " . $emp->manager->lnTh;
							$toEmail2 = $emp->manager->email . "@daiigroup.com";
							$emailController->mailReserve($toEmail2, $toName2, $movieName, $showDate, $toName, $reservedUrl, TRUE);
						}
					}
					else
					{
						$errorCode = "ไม่สามารถทำการจองได้ เนื่องจากจองเกิน 3 ครั้ง ต่อ อาทิตย์";
						$reserve->theaterShowTimeId = $_GET["theaterShowTimeId"];
					}
				}
				else
				{
					$errorCode = "ไม่สามารถทำการจองได้ เนื่องจากที่นั่งเต็ม";
					$reserve->reserveCode = TheaterShowtimeEmployee::model()->generateReserveCode($_GET["theaterShowTimeId"]);
					$reserve->theaterShowTimeId = $_GET["theaterShowTimeId"];
					$reserve->employeeId = Yii::app()->user->id;
					$reserve->status = 2;
					if(!$reserve->save())
					{
						$errorCode = "ระบบไม่สามารถบันทึกการจองได้ในขณะนี้ กรุณาลองใหม่อีกครั้ง";
					}
				}
			}
			else
			{
				$errorCode = "ท่านเคยทำการจองไปแล้ว";
				$reserve = $reserveDup;
			}
		}
		$this->render('reserve', array(
			'reserve'=>$reserve,
			"errorCode"=>$errorCode
		));
	}

	public function actionReservedList()
	{
		$model = new TheaterShowtimeEmployee();
		if(isset($_GET["theaterShowtimeId"]))
		{
			$model->theaterShowTimeId = $_GET["theaterShowtimeId"];
		}
		$this->render('reservedList', array(
			'model'=>$model
		));
	}

	public function actionMyReservedList()
	{
		$model = new TheaterShowtimeEmployee();
		$model->employeeId = Yii::app()->user->id;
		$this->render('my_reserved_list', array(
			'model'=>$model
		));
	}

	public function actionCancel()
	{
		$flag = FALSE;
		if(isset($_GET["id"]))
		{
			$showtimeEmp = TheaterShowtimeEmployee::model()->findByPk($_GET["id"]);
		}

		if(isset($_POST["TheaterShowtimeEmployee"]))
		{
			$showtimeEmp->attributes = $_POST["TheaterShowtimeEmployee"];
			$showtimeEmp->status = 0;
			if(!isset($_POST["TheaterShowtimeEmployee"]["cancelRemark"]) || empty($_POST["TheaterShowtimeEmployee"]["cancelRemark"]))
			{
				$showtimeEmp->addError("cancelRemark", "กรุณาระบุเหตุผลในการยกเลิกการจอง");
				$flag = FALSE;
			}
			else
			{
				$flag = TRUE;
			}
			if($flag)
			{
				$noOfReserved = count(TheaterShowtimeEmployee::model()->findAll("theaterShowtimeId = :theaterShowtimeId AND status = 1", array(
						":theaterShowtimeId"=>$showtimeEmp->theaterShowTimeId)));
				if($showtimeEmp->save())
				{

					$flag = TRUE;
					$emailController = new EmailSend();
					$emp = Employee::model()->findByPk(Yii::app()->user->id);
					$toName = $emp->fnTh . "  " . $emp->lnTh;
					$toEmail = $emp->email . "@daiigroup.com";
					$movieName = $showtimeEmp->showtime->movie->title;
					$showDate = $this->dateThai($showtimeEmp->showtime->showDate, 2, FALSE);
					$reservedUrl = Yii::app()->createUrl(Yii::app()->baseUrl . "/theater/reserve/myReservedList");
					$emailController->mailReserve($toEmail, $toName, $movieName, $showDate, $toName, $reservedUrl, FALSE, TRUE, $_POST["TheaterShowtimeEmployee"]["cancelRemark"]);

					//Send Email To Manager
					$toName2 = $emp->manager->fnTh . "  " . $emp->manager->lnTh;
					$toEmail2 = $emp->manager->email . "@daiigroup.com";
					$emailController->mailReserve($toEmail2, $toName2, $movieName, $showDate, $toName, $reservedUrl, TRUE, TRUE);

					if($noOfReserved == $showtimeEmp->showtime->theater->seats)
					{
						$thShowtime = TheaterShowtimeEmployee::model()->findAll("theaterShowtimeId = :theaterShowtimeId AND status = 2", array(
							":theaterShowtimeId"=>$showtimeEmp->theaterShowTimeId));

						foreach($thShowtime as $item)
						{
							$toName3 = $item->employee->fnTh . "  " . $item->employee->lnTh;
							$toEmail3 = $item->employee->email . "@daiigroup.com";
							$emailController->mailReserve($toEmail3, $toName3, $movieName, $showDate, $toName, $reservedUrl, TRUE, TRUE, NULL, TRUE);
						}
					}
				}
			}
		}
		$this->render("cancel", array(
			'flag'=>$flag,
			'reserve'=>$showtimeEmp));
	}

	public function checkNoOfReserve($showTime, $employeeId)
	{
//		$showTime = "2014-05-21";
		$showTimeArray = explode("-", $showTime);
		$maximunToWatch = 3; // Settind From Requirement of HR
		$mondayDayOfWeek = 1;
		$fridayDayOfWeek = 5;
		$dayofweek = date('w', strtotime($showTime));

		$startWeek = date("Y-m-d", mktime(0, 0, 0, $showTimeArray[1], $showTimeArray[2] + ($mondayDayOfWeek - $dayofweek), $showTimeArray[0]));
		$endWeek = date("Y-m-d", mktime(0, 0, 0, $showTimeArray[1], $showTimeArray[2] + ($fridayDayOfWeek - $dayofweek), $showTimeArray[0]));

		$countOldReserveWeek = TheaterShowtimeEmployee::model()->countReserveInWeek($startWeek, $endWeek, $employeeId);
		if($countOldReserveWeek >= $maximunToWatch)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

}
