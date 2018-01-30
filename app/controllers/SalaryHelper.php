<?php


class SalaryHelper {

	public static function getAllSalariesByInterval($fromDate, $toDate) {
		if ($fromDate != null && $toDate != null) {
			return $salaries = DB::table('salaries')->where('payment_date', '>=', $fromDate)
									                ->where('payment_date', '<=', $toDate)
									                ->select(DB::raw('id, amount as total, payment_date as date, "Plata" as info'));
        } else {
            return DB::table('salaries')->select(DB::raw('id, amount as total, payment_date as date, "Plata" as info'));
        }

	}

}