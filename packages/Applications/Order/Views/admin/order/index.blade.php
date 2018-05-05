@extends('SystemView::admin.admin')
@section('content')
<div class="container wrapper">
	<div class="row">
		<div class="col-lg-12">
			@if($orders->count())
			<table class="table table-hover table-bordered table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>User</th>
						<th>Date</th>
						<th>Payment Status</th>
						<th>Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				@foreach($orders as $order)
					<tr>
						<td>{{$order->id}}</td>
						<td>{{$order->user->name}}</td>
						<td>{{$order->created_at}}</td>
						<td>@lang("OrderLang::order.status.".$order->status)</td>
						<td>{{\Ordering::getType($order->type)}}</td>
						<td><a href="{{route('order.admin.orders.show',['order'=>$order->id])}}"><i class="fa fa-edit"></i> Edit</a></td>
					</tr>
				@endforeach
				</tbody>
			</table>
			@endif
		</div>
	</div>
</div>
@endsection