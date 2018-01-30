<?php
use Barryvdh\DomPDF\Facade as PDF;
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

            $title = GeneralHelper::getTitleByReportType($reportType);
            $emptyResult = GeneralHelper::getMessageForEmptyResult($reportType);
            $modelData = $this->getModelDataByReportType($reportType, $fromDate, $toDate);

            if ($timeType == '4') {
                $dates = array_map(create_function('$o', 'return $o->date;'), $modelData);
                $fromDate = min($dates);
                $toDate = max($dates);
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

	    try
        {
            $modelData = $this->getModelDataByReportType($reportType,$fromDate,$toDate);
        }
        catch (Exception $e)
        {
            return View::make("financies.index")->with('data', $inputData)
                ->with('message', $e->getMessage());
        }

        return View::make("financies.reportgraph")->with('modelData', $modelData)
            ->with('toDate', $toDate)
            ->with('reportType', $reportType)
            ->with('fromDate', $fromDate)
            ->with('title', $title);


    }

    public function downloadExcelDocument($fromDate, $toDate, $reportType) {

        try {
            $modelData = $this->getModelDataByReportType($reportType,$fromDate,$toDate);
        } catch (Exception $e) {
            return View::make("financies.index")->with('message', $e->getMessage());
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
	   
        $modelData = $this->getModelDataByReportType($reportType, $fromDate, $toDate);

        return View::make("financies.reportpie")
            ->with('modelData', $modelData)
            ->with('toDate', $toDate)
            ->with('reportType', $reportType)
            ->with('fromDate', $fromDate)
            ->with('title', $title);
    }

    private function expenditures($fromDate, $toDate) {
        $procurements = ProcurementHelper::getAllProcurementsByInterval($fromDate, $toDate);
        $salaries = SalaryHelper::getAllSalariesByInterval($fromDate, $toDate);
       
        return $procurements->union($salaries)->orderBy('date')->get();
    }

    private function revenues($fromDate, $toDate) {
        return OrderHelper::getAllOrdersByInterval($fromDate, $toDate);
    }

	private function getModelDataByReportType($reportType,$fromDate,$toDate)
    {
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
                throw new Exception('Neispravan unos!');
        }

        return $modelData;
    }

    public function downloadPDFDocument($fromDate, $toDate, $reportType) {
        try
        {
            $modelData = $this->getModelDataByReportType($reportType,$fromDate,$toDate);
            $title = GeneralHelper::getTitleByReportType($reportType);
        }
        catch (Exception $e)
        {
            return View::make("financies.index")->with('data', $inputData)
                ->with('message', $e->getMessage());
        }

        $pdf = PDF::loadView('financies.pdfReport',['revenues'=>$modelData,'from'=>$fromDate,'to'=>$toDate, 'title' => $title]);
        return $pdf->download('pdfReport.pdf');
    }

    private function all($fromDate, $toDate) {
		return array_merge($this->revenues($fromDate, $toDate), $this->expenditures($fromDate, $toDate));
	}

	public function getShow($id) {

	}

}