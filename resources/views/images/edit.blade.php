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
                <h3 class="panel-title">Details</h3>
            </div>
            <div class="panel-body">

                <form action="{{ url('project/' . $project->id . '/images/' . $image->id . '/edit') }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <label for="thumbnail" class="col-sm-3 control-label">Image</label>
                        <div class="col-sm-6">
                            <a href="{{$image->high_res_url}}"><img class="img-rounded img-responsive" src="{{$image->low_res_url}}"></a>
                            <input type="hidden" class="form-control" name="thumbnail" id="thumbnail" value="">
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" class="col-sm-3 control-label">Decription</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="description" id="description" value="{{ old('description', $image->subtitle) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus"></i> Save
                            </button>
                        </div>
                    </div>

                </form>

            </div>

        </div>
    </div>

</div>
@endsection
