@extends("SystemView::client.client")
@section('content')
<div class="client content">
<div class="container">
	
	<div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <img src="{{$user->avatar ? $user->avatar : '//placehold.it/100'}}" class="avatar img-rounded img-thumbnail"  alt="avatar">
        </div>
      {!! \Client::getHydratedMenu("default") !!}
     
      </div>
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <div><p>Hello <b>{{$user->name}}</b>, (not <b>{{$user->name}}</b>? <a href="{{route('auth.logout')}}">Logout</a>)</p></div>

        @if(count($dashboards = \Client::get_dashboard()))
        <div class="row">
            @foreach($dashboards as $dashboard)
                <div class="col-lg-12">
                    @if(array_key_exists('callback', $dashboard) 
                        and is_callable($dashboard['callback']))
                        {!! call_user_func_array($dashboard['callback'],[$dashboard]) !!}
                    @endif
                </div>
            @endforeach
        </div>
        @endif
      </div>
  </div>
</div>
</div>
@stop