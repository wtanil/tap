<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

	protected $table = 'images';

    /**
     * Get the project that owns the image.
     */
    public function project() {

    	return $this->belongsTo('App\Project', 'project_id', 'id');

    }
}
