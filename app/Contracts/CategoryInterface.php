<?php

namespace App\Contracts;

use Illuminate\Http\Request;

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

	/**
	*	Get projects for category by ID
	*
	*	@param  int  $id
	*	@param  String  $sortBy
	*	@param  String  $sortBy
	*   @return \Illuminate\Database\Eloquent\Collection
	*/
	function getProjects($id, $sortBy, $order);

	/**
	*	Store a new category
	*
	*	@param \Illuminate\Http\Request $request
	*	@return bool
	*/
	function create(Request $request);

	/**
	*	Update a category by ID
	*
	*	@param \Illuminate\Http\Request $request
	*	@param int $id
	*	@param int $projectId
	*	@return App\Image
	*/
	function update(Request $request, $id);

	/**
	*	Delete a category by ID
	*
	*	@param int $id
	*	@return bool
	*/
	function delete($id);

}