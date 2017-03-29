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
	*	@param int $projectId
	*	@return bool
	*/
	function create(Request $request, $projectId);

	/**
	*	Update an image by ID
	*
	*	@param \Illuminate\Http\Request $request
	*	@param int $id
	*	@param int $projectId
	*	@return App\Image
	*/
	function update(Request $request, $id, $projectId);

	/**
	*	Delete an image by ID
	*
	*	@param int $id
	*	@param int $projectId
	*	@return bool
	*/
	function delete($id);

}










