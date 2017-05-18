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
                        <label for="uploadedImage1" class="col-sm-3 control-label">Image 1</label>
                        <div class="col-sm-6">
                            <input type="file" name="uploadedImage1" id="uploadedImage1">
                            <p class="help-block">Max: 2MB, Type: JPG, JPEG, PNG</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description1" class="col-sm-3 control-label">Decription</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="description1" id="description1" value="{{ old('description1') }}">
                        </div>
                    </div>

                    <hr />

                    <div class="form-group">
                        <label for="uploadedImage2" class="col-sm-3 control-label">Image 2</label>
                        <div class="col-sm-6">
                            <input type="file" name="uploadedImage2" id="uploadedImage2">
                            <p class="help-block">Max: 2MB, Type: JPG, JPEG, PNG</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description2" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="description2" id="description2" value="{{ old('description2') }}">
                        </div>
                    </div>

                    <hr />

                    <div class="form-group">
                        <label for="uploadedImage3" class="col-sm-3 control-label">Image 3</label>
                        <div class="col-sm-6">
                            <input type="file" name="uploadedImage3" id="uploadedImage3">
                            <p class="help-block">Max: 2MB, Type: JPG, JPEG, PNG</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description3" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="description3" id="description3" value="{{ old('description1') }}">
                        </div>
                    </div>

                    <hr />

                    <div class="form-group">
                        <label for="uploadedImage4" class="col-sm-3 control-label">Image 4</label>
                        <div class="col-sm-6">
                            <input type="file" name="uploadedImage4" id="uploadedImage4">
                            <p class="help-block">Max: 2MB, Type: JPG, JPEG, PNG</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description4" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="description4" id="description4" value="{{ old('description1') }}">
                        </div>
                    </div>

                    <hr />

                    <div class="form-group">
                        <label for="uploadedImage5" class="col-sm-3 control-label">Image 5</label>
                        <div class="col-sm-6">
                            <input type="file" name="uploadedImage5" id="uploadedImage5">
                            <p class="help-block">Max: 2MB, Type: JPG, JPEG, PNG</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description5" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="description5" id="description5" value="{{ old('description1') }}">
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus"></i> Add Images
                            </button>
                        </div>
                    </div>

                </form>

            </div>

        </div>
    </div>

</div>
@endsection
