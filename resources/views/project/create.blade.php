@extends('layouts.app')

@section('content')

<div class="container">

	@include('common.errors')

	<div class="row">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Add</h3>
			</div>
			<div class="panel-body">

				<form action="{{ url('project/') }}" method="POST" class="form-horizontal">
					{{ csrf_field() }}

					<div class="form-group">
						<label for="title" class="col-sm-3 control-label">Title</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
						</div>
					</div>

					<div class="form-group">
						<label for="categoryId" class="col-sm-3 control-label">Category</label>
						<div class="col-sm-6">
							<select class="form-control" id="categoryId" name="categoryId">
								<option value=""></option>
								@foreach ($categories as $category)
								@if (old('categoryId') == $category->id)
								<option value="{{ $category->id }}" selected>{{ $category->name }}</option>
								@else
								<option value="{{ $category->id }}">{{ $category->name }}</option>
								@endif
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="projectDate" class="col-sm-3 control-label">Project Date</label>
						<div class="col-sm-6">
							<input type="date" class="form-control" name="projectDate" id="projectDate" value="{{ old('projectDate') }}">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-6">
							<button type="submit" class="btn btn-default">
								<i class="fa fa-plus"></i> Add Project
							</button>
						</div>
					</div>

				</form>
			<!-- panel body -->
			</div>
		<!-- panel -->
		</div>
	<!-- row -->
	</div>
<!-- container -->
</div>

@endsection