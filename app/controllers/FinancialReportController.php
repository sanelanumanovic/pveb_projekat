<?php

class FinancialReportController extends BaseController
{

    public function index()
    {

        $data = [];
        return View::make("financies.index", $data);

    }

    public function generateReport() {
        $data = Input::all();

        $rules = array(
            'reportType' => 'required',
            'toDate' => 'required',
            'fromDate' => 'required'
        );

        $validator = Validator::make($data, $rules);

        if ($validator->passes()) {

            $reportType = Input::get('reportType');
            $toDate = Input::get('toDate');
            $fromDate = Input::get('fromDate');
            $timeType = Input::get('timeType');
            $timeSubType = Input::get('timeSubType');
            $year = Input::get('year');

            switch ($timeType) {
            	case '1':
            		$fromDate = $this->calculateFromDate(1, $fromDate, null, null);
            		$toDate = $this->calculateToDate(1, $toDate, null, null);
            		break;
        		case '2':
        			$fromDate = $this->calculateFromDate(2, $fromDate, $timeSubType, null);
        			$toDate = $this->calculateToDate(2, $toDate, $timeSubType, null);
        			break;
    			case '3':
    				$fromDate = $this->calculateFromDate(3, $fromDate, null, $year);
    				$toDate = $this->calculateToDate(3, $toDate, null, $year);
    				break;
				case '4':
					$fromDate = $this->calculateFromDate(4, $fromDate, null, null);
					$toDate = $this->calculateToDate(4, $toDate, null, null);
					break;
				default:
					return View::make("financies.index")->with('data', $inputData)
	                    ->with('message', 'Neispravan unos!');
            }

            if ($fromDate != null && $toDate != null && $fromDate > $toDate) {
                return View::make("financies.index")->with('data', $data)
                    ->with('message', 'Neispravan vremenski interval!');
            }

            switch ($reportType) {
	            case '1':
	            	$fromDate = $this->calculateFromDate(1, $fromDate, null, null);
	                $modelData = $this->revenues($fromDate, $toDate);
	                $title = 'Prihodi ';
	                $emptyResult = 'Ne postoje prihodi za traženi period.';
	                break;
	            case '2':
	                $modelData = $this->expenditures($fromDate, $toDate);
	                $title = 'Rashodi ';
	                $emptyResult = 'Ne postoje rashodi za traženi period.';
	                break;
	            case '3':
	                $modelData = $this->all($fromDate, $toDate);
	                $title = 'Prihodi i rashodi ';
	                $emptyResult = 'Ne postoje prihodi i rashodi za traženi period.';
	                break;
	            default:
	                return View::make("financies.index")->with('data', $inputData)
	                    ->with('message', 'Neispravan unos!');
	        }

	        return View::make("financies.report")->with('modelData', $modelData)
	            ->with('toDate', $toDate)
	            ->with('reportType', $reportType)
	            ->with('fromDate', $fromDate)
	            ->with('title', $title)
	            ->with('emptyResult', $emptyResult);
           
        } else {
            return View::make("financies.index")->with('data', $data)
                ->with('message', 'Neispravni podaci!');
        }

    }

