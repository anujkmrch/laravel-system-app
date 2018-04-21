@extends('SystemView::admin.admin')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h1>I am the course</h1>
			@foreach($courses->courses as $course)
				<h1><a href="{{route('dsu.admin.course.course',['slug'=>$course->id])}}">{{$course->title}}</a> {{$course->id}}</h1>
			@endforeach
		</div>
	</div>
</div>
@endsection