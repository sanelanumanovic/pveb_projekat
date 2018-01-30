<?php
/**
 * Created by PhpStorm.
 * User: ognjen
 * Date: 28.1.18.
 * Time: 22.03
 */

class MenuController extends BaseController
{
    public function index() {

        $data = DB::table('menu')->select(DB::raw('id, name'))->get();

        return View::make("menu.index")->with("data", $data);

    }

    public function showGraph(){

        $filter = Input::all();
        $fromDate = DateUtil::calculateFromDate($filter["timeType"], $filter["fromDate"], $filter["timeSubType"], $filter["year"]);
        $toDate = DateUtil::calculateToDate($filter["timeType"], $filter["toDate"], $filter["timeSubType"], $filter["year"]);
        $query = DB::table('menu')->join('order_products', 'id', '=', 'order_products.menu_id')
            ->join('orders', 'order_products.order_id', '=', 'orders.id')
            ->where('orders.status', 1);

        if($fromDate != null && $toDate != null){
            $query = $query->whereBetween('orders.completion_date', array($fromDate, $toDate));
        }


        $query = $query->leftJoin('online_deliveries', 'online_deliveries.order_id', '=', 'orders.id')
        ->select(DB::raw('menu.name, SUM(IF(online_deliveries.id IS NOT NULL, 1, 0)) as online_no,  SUM(IF(online_deliveries.id IS NOT NULL, 0, 1)) as offline_no'))
        ->groupBy('menu.name');

        $data = $query->get();
        return View::make('menu.graph')->with("data", $data)->with('toDate', $toDate)
            ->with('fromDate', $fromDate);
    }
}