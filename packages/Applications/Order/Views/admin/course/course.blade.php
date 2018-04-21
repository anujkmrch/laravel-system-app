@extends('SystemView::admin.admin')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h1>{{$course->title}}</h1>
			<form action="{{route('dsu.admin.course.edit',['slug'=>$course->id])}}" method="POST" role="form">
				{{csrf_field()}}
				<legend>Edit course</legend>
				{!! $builder->build() !!}
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>
@endsection