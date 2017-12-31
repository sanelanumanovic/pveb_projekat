<?php

class FinancialReportController extends BaseController {
 
	public function index() {

		$data = [];
		return View::make("financies.index", $data);

	}

	public function generateReport() {
		return View::make("financies.index", $data);
	}

}