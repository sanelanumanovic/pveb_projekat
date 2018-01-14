<?php


class UserController extends BaseController {


	public function getSignin() {
		return View::make('users/signin');
	}


	public function postSignin() {
        $user = User::Where('username', Input::get('username'))->first();

        if ($user && Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')))) {
			return Redirect::to('/');
		}
		
		return Redirect::to('users/signin')->with('message', 'Korisničko ime i/ili šifra su neispravni!');
	}


	public function getSignout() {
		Auth::logout();
		return Redirect::to('users/signin');
	}

	}