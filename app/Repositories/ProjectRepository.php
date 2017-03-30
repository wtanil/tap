<?php

namespace App\Repositories;

use App\Project;
use App\Contracts\ProjectInterface;
use Illuminate\Http\Request;

class ProjectRepository implements ProjectInterface {

	/**
	*   Get all projects
	*
	*   @return \Illuminate\Database\Eloquent\Collection
	*/
	function all() {
		return Project::all();
	}

	/**
	*	Get a project by ID
	*
	*	@param  int  $id
	*	@return App\Project
	*/
	function forId($id) {
		return Project::find($id);
	}

	/**
	*	Get images for project by ID
	*
	*	@param  int  $id
	*   @return \Illuminate\Database\Eloquent\Collection
	*/
	function getImages($id) {
		return $this->forId($id)->images;
	}

	/**
	*	Get the thumbnail for project by ID
	*
	*	@param  int  $id
	*	@return App\Image
	*/
	function getThumbnail($id) {
		return $this->forId($id)->thumbnail;
	}

	/**
	*	Get the category for project by ID
	*
	*	@param  int  $id
	*	@return App\Image
	*/
	function getCategory($id) {
		return $this->forId($id)->category;
	}

	/**
	*	Store a new project
	*
	*	@param \Illuminate\Http\Request $request
	*	@return bool
	*/
	function create(Request $request) {

		$project = new Project();

		$project->category_id = $request->input('categoryId');
		$project->title = $request->input('title');
		$project->project_date = $request->input('projectDate');

		return $project->save();
		
	}

	/**
	*	Update project by ID
	*
	*	@param \Illuminate\Http\Request $request
	*	@param int $id
	*	@return App\Project
	*/
	function update(Request $request, $id) {

		$project = $this->forId($id);

		$project->category_id = $request->input('categoryId');
		$project->thumbnail_id = $request->input('thumbnailId');
		$project->title = $request->input('title');
		$project->project_date = $request->input('projectDate');
		$project->active = $request->input('active');

		return $project->save();
		
	}

	/**
	*	Set project active by ID
	*
	*	@param boolean $active
	*	@param int $id
	*	@return App\Project
	*/
	function setActive($active, $id) {
		$project = $this->forId($id);

		$project->active = $active;

		return $project->save();
	}

	/**
	*	Delete project by ID
	*
	*	@param int $id
	*	@return bool
	*/
	function delete($id) {
		$project = $this->forId($id);
		return $project->delete();
	}

}









