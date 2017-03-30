<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface ProjectInterface {

	/**
	*   Get all projects
	*
	*   @return \Illuminate\Database\Eloquent\Collection
	*/
	function all();

	/**
	*	Get a project by ID
	*
	*	@param  int  $id
	*	@return App\Project
	*/
	function forId($id);

	/**
	*	Get images for project by ID
	*
	*	@param  int  $id
	*   @return \Illuminate\Database\Eloquent\Collection
	*/
	function getImages($id);

	/**
	*	Get the thumbnail for project by ID
	*
	*	@param  int  $id
	*	@return App\Image
	*/
	function getThumbnail($id);

	/**
	*	Get the category for project by ID
	*
	*	@param  int  $id
	*	@return App\Image
	*/
	function getCategory($id);

	/**
	*	Store a new project
	*
	*	@param \Illuminate\Http\Request $request
	*	@return bool
	*/
	function create(Request $request);

	/**
	*	Update project by ID
	*
	*	@param \Illuminate\Http\Request $request
	*	@param int $id
	*	@return App\Project
	*/
	function update(Request $request, $id);

	/**
	*	Set project active by ID
	*
	*	@param boolean $active
	*	@param int $id
	*	@return App\Project
	*/
	function setActive($active, $id);

	/**
	*	Delete project by ID
	*
	*	@param int $id
	*	@return bool
	*/
	function delete($id);

}






