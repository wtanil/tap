<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	protected $table = 'categories';

    /**
     * Get the projects for the category
    */
    public function projects() {

        return $this->hasMany('App\Project', 'category_id', 'id');

    }
}
