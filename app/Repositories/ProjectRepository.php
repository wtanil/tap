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
		// return Project::all();

		return Project::with(array(
			'category' => function($query) {
				$query->select('id', 'name');
			},
			'thumbnail' => function($query) {
				$query->select('id', 'project_id', 'subtitle', 'low_res_url', 'high_res_url');
			},

			))->get();
	}

	/**
	*	Get a project by ID
	*
	*	@param  int  $id
	*	@return App\Project
	*/
	function forId($id) {
		return Project::find($id);

		// return Project::with(array(
		// 	'category' => function($query) {
		// 		$query->select('id', 'name');
		// 	},
		// 	'images' => function($query) {
		// 		$query->select('id', 'project_id', 'subtitle', 'low_res_url', 'high_res_url');
		// 	},

		// 	))
		// 	->where('id', '=', $id)
		// 	->get();
	}

	/**
	*	Get project details by ID
	*
	*	@param  int  $id
	*	@return \Illuminate\Database\Eloquent\Collection
	*/
	function getDetails($id) {

		return Project::with(array(
			'category' => function($query) {
				$query->select('id', 'name');
			},
			'images' => function($query) {
				$query->select('id', 'project_id', 'subtitle', 'low_res_url', 'high_res_url');
			},

			))
			->where('id', '=', $id)
			->first();
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
	*	@return int
	*/
	function create(Request $request) {

		$project = new Project();

		$project->category_id = $request->input('categoryId');
		$project->title = $request->input('title');
		$project->project_date = $request->input('projectDate');

		$project->save();

		return $project->id;
		
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
		$project->title = $request->input('title');
		$project->project_date = $request->input('projectDate');

		return $project->save();
		
	}

	/**
	*	Set project active by ID
	*
	*	@param boolean $active
	*	@param int $id
	*	@return boolean
	*/
	function setActive($active, $id) {
		$project = $this->forId($id);

		if ($active) {
			if (is_null($project->thumbnail_id)) {
				return false;
			}
		}

		$project->active = $active;
		$project->save();

		return true;
	}

	/**
	*	Set project thumbnail by ID
	*
	*	@param int $thumbnail_id
	*	@param int $id
	*	@return boolean
	*/
	function setThumbnail($thumbnail_id, $id) {
		$project = $this->forId($id);

		$project->thumbnail_id = $thumbnail_id;
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









