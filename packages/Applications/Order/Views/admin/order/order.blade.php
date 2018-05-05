@extends('SystemView::admin.admin')
@section('content')
<div class="container wrapper">
	<div class="row">
		<div class="col-lg-12">
			@if($order)
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Order id</th>
							<th>Created by</th>
							<th>Created on</th>
							<th>Order Type</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{$order->id}}</td>
							<td>{{$order->user->name}}</td>
							<td>{{$order->created_at}}</td>
							<td>{{\Ordering::getType($order->type)}}</td>
						</tr>
					</tbody>
				</table>
				<h3>Details</h3>
				@php $cart_builder = $order->type.'_cart_list_builder' @endphp

				@if($order->cart and count($order->cart->items) and is_callable($cart_builder))
				<table class="table table-bordered table-striped">
					{!! $cart_builder($order->cart) !!}
				</table>
				@endif
				
				@lang("OrderLang::order.status.".$order->status)
			
			@endif
		</div>
	</div>
</div>
@endsection