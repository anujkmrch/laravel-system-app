@extends("SystemView::client.client")
@section('content')
<div class="client content">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<ul class="marked-list">
					@foreach($session->courses as $course)
						<li><a href="{{route('dsu.client.course.course',['course'=>$course->id])}}">{{$course->title}}</a></li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>

@stop