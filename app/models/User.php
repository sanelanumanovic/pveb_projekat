<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');
	
	protected $fillable = array('first_name', 'last_name', 'username', 'password', 'phone');

	public static $rules = array(
		'first_name' => 'required|min:2|alpha',
		'last_name' => 'required|min:2|alpha',
		'personal_number' => 'required|num|length:13',
		'password' => 'required|alpha_num|between:4,16|confirmed',
		'password_confirmation' => 'required|alpha_num|between:4,16',
		'email' => 'required|email|unique:users',
		'phone' => 'num|between:9,12',
        'admin' => 'integer|required',
        'supervisor_id' => 'integer'
	);


	public function procurements() {
        return $this->hasMany('Procurement');
    }


	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier() {
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword() {
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken() {
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value) {
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName() {
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail() {
		return $this->email;
	}
}