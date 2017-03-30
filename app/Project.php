<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $table = 'projects';

    /**
     * Get the records for the images
    */
    public function images() {

        return $this->hasMany('App\Image', 'project_id', 'id');

    }

    /**
     * Get the records for the user
    */
    public function thumbnail() {

        return $this->belongsTo('App\Image', 'thumbnail_id', 'id');

        // return $this->hasOne('App\Image', 'thumbnail_id', 'id');

    }

    /**
     * Get the records for the user
    */
    public function category() {

        return $this->belongsTo('App\Category', 'category_id', 'id');

    }

}
