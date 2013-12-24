<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends RController {

	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout = '//layouts/cl2';

	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu = array(
	);

	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs = array(
	);
	public $breadcrumb;
	public $pageHeader;
	//Device
	public $device;

	public function writeToFile($filename, $string, $mode = 'w+') {
		$handle = fopen($filename, $mode);
		fwrite($handle, $string);
		fclose($handle);
	}

	public function lastDateOfThisMonth() {
		return date('Y-m-d', strtotime('-1 second', strtotime('+1 month', strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'))));
	}

	public function jsonEncode($res) {
		header("Cache-Control: no-cache");
		header("Pragma: no-cache");
		header("Cache-Control: no-cache, must-revalidate");
		header('Content-type: text/json');

		echo json_encode($res);
		exit();
	}

	public function dateThai($date, $format) {
		// Full month array
		$monthFormat1 = array(
			"01" => "มกราคม",
			"02" => "กุมภาพันธ์",
			"03" => "มีนาคม",
			"04" => "เมษายน",
			"05" => "พฤษภาคม",
			"06" => "มิถุนายน",
			"07" => "กรกฎาคม",
			"08" => "สิงหาคม",
			"09" => "กันยายน",
			"10" => "ตุลาคม",
			"11" => "พฤศจิกายน",
			"12" => "ธันวาคม");

		// Quick month array
		$monthFormat2 = array(
			"01" => "ม.ค.",
			"02" => "ก.พ.",
			"03" => "มี.ค.",
			"04" => "เม.ย.",
			"05" => "พ.ค.",
			"06" => "มิ.ย.",
			"07" => "ก.ค.",
			"08" => "ส.ค.",
			"09" => "ก.ย.",
			"10" => "ต.ค.",
			"11" => "พ.ย.",
			"12" => "ธ.ค.");

		$monthFormat3 = array(
			"01" => "01",
			"02" => "02",
			"03" => "03",
			"04" => "04",
			"05" => "05",
			"06" => "06",
			"07" => "07",
			"08" => "08",
			"09" => "09",
			"10" => "10",
			"11" => "11",
			"12" => "12");
		if ($date == '0000-00-00' || $date == '0000-00-00 00:00:00' || !isset($date)) {
			return "-";
		}
		$isDateTime = explode(' ', $date);
		if (count($isDateTime) == 2) {
			$timeStr = $isDateTime[1];
			$d = explode('-', $isDateTime[0]);
		} else {
			$d = explode('-', $date);
		}

		$monthFormat = null;
		if (strlen($d[1]) == 1) {
			$d[1] = str_pad($d[1], 2, "0", STR_PAD_LEFT);
		}
		if ($format == 1) {
			$monthFormat = $monthFormat1[$d[1]];
			$strReturn = $d[2] . ' ' . $monthFormat . ' ' . ($d[0] + 543);
		} else if ($format == 2) {
			$monthFormat = $monthFormat2[$d[1]];
			$strReturn = $d[2] . ' ' . $monthFormat . ' ' . ($d[0] + 543);
		} else if ($format == 3) {
			$monthFormat = $monthFormat3[$d[1]];
			$strReturn = $d[2] . '/' . $monthFormat . '/' . ($d[0] + 543);
		}

		//return $d[2].' '.(($format=1) ? $monthFormat1[$d[1]] : $monthFormat2[$d[1]]).' '.($d[0]+543);
		if (isset($timeStr)) {
			$strReturn = $strReturn . " " . $timeStr;
		}

		return $strReturn;
	}

	public function dateWithDuration($date, $duration) {
		return date('Y-m-d', strtotime($date) + $duration * 86400);
	}

}
