<?php

namespace App\Contracts;

interface CategoryInterface {

	/**
	*   Get all categories
	*
	*   @return \Illuminate\Database\Eloquent\Collection
	*/
	function all();

	/**
	*	Get a category by category ID
	*
	*	@param  int  $id
	*	@return App\Category
	*/
	function forId($id);

}