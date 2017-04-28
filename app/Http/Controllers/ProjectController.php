<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\ProjectInterface;
use App\Contracts\CategoryInterface;
use App\Contracts\ImageInterface;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\StoreProjectRequest;

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
     * Create a new project instance.
     *
     * @return void
     */
    public function __construct(ProjectInterface $project, CategoryInterface $category)
    {
        $this->middleware('auth');
        $this->project = $project;
        $this->category = $category;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/');

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
        $this->project->delete($id);

        return redirect('/');
    }
}
