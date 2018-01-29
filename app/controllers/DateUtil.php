<?php
/**
 * Created by PhpStorm.
 * User: ognjen
 * Date: 29.1.18.
 * Time: 22.10
 */

class DateUtil
{

    public static function calculateToDate($timeType, $toDate, $timeSubType, $year)
    {
        switch ($timeType) {
            case '1':
                return $toDate;
            case '2':
                return date("Y-m-d", strtotime('+0 day'));
            case '3':
                $time = strtotime('12/31/' . $year);
                return date('Y-m-d', $time);
            case '4':
                return null;
        }
    }

    public static function calculateFromDate($timeType, $fromDate, $timeSubType, $year)
    {
        switch ($timeType) {
            case '1':
                return $fromDate;
            case '2':
                switch ($timeSubType) {
                    case '1':
                        $time = strtotime("-1 months", time());
                        return date("Y-m-d", $time);
                    case '2':
                        $time = strtotime("-3 months", time());
                        return date("Y-m-d", $time);
                    case '3':
                        $time = strtotime("-6 months", time());
                        return date("Y-m-d", $time);
                    case '4':
                        $time = strtotime("-1 year", time());
                        return date("Y-m-d", $time);
                    default:
                        var_dump('Greska!');
                        break;
                }
            case '3':
                $time = strtotime('01/01/' . $year);
                return date('Y-m-d', $time);
            case '4':
                return null;
        }
    }
}