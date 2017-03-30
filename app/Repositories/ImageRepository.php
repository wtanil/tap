<?php

namespace App\Repositories;

use App\Image;
use App\Contracts\ImageInterface;
use Illuminate\Http\Request;

class ImageRepository implements ImageInterface {

	/**
	*   Get App\Project object for ID
	*
	*	@param int $id
	*   @return App\Project
	*/
	function getProject($id) {
		return Image::find($id)->project;
	}

	/**
	*	Get a image by ID
	*
	*	@param  int  $id
	*	@return App\Image
	*/
	function forId($id) {
		return Image::find($id);
	}

	/**
	*	Store a new image
	*
	*	@param \Illuminate\Http\Request $request
	*	@param int $projectId
	*	@return bool
	*/
	function create(Request $request) {

		$image = new Image();

		$image->project_id = $request->input('projectId');
		$image->subtitle = $request->input('subtitle');
		$image->low_res_url = $request->input('lowResUrl');
		$image->high_res_url = $request->input('highResUrl');

		return $image->save();
	}

	/**
	*	Update an image by ID
	*
	*	@param \Illuminate\Http\Request $request
	*	@param int $id
	*	@return App\Image
	*/
	function update(Request $request, $id) {

		$image = $this->forId($id);

		$image->subtitle = $request->input('subtitle');

		return $image->save();

	}

	/**
	*	Delete an image by ID
	*
	*	@param int $id
	*	@return bool
	*/
	function delete($id) {

		$image = $this->forId($id);
		return $image->delete();

	}

}










