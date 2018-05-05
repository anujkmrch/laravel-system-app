@extends('SystemView::admin.admin')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			@foreach($sessions as $session)
				<div class="col-lg-12">
					<h2>Session {{$session->title}}</h2>
				</div>
				@foreach($session->courses as $course)
					<div class="col-lg-6">
						<div class="dashcard">
							<h3>{{$course->title}}</h3>
							<h4>Total applications {{$course->applications->count()}}</h4>
							<a class="btn btn-primary" href="{{route('dsu.admin.admission.applications',['course'=>$course->id])}}">View course applications</a>
						</div>
					</div>
				@endforeach
			@endforeach
		</div>
	</div>
</div>
@endsection