@extends('SystemView::admin.admin')
@section('content')
<div class="admin container">
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<form action="{{route('dsu.admin.session.create')}}" method="POST" role="form">
				{{csrf_field()}}
			{!! $builder->build() !!}
			<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>
@endsection