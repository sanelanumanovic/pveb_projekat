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
        if($fromDate != null && $toDate != null){
            $whereLine = "orders.status = '1' AND orders.completion_date > '{$fromDate}' AND orders.completion_date < '{$toDate}'";
        } else {
            $whereLine = "orders.status = '1'";
        }
        $data = DB::select("SELECT menu.name, SUM(IF(online_deliveries.id IS NOT NULL, 1, 0)) as online_no,  SUM(IF(online_deliveries.id IS NOT NULL, 0, 1)) as offline_no
                FROM menu JOIN order_products ON menu.id = order_products.menu_id JOIN orders ON order_products.order_id = orders.id LEFT OUTER JOIN online_deliveries ON online_deliveries.order_id = orders.id 
                WHERE {$whereLine}
                GROUP BY menu.name");

        return View::make('menu.graph')->with("data", $data)->with('toDate', $toDate)
            ->with('fromDate', $fromDate);
    }
}