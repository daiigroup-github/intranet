<?php

class MasterCActiveRecord extends CActiveRecord
{

    public $searchText;

    public $monthFormat1 = array(
        "1" => "มกราคม",
        "กุมภาพันธ์",
        "มีนาคม",
        "เมษายน",
        "พฤษภาคม",
        "มิถุนายน",
        "กรกฎาคม",
        "สิงหาคม",
        "กันยายน",
        "ตุลาคม",
        "พฤศจิกายน",
        "ธันวาคม");

    // Quick month array

    public $monthFormat2 = array(
        "1" => "ม.ค.",
        "ก.พ.",
        "มี.ค.",
        "เม.ย.",
        "พ.ค.",
        "มิ.ย.",
        "ก.ค.",
        "ส.ค.",
        "ก.ย.",
        "ต.ค.",
        "พ.ย.",
        "ธ.ค.");

    const STATUS_ACTIVE = 0x1;
    const STATUS_INACTIVE = 0x2;

    public $statusArray = array(self::STATUS_ACTIVE => 'Active',
        self::STATUS_INACTIVE => 'N/A',
    );

    public function getStatusText($status)
    {
        return $this->statusArray[$status];
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function getMonthThaiText($month, $type = 1)
    {
        return ($type == 1) ? $this->monthFormat1[$month] : $this->monthFormat2[$month];
    }
}
