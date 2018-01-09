<?php

class Menu extends Eloquent {

	protected $table = 'menu';

	public $timestamps = false;


	public function recepie() {
        return $this->hasMany('MenuItem');
    }

}