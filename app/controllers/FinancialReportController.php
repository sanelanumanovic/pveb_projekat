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


		$inputData = array(
			'reportType' => Input::get('reportType'),
			'toDate' => Input::get('toDate'),
			'fromDate' => Input::get('fromDate')
		);

        if ($validator -> passes()) {
        	return View::make("financies.report", $inputData);
        } else {
        	return View::make("financies.index", $data);
        }

	}

}