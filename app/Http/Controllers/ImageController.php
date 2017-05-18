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

        if ($request->hasFile('uploadedImage1')) {
            $this->processImageUpload ($request, $request->file('uploadedImage1'), $request->input('description1'));
        }

        if ($request->hasFile('uploadedImage2')) {
            $this->processImageUpload ($request, $request->file('uploadedImage2'), $request->input('description2'));
        }

        if ($request->hasFile('uploadedImage3')) {
            $this->processImageUpload ($request, $request->file('uploadedImage3'), $request->input('description3'));
        }

        if ($request->hasFile('uploadedImage4')) {
            $this->processImageUpload ($request, $request->file('uploadedImage4'), $request->input('description4'));
        }

        if ($request->hasFile('uploadedImage5')) {
            $this->processImageUpload ($request, $request->file('uploadedImage5'), $request->input('description5'));
        }

        return redirect('/project/' . $id . '/images/create');

        // foreach ($request->file('uploadedImages') as $uploadedImage) {
        //     $baseImageName = time() . '-' . pathinfo($uploadedImage->getClientOriginalName(), PATHINFO_FILENAME);
        //     $baseImageExtension = '.' . $uploadedImage->getClientOriginalExtension();
        //     $highResImageName = $baseImageName . $baseImageExtension;
        //     $lowResImageName = $baseImageName . '-low' . $baseImageExtension;

        //     $path = $uploadedImage->storeAs('public/img', $highResImageName);        
        //     $highResUrl = url('/') . '/storage/' . $path;

        //     Storage::copy($path, 'public/img/'. $lowResImageName);

        //     $maxWidth = 400;
        //     $maxHeight = 400;

        //     $lowResImage = ImageIntervention::make('storage/public/img/'. $lowResImageName);
        //     if ($lowResImage->width() > $lowResImage->height()) {
        //         $maxHeight = null;
        //     } else {
        //         $maxWidth = null;
        //     }
        //     $lowResImage->resize($maxWidth, $maxHeight, function ($constraint) {
        //         $constraint->aspectRatio();
        //         $constraint->upsize();
        //     });

        //     $lowResImage->save();
        //     $lowResUrl = url('/') . '/storage/public/img/' . $lowResImageName;

        //     $createdId = $this->image->create($request, $path, $lowResUrl, $highResUrl);

        // }

        // $baseImageName = time() . '-' . pathinfo($request->file('uploadedImage')->getClientOriginalName(), PATHINFO_FILENAME);
        // $baseImageExtension = '.' . $request->file('uploadedImage')->getClientOriginalExtension();
        // $highResImageName = $baseImageName . $baseImageExtension;
        // $lowResImageName = $baseImageName . '-low' . $baseImageExtension;

        // $path = $request->file('uploadedImage')->storeAs('public/img', $highResImageName);        
        // $highResUrl = url('/') . '/storage/' . $path;

        // Storage::copy($path, 'public/img/'. $lowResImageName);

        // $maxWidth = 300;
        // $maxHeight = 300;

        // $lowResImage = ImageIntervention::make('storage/public/img/'. $lowResImageName);
        // if ($lowResImage->width() > $lowResImage->height()) {
        //     $maxHeight = null;
        // } else {
        //     $maxWidth = null;
        // }
        // $lowResImage->resize($maxWidth, $maxHeight, function ($constraint) {
        //     $constraint->aspectRatio();
        //     $constraint->upsize();
        // });

        // $lowResImage->save();
        // $lowResUrl = url('/') . '/storage/public/img/' . $lowResImageName;

        // $createdId = $this->image->create($request, $path, $lowResUrl, $highResUrl);

        // return redirect('/project/' . $id . '/images/create');
    }

    private function processImageUpload ($request, $uploadedImage, $subtitle) {

        $baseImageName = time() . '-' . pathinfo($uploadedImage->getClientOriginalName(), PATHINFO_FILENAME);
        $baseImageExtension = '.' . $uploadedImage->getClientOriginalExtension();
        $highResImageName = $baseImageName . $baseImageExtension;
        $lowResImageName = $baseImageName . '-low' . $baseImageExtension;

        $path = $uploadedImage->storeAs('public/img', $highResImageName);

        $pathLow = 'public/img/' . $lowResImageName;

        $highResUrl = url('/') . '/storage/' . $path;

        Storage::copy($path, $pathLow);

        $maxWidth = 400;
        $maxHeight = 400;

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
        

        $createdId = $this->image->create($request, $path, $pathLow, $lowResUrl, $highResUrl, $subtitle);
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
        $tmpImageLowPath = $tmpImage->path_low;

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
        Storage::delete($tmpImageLowPath);

        return redirect('/project/' . $projectId . '/edit');
    }
}


















