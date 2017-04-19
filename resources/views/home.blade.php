@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">

        <a class="btn btn-primary" href="{{ url('project/create') }}" role="button">Create a new project</a>
        
    </div>

    <br>
    
    <div class="row">

        @foreach ($projects as $project)

        <div class="row" id="project{{ $project->id }}">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>{{$loop->iteration}}.</strong> {{$project->title}}</h3>
                </div>
                <div class="panel-body">

                    <div class="col-xs-12 col-sm-4">

                        @foreach ($project->images as $image)

                        @if($image->id == $project->thumbnail_id)
                        <a href="{{$image->high_res_url}}"><img class="img-rounded center-block img-thumb-medium" src="{{$image->low_res_url}}"></a>
                        @endif

                        @endforeach
                    </div>

                    <div class="col-xs-12 col-sm-8">
                        <strong>Status:</strong>
                        @if($project->active == 1)
                        Active
                        @else
                        <span class="text-danger">Inactive</span>
                        @endif
                        <br>
                        <strong>Category:</strong> {{$project->category->name}}
                        <br>
                        <strong>Date:</strong> {{$project->project_date->format('d-m-Y')}}
                    
                        <br>
                        <br>

                        <a class="btn btn-default btn-sm" style="display: inline-block;" href="{{ url('project/' . $project->id . '/edit') }}" role="button">Edit</a>
                        
                        <form action="{{ url('project/' . $project->id) }}" method="POST" style="display: inline-block;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger btn-sm" >Delete</button>
                        </form>
                    </div>
                    
                    
                </div>
            </div>
        </div>


        @endforeach





    </div>
    @endsection
