@extends('SystemView::admin.admin')
@section('content')
<div class="admin">
	<div class="wrapper container">
		<div class="row">
			<div class="col-lg-12">
				<table class="table table-hover table-bordered table-striped">
					<thead>
						<tr>
							<th>Id</th>
							<th>Title</th>
							<th>Address</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						@foreach($centers as $course)
						<tr>
							<td>{{$course->id}}</td>
							<td><a href="{{route('dsu.admin.exam-center.edit',['id'=>$course->id])}}">{{$course->title}}</a></td>
							<td>{{$course->address}}</td>
							<td>{{$course->enabled? 'Enabled' : 'Disabled'}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection