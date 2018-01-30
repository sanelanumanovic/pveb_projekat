<?php


class OrderHelper {

	public static function getAllOrdersByInterval($fromDate, $toDate) {
		$online_orders = OrderHelper::getAllOnlineOrdersByInterval($fromDate, $toDate);
		$restaurant_orders = OrderHelper::getAllRestaurantOrdersByInterval($fromDate, $toDate);
		
		return $online_orders->union($restaurant_orders)->distinct()->orderBy('date')->get();
	}

	private static function getAllOnlineOrdersByInterval($fromDate, $toDate) {
		if ($fromDate != null && $toDate != null) {
	        return  DB::table('online_deliveries')->join('orders', 'online_deliveries.order_id', '=', 'orders.id')
			            ->whereBetween('completion_date', array($fromDate, $toDate))
			            ->select(DB::raw('orders.id as id, orders.total as total, completion_date as date, "Online porudžbina" as info'))
			            ->groupBy('orders.id');
        } else {
        	return DB::table('online_deliveries')->join('orders', 'online_deliveries.order_id', '=', 'orders.id')
			            ->select(DB::raw('orders.id as id, orders.total as total, completion_date as date, "Online porudžbina" as info'))
			            ->groupBy('orders.id');
        }
	}

	private static function getAllRestaurantOrdersByInterval($fromDate, $toDate) {
		 if ($fromDate != null && $toDate != null) {
	        return DB::table('orders')->whereNotExists(function($query) {
			                $query->select(DB::raw(1))
			                      ->from('online_deliveries')
			                      ->whereRaw('orders.id = online_deliveries.order_id');
			            })
			            ->whereBetween('completion_date', array($fromDate, $toDate))
			            ->select(DB::raw('orders.id as id, orders.total as total, completion_date as date, "Porudžbina" as info'))
			            ->groupBy('orders.id');
        } else {
        	return DB::table('orders')->whereNotExists(function($query) {
			                $query->select(DB::raw(1))
			                      ->from('online_deliveries')
			                      ->whereRaw('orders.id = online_deliveries.order_id');
			            })
			            ->select(DB::raw('orders.id as id, orders.total as total, completion_date as date, "Porudžbina" as info'))
			            ->groupBy('orders.id');
        }
	}

}