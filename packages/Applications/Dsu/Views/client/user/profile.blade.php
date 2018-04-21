@extends("SystemView::client.client")
@section('content')
<div class="client content">
<div class="container">
	
	<div class="row">
      <!-- left column -->
      <div class="col-md-4">
      	<form action="{{route('dsu.client.user.profile')}}" method="POST" role="form" class="form-horizontal" enctype="multipart/form-data">
		{{csrf_field()}}
        <div class="text-center">
          <img src="{{$user->avatar ? $user->avatar : '//placehold.it/100'}}" class="avatar img-rounded img-thumbnail"  alt="avatar">
          <div class="text{{ $errors->has('avatar')|| $errors->first('avatar') ? ' has-error' : '' }}"><h6>Upload a different photo...</h6>
          @if ($errors->has('avatar'))
                    <span class="help-block">
                        <strong>{{ $errors->first('avatar') }}{{$errors->first('avatar')}}</strong>
                    </span>
          @endif
      </div>
          <input type="file" name="avatar" class="form-control">
          <button name="submit" class="btn  btn-link">Upload</button>
        </div>
    	</form>

      @if($user->documents->count())
        <h5>You have uploaded following documents</h5>
        <ul class="list-group">
          @foreach($user->documents as $document)
            <li class="list-group-item">{{$document->title}}</li>
          @endforeach
        </ul>
      @endif
    	<a href="{{route('dsu.client.user.document')}}" class="btn btn-info">Manage document</a>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-8 personal-info">
        <form action="{{route('dsu.client.user.profile')}}" method="POST" role="form" class="form-horizontal">
		{{csrf_field()}}
          <div class="form-group">
            <label class="col-lg-3 control-label">First name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="first_name" value="{{$user->first_name}}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Last name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="last_name" value="{{$user->last_name}}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="email" value="{{$user->email}}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Username:</label>
            <div class="col-md-8">
              <input class="form-control" type="text" name="username" value="{{$user->username}}"{{!config('system.allow_change_username',false)?' disabled':''}}>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Current password:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" name="old_password" placeholder="Current password">
            </div>
          </div>
           <div class="form-group">
            <label class="col-md-3 control-label">New password:</label>
            <div class="col-md-8">
              <input class="form-control" name="new_password" type="password" placeholder="New password">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Confirm password:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" name="new_password_confirmation" placeholder="Confirm new password">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input type="submit" class="btn btn-primary" value="Save Changes">
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel">
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
</div>
@stop