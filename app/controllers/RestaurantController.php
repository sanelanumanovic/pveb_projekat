<?php

class RestaurantController extends BaseController {

	public function getIndex() {
		return View::make('restaurant.index');
	}


}