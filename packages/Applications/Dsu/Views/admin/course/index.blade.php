@extends('SystemView::admin.admin')
@section('content')
<div class="content">
<div class=" container">
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
			@if($session)
			@if($session->courses->count())
			<table class="table table-hover table-striped table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>Course name</th>
						<th>Session</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

				
			@foreach($session->courses as $course)
				<tr>
					<td>{{$course->id}}</td>
					<td>{{$course->title}}</td>
					<td>{{$course->session->title}}</td>
					<td><a href="{{route('dsu.admin.course.course',['slug'=>$course->id])}}" class="btn btn-primary btn-sm">Edit</a></td>
				</tr>
				
			@endforeach
			</tbody>
			</table>
			@else
				<h1>You have not created any course yet for session {{$session->title}}</h1>
				<h4>"{{$session->title}}" is your active session</h4>
			@endif
			@else
			<h1>There is no active session, please activate the session to see the active session course list</h1>
			@endif
		</div>
	</div>
</div>
</div>
@endsection