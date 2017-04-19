@extends('layouts.app')

@section('content')
<div class="container">

    @include('common.errors')

    <div class="row">

        <a class="btn btn-default" href="{{ url('project/' . $project->id . '/edit') }}" role="button">Back to project</a>
        
    </div>

    <br>

    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Add</h3>
            </div>
            <div class="panel-body">

                <form action="{{ url('project/' . $project->id . '/images') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <input type="hidden" class="form-control" name="projectId" id="projectId" value="{{ $project->id }}">

                    <div class="form-group">
                        <label for="uploadedImage" class="col-sm-3 control-label">Image</label>
                        <div class="col-sm-6">
                            <input type="file" name="uploadedImage" id="uploadedImage" value="{{ old('uploadedImage') }}">
                            <p class="help-block">Max: 2Mb</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" class="col-sm-3 control-label">Decription</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="description" id="description" value="{{ old('description') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus"></i> Add Image
                            </button>
                        </div>
                    </div>

                </form>

            </div>

        </div>
    </div>

</div>
@endsection
