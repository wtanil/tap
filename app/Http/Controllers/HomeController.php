<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\ProjectInterface;
use App\Contracts\CategoryInterface;
use App\Contracts\ImageInterface;


// use App\Http\Requests;
// use App\Http\Requests\StoreCategoryRequest;
// use App\Http\Requests\UpdateCategoryRequest;
// use App\Project;
// use App\Category;
// use App\Contracts\CategoryRepositoryInterface;
// use App\Contracts\ProductRepositoryInterface;

class HomeController extends Controller
{

    /**
     * The project repository instance
     *
     * @var ProjectInterface
     */
    protected $project;
    protected $category;
    protected $image;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProjectInterface $project, CategoryInterface $category, ImageInterface $image)
    {
        $this->middleware('auth');
        $this->project = $project;
        $this->category = $category;
        $this->image = $image;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allProject = $this->project->all();
        return view('home', ['projects' => $allProject]);

    }


}













