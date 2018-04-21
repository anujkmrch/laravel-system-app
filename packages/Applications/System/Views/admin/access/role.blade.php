






















@extends('SystemView::admin.admin')
@section("content")
<div class="admin access">
	<div class="container wrapper">
		<div class="small col-lg-12">
		<form action="{{route('admin.access.role',['role'=>$role->slug])}}" method="POST" role="form" class="form">
				{{csrf_field()}}
			
			<h1>Role: {{$role->title}}</h1>
			<div class="row">
			<div class="form-group fc-grp col-lg-4">
				<label for="">Title</label>
				<input name="title" type="text" class="form-control fc-in" id="" placeholder="Rolename" value="{{$role->title}}">
			</div>

			<div class="fc-grp form-group col-lg-4">
				<label for="">Slug</label>
				<input name="slug" type="text" class="form-control fc-in" id="" placeholder="Rolename" readonly="true" value="{{$role->slug}}">
			</div>

			<div class="fc-grp form-group col-lg-2">
				<label for="">Enable</label>
				<div class="radio">
					<label>
						<input type="radio" name="enabled" value="1"{{$role->enabled?' checked="true"':''}}>
						Yes
					</label>
					<label>
						<input type="radio" name="enabled" value="0"{{!$role->enabled?' checked="true"':''}}>
			 			No
					</label>
				</div>
			</div>
			<div class="fc-grp form-group col-lg-2">
			<button type="submit" class="btn btn-primary">Submit</button>
			</div>
			</div>
			<div class="row">
					
					<div class="full">
						<h1>Manage role's permissions</h1>
						@if(count($permissions))
							<table class="table table-hover table-bordered table-striped">
								<thead>
									<tr>
										<th>Name</th>
										<th>Key</th>
										<th>Defalut</th>
										<th>Permission</th>
									</tr>
								</thead>
								<tbody>
									@foreach($permissions as $key => $permission)
										<tr>
											<td>{{$permission->title}}</td>
											<td>{{$permission->slug}}</td>
											<td>{{ ucfirst($permission->_default) }}</td>
											<td>
@php $current = $role->permissions->where('slug', $permission->slug)->first(); @endphp

<select name="permission[{{$permission->slug}}]" class="form-control">
		<option{{(!is_null($current) && $current->pivot->permission === "deny") ? " selected" : '' }} value="deny">Deny</option>
		<option value="allow" {{(!is_null($current) and $current->pivot->permission === "allow") ? " selected" : ''}}>Allow</option>
		<option value="inherit" {{(is_null($current)) ? " selected" : ''}}>Inherit</option>
	</select>									</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						@endif
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection