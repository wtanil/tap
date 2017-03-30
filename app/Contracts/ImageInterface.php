<?php

namespace App\Contracts;
use Illuminate\Http\Request;

interface ImageInterface {

	/**
	*   Get App\Project object for ID
	*
	*	@param int $id
	*   @return App\Project
	*/
	function getProject($id);

	/**
	*	Get a image by ID
	*
	*	@param  int  $id
	*	@return App\Image
	*/
	function forId($id);

	/**
	*	Store a new image
	*
	*	@param \Illuminate\Http\Request $request
	*	@return bool
	*/
	function create(Request $request);

	/**
	*	Update an image by ID
	*
	*	@param \Illuminate\Http\Request $request
	*	@param int $id
	*	@return App\Image
	*/
	function update(Request $request, $id);

	/**
	*	Delete an image by ID
	*
	*	@param int $id
	*	@return bool
	*/
	function delete($id);

}










