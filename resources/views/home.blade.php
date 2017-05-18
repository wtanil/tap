@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">

        <a class="btn btn-primary" href="{{ url('project/create') }}" role="button">Create a new project</a>
        
    </div>

    <br>

    <div class="row">
        <!-- ASD -->
        <div class="col-sm-8">
            <form action="{{ url('category/') }}" method="POST" class="form-inline">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="categoryId" class="control-label">Category</label>
                    
                        <select class="form-control" id="categoryId" name="categoryId">
                            <option value="">All</option>
                            @foreach ($categories as $category)
                            @if ($currentCategoryId == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    

                    <label for="sortId" class=" control-label">Sort By</label>
                    
                        <select class="form-control" id="sortId" name="sortId">
                            <option value=""></option>
                            <option value="1" 
                            @if ($currentSortId == 1)
                            selected
                            @endif
                            >Title Ascending</option>
                            <option value="2"
                            @if ($currentSortId == 2)
                            selected
                            @endif
                            >Title Descending</option>
                            <option value="3"
                            @if ($currentSortId == 3)
                            selected
                            @endif
                            >Created Ascending</option>
                            <option value="4"
                            @if ($currentSortId == 4)
                            selected
                            @endif
                            >Created Descending</option>
                            
                        </select>
                    


                    
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-plus"></i> Filter
                        </button>
                    
                </div>

            <!-- <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Filter
                    </button>
                </div>
            </div> -->

        </form>
    </div>
    <!-- ASD -->

        

    <!-- ASD 2 -->
    <div class="col-sm-4">
        <form action="{{ url('project/search/') }}" method="POST" class="form">
            {{ csrf_field() }}

            <div class="input-group">
                <input type="text" class="form-control" name="searchKey" id="searchKey" placeholder="Search title">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">Search</button>
                </span>
            </div>

            <!-- <div class="form-group">
                <label for="searchKey" class="control-label">Search</label>
                
                    <input type="text" class="form-control" name="searchKey" id="searchKey" placeholder="Search title">
                
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i>Search
                    </button>
                
            </div> -->


        </form>
    </div>
    <!-- ASD 2 -->


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
                    Active <a href="{{ url('project/' . $project->id . '/active/0') }}">(set Inactive)</a>
                    @else
                    <span class="text-danger">Inactive</span> <a href="{{ url('project/' . $project->id . '/active/1') }}">(set Active)</a>
                    @endif
                    <br>
                    <strong>Category:</strong> {{$project->category->name}}
                    <br>
                    <strong>Date:</strong> {{$project->project_date->format('d-m-Y')}}

                    <br>
                    <br>

                    <a class="btn btn-default" href="{{ url('project/' . $project->id . '/edit') }}" role="button">Edit</a>
                </div>


            </div>
        </div>
    </div>


    @endforeach





</div>
@endsection
