<?php

class Supplier extends Eloquent {

	protected $table = 'suppliers';

	public $timestamps = false;

	protected $fillable = array();


	public function procurements() {
        return $this->hasMany('Procurement');
    }



}