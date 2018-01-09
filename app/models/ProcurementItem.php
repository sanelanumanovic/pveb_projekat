<?php

class ProcurementItem extends Eloquent {

	protected $table = 'procurement_items';

	public $timestamps = false;

    protected $primaryKey = array('procurement_id', 'ingredient_id'); 

    public $incrementing = false;

	protected $fillable = array('quantity', 'price');

	public function procurement() {
        return $this->belongsTo('Procurement');
    }

    public function ingredient() {
        return $this->belongsTo('Ingredient');
    }

    public function measurementUnit() {
        return $this->belongsTo('MeasurementUnit');
    }


}