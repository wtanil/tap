<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\ProjectInterface;
use App\Contracts\ImageInterface;
use App\Http\Requests\UpdateImageRequest;
use App\Http\Requests\StoreImageRequest;
use Intervention\Image\Facades\Image as ImageIntervention;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{

    /**
     * The project repository instance
     *
     * @var ProjectInterface
     */
    protected $project;

    /**
     * The image repository instance
     *
     * @var ImageInterface
     */
    protected $image;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProjectInterface $project, ImageInterface $image)
    {
        $this->middleware('auth');
        $this->project = $project;
        $this->image = $image;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $tmpProject = $this->project->forId($id);
        $tmpImages = $this->project->getImages($id);
        return view('images.index', [
            'project' => $tmpProject,
            'images' => $tmpImages
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $tmpProject = $this->project->forId($id);
        return view('images.create', [
            'project' => $tmpProject
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImageRequest $request, $id)
    {
        $baseImageName = time() . '-' . pathinfo($request->file('uploadedImage')->getClientOriginalName(), PATHINFO_FILENAME);
        $baseImageExtension = '.' . $request->file('uploadedImage')->getClientOriginalExtension();
        $highResImageName = $baseImageName . $baseImageExtension;
        $lowResImageName = $baseImageName . '-low' . $baseImageExtension;

        $path = $request->file('uploadedImage')->storeAs('public/img', $highResImageName);        
        $highResUrl = url('/') . '/storage/' . $path;

        Storage::copy($path, 'public/img/'. $lowResImageName);

        $maxWidth = 300;
        $maxHeight = 300;

        $lowResImage = ImageIntervention::make('storage/public/img/'. $lowResImageName);
        if ($lowResImage->width() > $lowResImage->height()) {
            $maxHeight = null;
        } else {
            $maxWidth = null;
        }
        $lowResImage->resize($maxWidth, $maxHeight, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $lowResImage->save();
        $lowResUrl = url('/') . '/storage/public/img/' . $lowResImageName;

        $createdId = $this->image->create($request, $path, $lowResUrl, $highResUrl);

        return redirect('/project/' . $id . '/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($projectId, $imageId)
    {
        $tmpProject = $this->project->forId($projectId);
        $tmpImage = $this->image->forId($imageId);
        
        return view('images.edit', [
            'project' => $tmpProject,
            'image' => $tmpImage,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImageRequest $request, $projectId, $imageId)
    {
        $this->image->update($request, $imageId);

        return redirect('/project/' . $projectId . '/images/' . $imageId . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $projectId
     * @param  int  $imageId
     * @return \Illuminate\Http\Response
     */
    public function destroy($projectId, $imageId)
    {
        $tmpProject = $this->project->forId($projectId);
        $tmpImage = $this->image->forId($imageId);
        $tmpImagePath = $tmpImage->path;

        if ($tmpProject->thumbnail_id == $imageId) {

            $this->project->setThumbnail(null, $projectId);
            $this->project->setActive(0, $projectId);

            $tmpProject = $this->project->forId($projectId);

            if ($tmpProject->active == 1) {
                return redirect('/project/' . $projectId . '/edit');
            }
        }

        // TODO DELETE IMAGE MODEL

        $this->image->delete($imageId);

        // TODO DELETE IMAGE FILE

        Storage::delete($tmpImagePath);

        return redirect('/project/' . $projectId . '/edit');
    }
}


















