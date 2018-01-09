<?php

class Procurement extends Eloquent {

	protected $table = 'procurements';

	public $timestamps = false;

	protected $fillable = array('creation_date', 'completion_date', 'termination_date', 'termination_note');

	public function user() {
        return $this->belongsTo('User');
    }

    public function supplier() {
        return $this->belongsTo('Supplier');
    }

}