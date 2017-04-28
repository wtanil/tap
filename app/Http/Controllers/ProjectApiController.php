<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\ProjectInterface;

class ProjectApiController extends Controller
{
    /**
     * The project repository instance
     *
     * @var ProjectInterface
     */
    protected $project;

    public function __construct(ProjectInterface $project)
    {
        $this->project = $project;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        return response()->json($this->project->allApi(), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $userId
     * @param  int  $recordId
     * @return \Illuminate\Http\Response
     */
    public function show($projectId)
    {
        return response()->json($this->project->forIdApi($projectId), 200);
    }
}











