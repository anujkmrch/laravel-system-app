@extends('SystemView::admin.admin')
@section('content')
<div class="admin container">
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			@foreach($sessions as $session)
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">{{$session->title}}</h3>
						{{$session->active ? "Active" : 'Inactive'}}
					</div>
					<div class="panel-body">
						
						@if(!$session->active)
						<a href="{{route('dsu.admin.session.activate',['session'=>$session->id])}}">Actiate !</a>
						@endif
						<hr>
						@foreach($session->courses as $course)
							<div style="display:block;padding:.4em 0;">
								<h1>{{$course->title}}</h1>
								<h2>Total applications {{$course->applications->count()}}</h2>
							<a class="btn btn-default" href="{{route('dsu.admin.course.course',['id'=>$course->id])}}">Edit course</a>
							</div>
						@endforeach
					</div>
				</div>
			@endforeach
		</div>
	</div>
</div>
@endsection