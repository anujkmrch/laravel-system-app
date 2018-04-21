@extends("SystemView::client.client")
@section('content')
<div class="content">
	<div class="container">
		<div class="row">
			@if($user->orders->count())
			@foreach($user->orders as $order)
				<div class="col-lg-8 col-lg-offset-2">
					{{$order->cart->totalQty}}
				</div>
			@endforeach
			@endif
		</div>
	</div>
</div>
@stop