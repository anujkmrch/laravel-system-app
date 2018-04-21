@extends('SystemView::admin.admin')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h1>I am the admission</h1>
			<h1>Course {{$course->title}}</h1>
			@foreach($course->applications as $application)
				<h4>Total applications {{$course->applications->count()}}</h4>
				<a class="btn btn-primary" href="{{route('dsu.admin.admission.applications',['course'=>$course->id])}}">View course applications</a>
			@endforeach
		</div>
	</div>
</div>
@endsection