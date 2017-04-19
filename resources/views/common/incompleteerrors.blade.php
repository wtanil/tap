@if (is_null($project->thumbnail_id))

	@if (count($project->images) == 0)
    
    <div class="alert alert-danger">
        <strong>The project is incomplete, please upload at least one image <a href="{{ url('project/' . $project->id . '/images/create') }}">here</a></strong>

        <br>
    </div>

    @else

    <div class="alert alert-danger">
        <strong>The project is incomplete, please set a thumbnail <a href="{{ url('project/' . $project->id . '/edit#images') }}">here</a></strong>

        <br>
    </div>

    @endif
@endif