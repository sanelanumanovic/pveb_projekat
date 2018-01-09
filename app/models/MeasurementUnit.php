<?php

class MeasurementUnit extends Eloquent {

	protected $table = 'measurement_units';

	public $timestamps = false;

	protected $fillable = array('name', 'short_name');
}