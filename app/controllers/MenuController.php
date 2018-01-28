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
        $data = DB::select("SELECT menu.name, orders.completion_date, IF(online_deliveries.id IS NOT NULL, true, false) as is_online FROM menu JOIN order_products ON menu.id = order_products.menu_id JOIN orders ON order_products.order_id = orders.id LEFT OUTER JOIN online_deliveries ON online_deliveries.order_id = orders.id WHERE orders.status = '1'");
        return View::make('menu.graph')->with("data", $data);
    }
}