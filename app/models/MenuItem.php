<?php

class MenuItem extends Eloquent {

	protected $table = 'menu_items';

	public $timestamps = false;

	protected $primaryKey = array('ingredient_id', 'menu_id'); 

    public $incrementing = false;

}