<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $table = 'projects';

    protected $dates = [
        'created_at',
        'updated_at',
        'project_date'
    ];

    /**
     * Get the images for the project
    */
    public function images() {

        return $this->hasMany('App\Image', 'project_id', 'id');

    }

    /**
     * Get the thumbnail for the project
    */
    public function thumbnail() {

        // return $this->belongsTo('App\Image', 'thumbnail_id', 'id');

        return $this->hasOne('App\Image', 'id', 'thumbnail_id');

    }

    /**
     * Get the records for the user
    */
    public function category() {

        return $this->belongsTo('App\Category', 'category_id', 'id');

    }

}
