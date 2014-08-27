<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class MasterController extends Controller
{

	public $pageTitle;
	public $brandNav = array(
		);
	public $items;
	public $total;
	public $slider;

	public function init()
	{

	}

	public function writeToFile($filename, $string, $mode = 'w+')
	{
		$handle = fopen($filename, $mode);
		fwrite($handle, $string);
		fclose($handle);
	}

	public function dateThai($date, $format, $showTime = TRUE)
	{
		// Full month array
		$monthFormat1 = array(
			"01"=>"มกราคม",
			"02"=>"กุมภาพันธ์",
			"03"=>"มีนาคม",
			"04"=>"เมษายน",
			"05"=>"พฤษภาคม",
			"06"=>"มิถุนายน",
			"07"=>"กรกฎาคม",
			"08"=>"สิงหาคม",
			"09"=>"กันยายน",
			"10"=>"ตุลาคม",
			"11"=>"พฤศจิกายน",
			"12"=>"ธันวาคม");

		// Quick month array
		$monthFormat2 = array(
			"01"=>"ม.ค.",
			"02"=>"ก.พ.",
			"03"=>"มี.ค.",
			"04"=>"เม.ย.",
			"05"=>"พ.ค.",
			"06"=>"มิ.ย.",
			"07"=>"ก.ค.",
			"08"=>"ส.ค.",
			"09"=>"ก.ย.",
			"10"=>"ต.ค.",
			"11"=>"พ.ย.",
			"12"=>"ธ.ค.");

		if($date == '0000-00-00' || $date == '0000-00-00 00:00:00')
		{
			return "-";
		}

		$isDateTime = explode(' ', $date);

		$timeStr = $isDateTime[1];
		$d = explode('-', $isDateTime[0]);

		if($format == 1)
		{
			$strReturn = $d[2] . ' ' . $monthFormat1[$d[1]] . ' ' . ($d[0] + 543);
		}
		else if($format == 2)
		{
			$strReturn = $d[2] . ' ' . $monthFormat2[$d[1]] . ' ' . ($d[0] + 543);
		}
		else if($format == 3)
		{
			$strReturn = $d[2] . '/' . $d[1] . '/' . ($d[0] + 543);
		}

		//return $d[2].' '.(($format=1) ? $monthFormat1[$d[1]] : $monthFormat2[$d[1]]).' '.($d[0]+543);
		if(isset($timeStr) && $showTime)
		{
			$strReturn = $strReturn . " " . $timeStr;
		}

		return $strReturn;
	}

	public function showShortDescription($text, $length = 200, $dots = true)
	{
		$text = trim(preg_replace('#[\s\n\r\t]{2,}#', ' ', $text));
		$text_temp = $text;
		while(substr($text, $length, 1) != " ")
		{
			$length++;
			if($length > strlen($text))
			{
				break;
			}
		}
		$text = substr($text, 0, $length);
		return $text . ( ( $dots == true && $text != '' && strlen($text_temp) > $length ) ? '...' : '');
	}

}
