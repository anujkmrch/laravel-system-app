@extends('SystemView::admin.admin')
@section('content')
<div class="admin">
	<div class="wrapper container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<form action="{{route('dsu.admin.exam-center.create')}}" method="post">
					{{csrf_field()}}

					@php
						
						$form = new \System\Classes\FormBuilder($center-> buildCenterFormElement())
					@endphp
					
					{!!$form->build()!!}
					<div class="form-group fc-grp">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection