@extends('layouts.app')

@section('content')

<div class="container">

	<!-- DETAILS -->
	@include('common.incompleteerrors')
	@include('common.errors')

	<div class="row">

        <a class="btn btn-default" href="{{ url('/#project' . $project->id) }}" role="button">Back</a>
        
    </div>

    <br>


	<div class="row" id="details">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Details</h3>
			</div>
			<div class="panel-body">
				<form action="{{ url('project/' . $project->id . '/edit') }}" method="POST" class="form-horizontal">
					{{ csrf_field() }}
					{{ method_field('PUT') }}

					<div class="form-group">
						<label class="col-sm-3 control-label">Status</label>
						<div class="col-sm-6">
							
							@if ($project->active == 1)
							<p class="form-control-static">
								Active <a href="{{ url('project/' . $project->id . '/active/0') }}">(set Inactive)</a>
							</p>
							@else
							<p class="form-control-static text-danger">
								Inactive <a href="{{ url('project/' . $project->id . '/active/1') }}">(set Active)</a>
							</p>
							@endif
							
						</div>
					</div>


					<div class="form-group">
						<label for="title" class="col-sm-3 control-label">Title</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="title" id="title" value="{{ old('title', $project->title) }}">
						</div>
					</div>

					<div class="form-group">
						<label for="categoryId" class="col-sm-3 control-label">Category</label>
						<div class="col-sm-6">
							<select class="form-control" id="categoryId" name="categoryId">

								@foreach ($categories as $category)

								@if (is_null(old('categoryId')))

								@if ($project->category_id == $category->id)
								<option value="{{ $category->id }}" selected>{{ $category->name }}</option>
								@else
								<option value="{{ $category->id }}">{{ $category->name }}</option>
								@endif

								@else
								@if (old('categoryId') == $category->id)
								<option value="{{ $category->id }}" selected>{{ $category->name }}</option>
								@else
								<option value="{{ $category->id }}">{{ $category->name }}</option>
								@endif

								@endif



								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="projectDate" class="col-sm-3 control-label">Project Date</label>
						<div class="col-sm-6">
							<input type="date" class="form-control" name="projectDate" id="projectDate"
							value="{{ old('projectDate', $project->project_date->format('Y-m-d')) }}">
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
				<!--panel body-->
			</div>
			<!--panel-->
		</div>
		<!--row-->
	</div>

	<div class="row" id="images">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Images</h3>
			</div>
			<div class="panel-body">

				<a class="btn btn-primary" href="{{ url('project/' . $project->id . '/images/create') }}" role="button">Add image</a>
				<br><br>

				<table class="table table-hover">

					<tr>
						<th>No</th>
						<th>Image</th>
						<th>Description</th>
						<th class="col-xs-1"></th>
						<th class="col-xs-1"></th>
						<th class="col-xs-1"></th>
					</tr>

					@foreach ($project->images as $image)

					<tr>
						<td>
							<strong>{{$loop->iteration}}</strong>
						</td>
						<td>
							<a href="{{$image->high_res_url}}"><img class="img-rounded img-responsive img-thumb-small" src="{{$image->low_res_url}}"></a>
						</td>
						<td>
							@if($image->id == $project->thumbnail_id)
							<strong>
								@endif
								{{ $image->subtitle }} 
								@if($image->id == $project->thumbnail_id)
								(thumbnail)</strong>
								@endif
							</td>
							<td class="col-xs-1">
								@if ($image->id == $project->thumbnail_id)
									<button class="btn btn-default btn-sm" disabled>Thumbnail</button>
									
								@else
									<form action="{{ url('project/' . $project->id . '/thumbnail') }}" method="POST" class="form-horizontal">
										{{ csrf_field() }}
										{{ method_field('PUT') }}
										<input type="hidden" class="form-control" name="thumbnailId" id="thumbnailId" value="{{ $image->id }}">

										<button type="submit" class="btn btn-default btn-sm">Thumbnail</button>
									</form>
								@endif
							</td>
							<td class="col-xs-1">
								<a class="btn btn-default btn-sm" href="{{ url('project/' . $project->id . '/images/' . $image->id . '/edit') }}" role="button">Edit</a>
							</td>
							<td class="col-xs-1">
								<form action="{{ url('project/' . $project->id . '/images/' . $image->id) }}" method="POST">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<button type="submit" class="btn btn-danger btn-sm">Delete</button>
								</form>
							</td>
						</tr>

						@endforeach
					</table>
					<!--panel body-->
				</div>
				<!--panel-->
			</div>

			<!--row-->
		</div>

		<!--container-->
	</div>

	@endsection