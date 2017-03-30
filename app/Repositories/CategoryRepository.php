<?php

namespace App\Repositories;

use App\Category;
use App\Contracts\CategoryInterface;
use Illuminate\Http\Request;

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

	/**
	*	Store a new category
	*
	*	@param \Illuminate\Http\Request $request
	*	@return bool
	*/
	function create(Request $request) {
		$category = new Category();

		$category->name = $request->input('name');

		return $category->save();
	}

	/**
	*	Update a category by ID
	*
	*	@param \Illuminate\Http\Request $request
	*	@param int $id
	*	@param int $projectId
	*	@return App\Image
	*/
	function update(Request $request, $id) {
		$category = $this->forId($id);

		$category->name = $request->input('name');

		return $category->save();
	}

	/**
	*	Delete a category by ID
	*
	*	@param int $id
	*	@return bool
	*/
	function delete($id) {
		$category = $this->forId($id);
		return $category->delete();
	}

}






