<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Yii::import('system.web.widgets.CWidget');
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata');
Zend_Loader::loadClass('Zend_Gdata_AuthSub');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_Calendar');
Zend_Loader::loadClass('Zend_Http_Client');

class googlecalendar extends CWidget
{

	public $user;
	public $pass;
	public $service;
	public $client;
	public $eventId;
	public $newTitle;
	private $_baseUrl;

	public function login($user, $pass)
	{

		$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
		$client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
		$calenderlist = $this->outputCalendarList($client);
		$events = $this->outputCalendar($client);
		$calendardate = $this->outputCalendarByDateRange($client, $startDate = '2011-05-01', $endDate = '2011-06-01');
		//$update = $this->updateEvent($client, '49ol78ma48ko3rl6ua6d4hhr70', 'New Years Party');
		//$this->deleteEventById($client, 'jbjf1jdpjiorau3bfs57attg44');
		$this->render('view', array(
			'calenderlist'=>$calenderlist,
//			'update'=>$update,
			'events'=>$events,
//			'calendardate'=>$calendardate
		));
		if(isset($_POST['submit']))
		{
			$title = $_POST['createevent'];
			$startDate = $_POST['startdate'];
			$desc = $_POST['desc'];
			$where = $_POST['where'];
			$startTime = '01:00';
			$endDate = $_POST['enddate'];
			$endTime = '02:00';
			$tzOffset = '-08';
			if(strlen($title) == '')
			{
				$title = 'no title';
			}
			if(($startDate != '') && ($endDate != ''))
			{
				$createevent = $this->createEvent($client, $title, $desc, $where, $startDate, $startTime, $endDate, $endTime, $tzOffset);
			}
			if(isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on')
			{
				$protocol = 'https://';
			}
			else
			{
				$protocol = 'http://';
			}
			$url = $protocol .
				Yii::app()->getRequest()->serverName .
				Yii::app()->getRequest()->requestUri;
			header('Location:' . $url);
		}
		if(isset($_POST['update']))
		{
			$new_title = $_POST['updateeevent'];
			$id = $_POST['id'];
			if($new_title != '')
			{
				$this->updateEvent($client, $id, $new_title);
			}
			if(isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on')
			{
				$protocol = 'https://';
			}
			else
			{
				$protocol = 'http://';
			}
			$url = $protocol .
				Yii::app()->getRequest()->serverName .
				Yii::app()->getRequest()->requestUri;
			header('Location:' . $url);
		}
		if(isset($_POST['delete']))
		{

			$id = $_POST['id'];
			$this->deleteEventById($client, $id);
			if(isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on')
			{
				$protocol = 'https://';
			}
			else
			{
				$protocol = 'http://';
			}
			$url = $protocol .
				Yii::app()->getRequest()->serverName .
				Yii::app()->getRequest()->requestUri;
			header('Location:' . $url);
		}
	}

	public function init()
	{
		// GET RESOURCE PATH
		$resources = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'resources';
		$this->_baseUrl = Yii::app()->assetManager->publish($resources);
		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile($this->_baseUrl . '/jquery/jquery-1.5.2.min.js');
		$cs->registerScriptFile($this->_baseUrl . '/jquery/jquery-ui-1.8.11.custom.min.js');
		$cs->registerScriptFile($this->_baseUrl . '/jquery/jquery.qtip-1.0.0-rc3.js');
		$cs->registerScriptFile($this->_baseUrl . '/jquery/jquery.qtip-1.0.0-rc3.min.js');
		$cs->registerScriptFile($this->_baseUrl . '/jquery/jquery.qtip.debug-1.0.0-rc3.js');
		$cs->registerScriptFile($this->_baseUrl . '/jquery/fullcalendar.min.js');
		$cs->registerScriptFile($this->_baseUrl . '/jquery/jquery.bubblepopup.v2.3.1.min.js');
//
		// REGISTER CSS
		$cs->registerCssFile($this->_baseUrl . '/css/fullcalendar.css');
		$cs->registerCssFile($this->_baseUrl . '/css/jquery.bubblepopup.v2.3.1.css');
		$cs->registerCssFile($this->_baseUrl . '/css/fullcalendar.print.css');
	}

	public function outputCalendarList($client)
	{
		$gdataCal = new Zend_Gdata_Calendar($client);
		$calFeed = $gdataCal->getCalendarListFeed();
		return $calFeed;
	}

	function outputCalendar($client)
	{
		$gdataCal = new Zend_Gdata_Calendar($client);
		$query = $gdataCal->newEventQuery();
		$query->setUser('default');
		$query->setVisibility('private');
		$query->setProjection('full');
		$query->setOrderby('starttime');
		$query->setFutureevents(true);
		$eventFeed = $gdataCal->getCalendarEventFeed($query);
		return $eventFeed;
	}

	function outputCalendarByDateRange($client, $startDate = '2011-05-01', $endDate = '2011-06-01')
	{
		$gdataCal = new Zend_Gdata_Calendar($client);
		$query = $gdataCal->newEventQuery();
		$query->setUser('default');
		$query->setVisibility('private');
		$query->setProjection('full');
		$query->setOrderby('starttime');
		$query->setStartMin($startDate);
		$query->setStartMax($endDate);
		$eventFeed = $gdataCal->getCalendarEventFeed($query);
		return $eventFeed;
	}

	function createEvent($client, $title, $desc, $where, $startDate, $startTime, $endDate, $endTime, $tzOffset)
	{
		$gdataCal = new Zend_Gdata_Calendar($client);
		$newEvent = $gdataCal->newEventEntry();

		$newEvent->title = $gdataCal->newTitle($title);
		$newEvent->where = array(
			$gdataCal->newWhere($where));
		$newEvent->content = $gdataCal->newContent("$desc");

		$when = $gdataCal->newWhen();
		$when->startTime = "{$startDate}T{$startTime}:00.000{$tzOffset}:00";
		$when->endTime = "{$endDate}T{$endTime}:00.000{$tzOffset}:00";
		$newEvent->when = array(
			$when);
		$createdEvent = $gdataCal->insertEvent($newEvent);
		return $createdEvent->id->text;
	}

	public function getEvent($client, $eventId)
	{
		$gdataCal = new Zend_Gdata_Calendar($client);
		$query = $gdataCal->newEventQuery();
		$query->setUser('default');
		$query->setVisibility('private');
		$query->setProjection('full');
		$query->setEvent($eventId);
		try
		{
			$eventEntry = $gdataCal->getCalendarEventEntry($query);
			return $eventEntry;
		}
		catch(Zend_Gdata_App_Exception $e)
		{
			var_dump($e);
			return null;
		}
	}

	public function updateEvent($client, $eventId, $newTitle)
	{
		$gdataCal = new Zend_Gdata_Calendar($client);
		$eventOld = $this->getEvent($client, $eventId);
		if($eventOld)
		{
			$eventOld->title = $gdataCal->newTitle($newTitle);
			try
			{
				$eventOld->save();
			}
			catch(Zend_Gdata_App_Exception $e)
			{
				var_dump($e);
				return null;
			}
			$eventNew = $this->getEvent($client, $eventId);
			return $eventNew;
		}
		else
		{
			return null;
		}
	}

	function deleteEventById($client, $paramid)
	{
		$event = $this->getEvent($client, $paramid);
		$event->delete();
	}

//    function newReminders($client) {
//        $gdatacal = new Zend_Gdata_Calendar($client);
//        $eventOld = $this->getEvent($client, $eventId);
//        if ($eventOld) {
//            echo $eventOld;
//        }
//    }
}

?>
