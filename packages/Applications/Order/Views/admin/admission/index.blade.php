@extends('SystemView::admin.admin')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h1>I am the admission</h1>
			@foreach($sessions as $session)
			<h1>Session {{$session->title}}</h1>
				@foreach($session->courses as $course)
					<h3>{{$course->title}}</h3>
					<h4>Total applications {{$course->applications->count()}}</h4>
					<a class="btn btn-primary" href="{{route('dsu.admin.admission.applications',['course'=>$course->id])}}">View course applications</a>
				@endforeach
			@endforeach
		</div>
	</div>
</div>
@endsection