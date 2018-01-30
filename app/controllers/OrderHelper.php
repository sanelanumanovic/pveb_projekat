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
			            ->where('completion_date', '>=', $fromDate)
			            ->where('completion_date', '<=', $toDate)
			            ->join('order_products', 'order_products.order_id', '=', 'orders.id')
			            ->join('menu', 'menu.id', '=', 'order_products.menu_id')
			            ->select(DB::raw('orders.id as id, sum(menu.price * order_products.quantity) as total, completion_date as date, "Online porudžbina" as info'))
			            ->groupBy('orders.id');
        } else {
        	return DB::table('online_deliveries')->join('orders', 'online_deliveries.order_id', '=', 'orders.id')
			            ->join('order_products', 'order_products.order_id', '=', 'orders.id')
			            ->join('menu', 'menu.id', '=', 'order_products.menu_id')
			            ->select(DB::raw('orders.id as id, sum(menu.price * order_products.quantity) as total, completion_date as date, "Online porudžbina" as info'))
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
			            ->where('completion_date', '>=', $fromDate)
			            ->where('completion_date', '<=', $toDate)
			            ->join('order_products', 'order_id', '=', 'id')
			            ->join('menu', 'menu.id', '=', 'menu_id')
			            ->select(DB::raw('orders.id as id, sum(menu.price * order_products.quantity) as total, completion_date as date, "Porudžbina" as info'))
			            ->groupBy('orders.id');
        } else {
        	return DB::table('orders')->whereNotExists(function($query) {
			                $query->select(DB::raw(1))
			                      ->from('online_deliveries')
			                      ->whereRaw('orders.id = online_deliveries.order_id');
			            })
			            ->join('order_products', 'order_id', '=', 'id')
			            ->join('menu', 'menu.id', '=', 'menu_id')
			            ->select(DB::raw('orders.id as id, sum(menu.price * order_products.quantity) as total, completion_date as date, "Porudžbina" as info'))
			            ->groupBy('orders.id');
        }
	}

}