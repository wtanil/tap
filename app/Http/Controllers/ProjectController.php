<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\ProjectInterface;
use App\Contracts\CategoryInterface;
use App\Contracts\ImageInterface;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{

    /**
     * The project repository instance
     *
     * @var ProjectInterface
     */
    protected $project;

    /**
     * The category repository instance
     *
     * @var CategoryInterface
     */
    protected $category;

    /**
     * The image repository instance
     *
     * @var ImageInterface
     */
    protected $image;

    /**
     * Create a new project instance.
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
        $categories = $this->category->all();
        return view('home', [
            'currentSortId' => 0,
            'currentCategoryId' => 0,
            'projects' => $allProject,
            'categories' => $categories
            ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = $this->category->all();
        return view('project.create', [
            'categories' => $categories
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $createdId = $this->project->create($request);

        return redirect('/project/' . $createdId. '/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tmpProject = $this->project->forId($id);

        return view('project.edit', [
            'project' => $tmpProject
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $tmpProject = $this->project->forId($id);
        $tmpCategories = $this->category->all();
        $tmpThumbnail = $this->project->getThumbnail($id);
        
        return view('project.edit', [
            'project' => $tmpProject,
            'categories' => $tmpCategories,
            'thumbnail' => $tmpThumbnail,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, $id)
    {

        $this->project->update($request, $id);

        return redirect('/project/' . $id . '/edit');
    }

    /**
     * Update the status of the resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $active
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateActive($id, $active)
    {

        $this->project->setActive($active, $id);

        // return redirect('/project/' . $id . '/edit');
        // return back();
        return redirect(url()->previous() . '#project' . $id);
    }

    /**
     * Update the thumbnail of the resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateThumbnail(Request $request, $id)
    {

        $this->project->setThumbnail($request->input('thumbnailId'), $id);

        return redirect('/project/' . $id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // TODO delete all images associated to this project


        $tmpProject = $this->project->forId($id);
        $tmpImages = $this->project->getImages($id);

        foreach ($tmpImages as $tmpImage) {


            if ($tmpProject->thumbnail_id == $tmpImage->id) {

                $this->project->setThumbnail(null, $id);
                $this->project->setActive(0, $id);

            }

            $this->image->delete($tmpImage->id);

            Storage::delete($tmpImage->path);
            Storage::delete($tmpImage->path_low);
        }

        $this->project->delete($id);

        return redirect('/');
    }

    /**
     * Filter by category
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {

        $categoryId = $request->input('categoryId');
        $sortId = $request->input('sortId');

        $sortBy = 'title';
        $order = 'asc';

        if ($request->has('sortId')) {
            if ($sortId == 1) {
                $sortBy = 'title';
                $order = 'asc';
            } else if ($sortId == 2) {
                $sortBy = 'title';
                $order = 'desc';
            } else if ($sortId == 3) {
                $sortBy = 'created_at';
                $order = 'asc';
            } else if ($sortId == 4) {
                $sortBy = 'created_at';
                $order = 'desc';
            }
        }

        $allProject = $this->project->allSorted($sortBy, $order);

        if ($request->has('categoryId')) {
            $allProject = $this->category->getProjects($categoryId, $sortBy, $order);
        }
        
        $categories = $this->category->all();
        return view('home', [
            'currentSortId' => $sortId,
            'currentCategoryId' => $categoryId,
            'projects' => $allProject,
            'categories' => $categories
            ]);

    }

    /**
     * Search by title
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $allProject = $this->project->all();

        if ($request->has('searchKey')) {
            $allProject = $this->project->search($request->input('searchKey'));
        }

        $categories = $this->category->all();
        return view('home', [
            'currentSortId' => 0,
            'currentCategoryId' => 0,
            'projects' => $allProject,
            'categories' => $categories
            ]);
    }
}