    public function plotGraph($fromDate, $toDate, $reportType, $title) {
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
                return View::make("financies.index")->with('data', $reportType)
                    ->with('message', 'Neispravan unos!');
        }
        return View::make("financies.reportgraph")->with('modelData', $modelData)
            ->with('toDate', $toDate)
            ->with('reportType', $reportType)
            ->with('fromDate', $fromDate)
            ->with('title', $title);


    }

    public function downloadExcelDocument($fromDate, $toDate, $reportType, $title) {
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
                return View::make("financies.reportpie")->with('data', $reportType)
                    ->with('message', 'Neispravan unos!');
        }

        Excel::load('finansijski_izvestaj.xlsx', function ($excel) use ($modelData) {
            $i = 2;
            foreach ($modelData as $md) {
                $excel->getActiveSheet()->setCellValue('A' . $i, $md->info);
                $excel->getActiveSheet()->setCellValue('B' . $i, $md->id);
                $excel->getActiveSheet()->setCellValue('C' . $i, date('d.m.Y.', strtotime($md->date)));
                $excel->getActiveSheet()->setCellValue('D' . $i, $md->total);

                $i = $i + 1;
            }
        })->setFileName('finansijski_izvestaj__' . $fromDate . '__' . $toDate)->download('xlsx');

    }

    public function drawPieChart($fromDate, $toDate, $reportType, $title)  {
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
                return View::make("financies.index")->with('data', $reportType)
                    ->with('message', 'Neispravan unos!');
        }


        return View::make("financies.reportpie")
            ->with('modelData', $modelData)
            ->with('toDate', $toDate)
            ->with('reportType', $reportType)
            ->with('fromDate', $fromDate)
            ->with('title', $title);
    }

   	private function calculateFromDate($timeType, $fromDate, $timeSubType, $year) {
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
            	$time = strtotime('01/01/'.$year);
				return date('Y-m-d',$time);
            case '4':
            	return null;
        }
   	}

   	private function calculateToDate($timeType, $toDate, $timeSubType, $year) {
   		switch ($timeType) {
            case '1':
                return $toDate;
            case '2':
               return  date("Y-m-d", strtotime('+0 day'));
            case '3':
            	$time = strtotime('12/31/'.$year);
				return date('Y-m-d',$time);
            case '4':
            	return null;
        }
   	}

    private function expenditures($fromDate, $toDate) {
        $inventories = DB::table('procurements')->where('completion_date', '>=', $fromDate)
            ->where('completion_date', '<=', $toDate)
            ->join('procurement_inventory_items', 'procurement_id', '=', 'id')
            ->select(DB::raw('id, sum(procurement_inventory_items.price * procurement_inventory_items.quantity) as total, completion_date as date, "Nabavka inventara" as info'))
            ->groupBy('id');

        $ingredients = DB::table('procurements')->where('completion_date', '>=', $fromDate)
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
    	if ($fromDate != null && $toDate != null) {
	        $online_deliveries = DB::table('online_deliveries')->join('orders', 'online_deliveries.order_id', '=', 'orders.id')
	            ->where('completion_date', '>=', $fromDate)
	            ->where('completion_date', '<=', $toDate)
	            ->join('order_products', 'order_products.order_id', '=', 'orders.id')
	            ->join('menu', 'menu.id', '=', 'order_products.menu_id')
	            ->select(DB::raw('orders.id as id, sum(menu.price * order_products.quantity) as total, completion_date as date, "Online porudžbina" as info'))
	            ->groupBy('orders.id');
        } else {
        	$online_deliveries = DB::table('online_deliveries')->join('orders', 'online_deliveries.order_id', '=', 'orders.id')
	            ->join('order_products', 'order_products.order_id', '=', 'orders.id')
	            ->join('menu', 'menu.id', '=', 'order_products.menu_id')
	            ->select(DB::raw('orders.id as id, sum(menu.price * order_products.quantity) as total, completion_date as date, "Online porudžbina" as info'))
	            ->groupBy('orders.id');
	        }

        $idForOnlineOrder = array_map(create_function('$o', 'return $o->id;'), $online_deliveries->get());

        if ($fromDate != null && $toDate != null) {
	        $orders = DB::table('orders')->whereNotIn('orders.id', $idForOnlineOrder)
	            ->where('completion_date', '>=', $fromDate)
	            ->where('completion_date', '<=', $toDate)
	            ->join('order_products', 'order_id', '=', 'id')
	            ->join('menu', 'menu.id', '=', 'menu_id')
	            ->select(DB::raw('orders.id as id, sum(menu.price * order_products.quantity) as total, completion_date as date, "Porudžbina" as info'))
	            ->groupBy('orders.id');
        } else {
        	$orders = DB::table('orders')->whereNotIn('orders.id', $idForOnlineOrder)
	            ->join('order_products', 'order_id', '=', 'id')
	            ->join('menu', 'menu.id', '=', 'menu_id')
	            ->select(DB::raw('orders.id as id, sum(menu.price * order_products.quantity) as total, completion_date as date, "Porudžbina" as info'))
	            ->groupBy('orders.id');
        }

        return $online_deliveries->union($orders)->distinct()->orderBy('date')->get();
    }

    private function all($fromDate, $toDate) {
        return array_merge($this->revenues($fromDate, $toDate), $this->expenditures($fromDate, $toDate));
    }

    public function getShow($id) {

    }

}