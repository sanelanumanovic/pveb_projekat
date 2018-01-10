<?php

class FinancialReportController extends BaseController {
 
	public function index() {

		$data = [];
		return View::make("financies.index", $data);

	}

	public function generateReport() {
		$data = Input::all();

		$rules = array (
            'reportType' => 'required',
            'toDate' => 'required',
            'fromDate' => 'required'
        );

        $validator = Validator::make ($data, $rules);
		
        if ($validator -> passes()) {
        	$reportType = Input::get('reportType');
       		$toDate = Input::get('toDate');
    		$fromDate = Input::get('fromDate');

        	$inputData = array(
				'reportType' => $reportType,
				'toDate' => date('Y-m-d', strtotime($toDate)),
				'fromDate' => date('Y-m-d', strtotime($fromDate))
			);

        	switch ($reportType) {
        		case '1':
        			$modelData = $this->revenues($fromDate, $toDate);
        			$title = 'Prihodi u periodu ';
        			break;
        		case '2':
        			$modelData = $this->expenditures($fromDate, $toDate);
        			$title = 'Rashodi u periodu ';
        			break;
        		case '3':
        			$modelData = $this->all($fromDate, $toDate);
        			$title = 'Prihodi i rashodi u periodu ';
        			break;
        		default:
        			return View::make("financies.index")->with('data', $inputData)
        												->with('message', 'Neispravan unos!');
        	}

        	return View::make("financies.report")->with('modelData', $modelData)
        										 ->with('toDate', $toDate)
        										 ->with('reportType', $reportType)
        										 ->with('fromDate', $fromDate)
        										 ->with('title', $title);
        } else {
        	return View::make("financies.index")->with('data', $data);
        }

	}

	public function downloadExcelDocument($fromDate, $toDate, $reportType) {
		switch ($reportType) {
    		case '1':
    			$modelData = $this->revenues($fromDate, $toDate);
    			break;
    		case '2':
    			$modelData = $this->expenditures($fromDate, $toDate);
    			break;
    		case '3':
    			$modelData = $this->all($fromDate, $toDate);
    			break;
    		default:
    			return View::make("financies.index")->with('data', $inputData)
    												->with('message', 'Neispravan unos!');
    	}

    	return View::make("financies.index");

	}

	private function expenditures($fromDate, $toDate) {
		$inventories = DB::table('procurements')->where('completion_date', '>=', $fromDate)
			->where('completion_date', '<=', $toDate)
			->join('procurement_inventory_items', 'procurement_id', '=', 'id')
			->select(DB::raw('id, sum(procurement_inventory_items.price * procurement_inventory_items.quantity) as total, completion_date as date, "Nabavka inventara" as info'))
			->groupBy('id');

		$ingredients =  DB::table('procurements')->where('completion_date', '>=', $fromDate)
			->where('completion_date', '<=', $toDate)
			->join('procurement_items', 'procurement_id', '=', 'id')
			->select(DB::raw('id, sum(procurement_items.price * procurement_items.quantity) as total, completion_date as date, "Nabavka namirnica" as info'))
			->groupBy('id');


		$salaries = DB::table('salaries')->where('payment_date', '>=', $fromDate)
			->where('payment_date', '<=', $toDate)
			->select(DB::raw('id, amount as total, payment_date as date, "Plata" as info'));
		
		return $inventories->union($ingredients)->union($salaries)->orderBy('date')->get();
	}

	private function revenues($fromDate, $toDate) {
		$online_deliveries = DB::table('online_deliveries')->join('orders', 'online_deliveries.order_id', '=', 'orders.id')
			->where('completion_date', '>=', $fromDate)
			->where('completion_date', '<=', $toDate)
			->join('order_products', 'order_products.order_id', '=', 'orders.id')
			->join('menu', 'menu.id', '=', 'order_products.menu_id')
			->select(DB::raw('orders.id as id, sum(menu.price * order_products.quantity) as total, completion_date as date, "Online porudžbina" as info'))
			->groupBy('orders.id');

		$idForOnlineOrder = array_map(create_function('$o', 'return $o->id;'), $online_deliveries->get());

		$orders = DB::table('orders')->whereNotIn('orders.id', $idForOnlineOrder)
			->where('completion_date', '>=', $fromDate)
			->where('completion_date', '<=', $toDate)
			->join('order_products', 'order_id', '=', 'id')
			->join('menu', 'menu.id', '=', 'menu_id')
			->select(DB::raw('orders.id as id, sum(menu.price * order_products.quantity) as total, completion_date as date, "Porudžbina" as info'))
			->groupBy('orders.id');

		return $online_deliveries->union($orders)->distinct()->orderBy('date')->get();
	}

	private function all($fromDate, $toDate) {
		return array_merge($this->revenues($fromDate, $toDate), $this->expenditures($fromDate, $toDate));
	}

	public function getShow($id) {

	}

}