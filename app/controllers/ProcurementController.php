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
        		$fromDate = DateUtil::calculateFromDate(1, $fromDate, null, null);
        		$toDate = DateUtil::calculateToDate(1, $toDate, null, null);
        		break;
    		case '2':
    			$fromDate = DateUtil::calculateFromDate(2, $fromDate, $timeSubType, null);
    			$toDate = DateUtil::calculateToDate(2, $toDate, $timeSubType, null);
    			break;
			case '3':
				$fromDate = DateUtil::calculateFromDate(3, $fromDate, null, $year);
				$toDate = DateUtil::calculateToDate(3, $toDate, null, $year);
				break;
			case '4':
				$fromDate = DateUtil::calculateFromDate(4, $fromDate, null, null);
				$toDate = DateUtil::calculateToDate(4, $toDate, null, null);
				break;
			default:
				return View::make("financies.index")->with('data', $inputData)
                    ->with('message', 'Neispravan unos!');
        }

        if ($fromDate != null && $toDate != null && $fromDate > $toDate) {
            return View::make("financies.index")->with('data', $data)
                ->with('message', 'Neispravan vremenski interval!');
        }

        $modelData = ProcurementHelper::getAllProcurementsBySupIdAndInterval($supplierId, $fromDate, $toDate);

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


    public function downloadExcelDocument($fromDate, $toDate, $supplierId) {

        try {
            $modelData = ProcurementHelper::getAllProcurementsBySupIdAndInterval($supplierId, $fromDate, $toDate);
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
            $modelData = ProcurementHelper::getAllProcurementsBySupIdAndInterval($supplierId, $fromDate, $toDate);
        } catch (Exception $e) {
            return View::make("financies.index")->with('message', $e->getMessage());
        }

        $supplier = Supplier::find($supplierId);

        $pdf = PDF::loadView('procurements.pdf', ['modelData' => $modelData,'fromDate' => $fromDate,'toDate' => $toDate]);
        return $pdf->download('nabavke_' . $supplier->name . '.pdf');
    }


	public function show() {
	}

}
