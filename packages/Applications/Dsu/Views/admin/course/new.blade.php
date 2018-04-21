@extends('SystemView::admin.admin')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<form action="{{route('dsu.admin.course.new')}}" method="POST" role="form">
				{{csrf_field()}}
				<legend>Create new course</legend>
				{!! $builder->build() !!}
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
			
			{{-- 
			@foreach($courses->courses as $course)
				<h1>{{$course->title}}</h1>
			@endforeach --}}
		</div>
	</div>
</div>
@endsection