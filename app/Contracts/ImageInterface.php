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
	*	@param String $param
	*	@param String $low_res_url
	*	@param String $high_res_url
	*	@return bool
	*/
	function create(Request $request, $path, $low_res_url, $high_res_url);

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










