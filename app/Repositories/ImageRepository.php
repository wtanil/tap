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
	*	@param String $path
	*	@param String $pathLow
	*	@param String $lowResUrl
	*	@param String $highResUrl
	*	@param String $subtitle
	*	@return bool
	*/
	function create(Request $request, $path, $pathLow, $lowResUrl, $highResUrl, $subtitle) {

		$image = new Image();

		$image->project_id = $request->input('projectId');
		$image->subtitle = $subtitle;
		$image->path = $path;
		$image->path_low = $pathLow;
		$image->low_res_url = $lowResUrl;
		$image->high_res_url = $highResUrl;

		$image->save();
		return $image->id;
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

		$image->subtitle = $request->input('description');

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










