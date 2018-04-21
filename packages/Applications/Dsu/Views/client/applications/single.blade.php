@extends("SystemView::client.client")
@section('content')
<div class="content">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				@if($application)
				@if($application->order->status === 'pending')
				<form action="{{route('dsu.client.application.pay')}}" method="POST" role="form">
					{{csrf_field()}}
					<input type="hidden" name="application" value="{{$application->id}}">
					<button type="submit" class="btn btn-primary">Pay</button>
				</form>
				@endif
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th>Type</th>
								<th>Value</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Registration</td>
								<td>{{$application->id}}</td>
							</tr>
							<tr>
								<td>Course</td>
								<td>{{$application->course->title}}</td>
							</tr>
							<tr>
								<td>Session</td>
								<td>{{$application->course->session->title}}</td>
							</tr>
							@foreach($application->options as $key => $option)
							@if(is_array($option))
								@php continue; @endphp
							@endif
							<tr>
								<td>{{@trans_fb("DsuLang::application.".$key,$key)}}</td>
								<td>{!! @trans_fb("DsuLang::application.".$option,$option) !!}</td>
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