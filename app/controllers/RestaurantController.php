<?php

class RestaurantController extends BaseController {

	public function getIndex() {
		if (Auth::check()) {
			return View::make('restaurant.index');
		} else {
			return View::make('users.signin');
		}
	}


}