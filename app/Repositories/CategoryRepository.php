<?php

namespace App\Repositories;

use App\Category;
use App\Contracts\CategoryInterface;

class CategoryRepository implements CategoryInterface {

	/**
	*   Get all categories
	*
	*   @return \Illuminate\Database\Eloquent\Collection
	*/
	function all() {
		return Category::all();
	}

	/**
	*	Get a category by category ID
	*
	*	@param  int  $id
	*	@return App\Category
	*/
	function forId($id) {
		return Category::find($id);
	}

}