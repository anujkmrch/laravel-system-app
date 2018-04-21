@extends('SystemView::admin.admin')
@section('content')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="admin container">
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<form action="{{route('dsu.admin.session.edit',['id' => $session->id])}}" method="POST" role="form">
				{{csrf_field()}}
			{!! $builder->build() !!}
			<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>

@endsection