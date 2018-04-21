@extends('SystemView::admin.admin')
@section('content')
<div class="admin container">
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			@foreach($sessions as $session)
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h3 class="panel-title pull-left">{{$session->title}}</h3>
						<a class="pull-right" href="{{route('dsu.admin.session.edit',['id'=>$session->id])}}">Edit</a>
					</div>
					<div class="panel-body">
						{{$session->active ? "Active" : 'Inactive'}}
						@if(!$session->active)
						<a href="{{route('dsu.admin.session.activate',['session'=>$session->id])}}">Activate !</a>
						@endif
						Total Courses {{$session->courses->count()}}
						<a href="{{route('dsu.admin.session.courses',['session'=>$session->id])}}" class="btn btn-primary">Session courses</a>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</div>
@endsection