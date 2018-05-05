@extends("SystemView::client.client")
@section('content')
<div class="content">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				@if($user->applications->count())
					<table class="table table-hover table-striped table-bordered">
						<thead>
							<tr>
								<th>Form</th>
								<th>Course</th>
								<th>Session</th>
								<th>Order Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>

					@foreach($user->applications as $application)
					<tr>
						<td>{{$application->id}}</td>
						<td>{{$application->course->title}}</td>
						<td>{{$application->course->session->title}}</td>
						<td>{{trans("OrderLang::order.status.".$application->order->status)}}</td>
						<td><form action="{{route('dsu.client.application.single')}}" method="POST" role="form">
							{{csrf_field()}}
							<input type="hidden" name="application_id" value="{{$application->id}}">
							<button type="submit" class="btn btn-primary">Submit</button>
						</form></td>
					</tr>
					@endforeach
					</tbody>
					</table>
				@endif
			</div>
		</div>

	</div>
</div>

@stop