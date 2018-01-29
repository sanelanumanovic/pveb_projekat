<?php
use Barryvdh\DomPDF\Facade as PDF;
class ProcurementController extends BaseController {

	public function index() {
		$allSuppliers = Supplier::all();

		$suppliers = [];
		foreach ($allSuppliers as $s) {
			$suppliers[$s->id] = $s->name;
		}

		return View::make("procurements.index")->with("suppliers", $suppliers);

	}

	public function procurementsBySupplierAndDate() {
		$supplierId = Input::get('supplierId');
		$supplier = Supplier::find($supplierId);

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

        $modelData = $this->procurementsBySupIdAndDate($fromDate, $toDate, $supplierId);

        if ($timeType == '4') {
            $dates = array_map(create_function('$o', 'return $o->date;'), $modelData);
            $fromDate = min($dates);
            $toDate = max($dates);
        }

		$title = 'Nabavke od dobavljača "'.$supplier->name.'" ';
	    $emptyResult = 'Ne postoje nabavke za traženi period.';

		return View::make("procurements.bySupplier")->with('modelData', $modelData)
            ->with('toDate', $toDate)
            ->with('supplier', $supplier)
            ->with('fromDate', $fromDate)
            ->with('emptyResult', $emptyResult)
            ->with('title', $title);
		
	}

	private function procurementsBySupIdAndDate($fromDate, $toDate, $supplierId) {
		if ($fromDate != null && $toDate != null) {
            $inventories = DB::table('procurements')->where('supplier_id', $supplierId)
            	->where('completion_date', '>=', $fromDate)
                ->where('completion_date', '<=', $toDate)
                ->join('procurement_inventory_items', 'procurement_id', '=', 'id')
                ->select(DB::raw('id, sum(procurement_inventory_items.price * procurement_inventory_items.quantity) as total, completion_date as date, "Nabavka inventara" as info'))
                ->groupBy('id');
        } else {
            $inventories = DB::table('procurements')->join('procurement_inventory_items', 'procurement_id', '=', 'id')->where('supplier_id', $supplierId)
                ->select(DB::raw('id, sum(procurement_inventory_items.price * procurement_inventory_items.quantity) as total, completion_date as date, "Nabavka inventara" as info'))
                ->groupBy('id');
        }

        if ($fromDate != null && $toDate != null) {
            $ingredients = DB::table('procurements')->where('supplier_id', $supplierId)
            	->where('completion_date', '>=', $fromDate)
                ->where('completion_date', '<=', $toDate)
                ->join('procurement_items', 'procurement_id', '=', 'id')
                ->select(DB::raw('id, sum(procurement_items.price * procurement_items.quantity) as total, completion_date as date, "Nabavka namirnica" as info'))
                ->groupBy('id');
        } else {
            $ingredients = DB::table('procurements')->join('procurement_items', 'procurement_id', '=', 'id')->where('supplier_id', $supplierId)
                ->select(DB::raw('id, sum(procurement_items.price * procurement_items.quantity) as total, completion_date as date, "Nabavka namirnica" as info'))
                ->groupBy('id');
        }

        return $inventories->union($ingredients)->orderBy('date')->get();
    }

    public function downloadExcelDocument($fromDate, $toDate, $supplierId) {

        try {
            $modelData = $this->procurementsBySupIdAndDate($fromDate, $toDate, $supplierId);
        } catch (Exception $e) {
            return View::make("procurements.index")->with('message', $e->getMessage());
        }

        $supplier = Supplier::find($supplierId);

        Excel::load('nabavke.xlsx', function ($excel) use ($modelData) {
            $i = 2;
            foreach ($modelData as $md) {
                $excel->getActiveSheet()->setCellValue('A' . $i, $md->info);
                $excel->getActiveSheet()->setCellValue('B' . $i, $md->id);
                $excel->getActiveSheet()->setCellValue('C' . $i, date('d.m.Y.', strtotime($md->date)));
                $excel->getActiveSheet()->setCellValue('D' . $i, $md->total);

                $i = $i + 1;
            }
        })->setFileName('nabavke__' . $supplier->name . '__' . $fromDate . '__' . $toDate)->download('xlsx');

    }

    public function downloadPDFDocument($fromDate, $toDate, $supplierId) {
        try {
            $modelData = $this->procurementsBySupIdAndDate($fromDate, $toDate, $supplierId);
        } catch (Exception $e) {
            return View::make("financies.index")->with('message', $e->getMessage());
        }

        $supplier = Supplier::find($supplierId);

        $pdf = PDF::loadView('procurements.pdf', ['modelData' => $modelData,'fromDate' => $fromDate,'toDate' => $toDate]);
        return $pdf->download('nabavke_' . $supplier->name . '.pdf');
    }


	public function show() {
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



}
