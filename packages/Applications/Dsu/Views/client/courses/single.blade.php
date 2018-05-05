@extends("SystemView::client.client")
@section('content')
<div class="client content">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<h3>{{$course->title}}</h3>
				<p>Rs. {{$course->price}}</p>
				<p>{{$course->session->title}}</p>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<h4>Following documents are required</h4>
				<p>Following symbols represent the your documents for the course</p>
				<p><i><i class="fa fa-times"></i>Document missing</i>, <i><i class="fa fa-check"></i> Document exists</i></p>
				@if($course->documents->count())
					<div class="documents">
						<ul class="document list-group">					
							@foreach($course->documents as $document)
								<li class="list-group-item">
									{{ $document->title }}
									@if(!\System::isGuestCreated())
								<i class="fa fa-{{(!$course->setuser()->userDocuments($document->slug)) ? 'times danger" alt="Missing"' : 'check success" alt="Uploaded"'}}"></i>
								@endif
								</li>
							@endforeach
						</ul>
					</div>
				@else
					<b><i><u>None</u></i></b>
				@endif
				@if(\System::isGuestCreated())
					<a href="{{route('auth.login',['redirect_to'=>request()->path()])}}" class="btn btn-primary">Login</a>
				@endif
				
			</div>
		</div>
		@if(!\System::isGuestCreated())
		<div class="row">
			<form action="{{route('dsu.client.course.fetch')}}" method="POST" role="form">
				{{csrf_field()}}
				<div class="col-lg-10 col-lg-offset-1">
					<input type="hidden" name="course_id" value="{{$course->id}}">
					<input type="hidden" name="order_type" value="course">
					{!! $builder->build() !!}
						<button type="submit" class="btn btn-primary">Apply</button>
				</div>
	        </form> 
		</div>
		@endif
	</div>
</div>

@stop