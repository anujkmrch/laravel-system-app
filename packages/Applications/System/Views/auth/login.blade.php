@extends('SystemView::client.client')
@section('content')
<div class="content auth login">
	<div class="wrapper container">
		<div class="row">
			<div class="col-lg-6">
		<form action="{{route_with_redirect('auth.login')}}" id="login" method="post" class="form">
			{{csrf_field()}}
			<legend>{{@trans('SystemLang::authentication.login.title')}}</legend>
			<div class="form-group fc-grp{{ $errors->has('email')|| $errors->first('username') ? ' has-error' : '' }}">
				<label class="fc-lb">{{@trans('SystemLang::authentication.login.label.key')}}</label>
				<input type="text" name="email" value="{{ old('email') }}" class="form-control fc-in" placeholder="{{@trans('SystemLang::authentication.login.input.key')}}">
				@if ($errors->has('email') or $errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}{{$errors->first('username')}}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group fc-grp{{ $errors->has('password') ? ' has-error' : '' }}">
				<label class="fc-lb">{{@trans('SystemLang::authentication.login.label.password')}}</label>
				<input type="password" class="form-control fc-in" name="password" placeholder="{{@trans('SystemLang::authentication.login.input.password')}}">
				 @if ($errors->has('password'))
	                <span class="help-block">
	                    <strong>
	                        {{ $errors->first('password') }}
	                    </strong>
	                </span>
	            @endif
			</div>
		
			<div class="form-group fc-grp cf clearfix footer">
				<a href="{{route('auth.password.request')}}" class="fc-link pl">Forgot password?</a>
				<label for="" class="fc-lb pr pull-right">
					<div class="fc-ck"><input type="checkbox" name="remember_me"><span>Keep me logged in!</span></div>
				</label>
			</div>
			<input type="submit" class="fc-btn btn btn-primary btn-auth-login col-def" value="Login">
		</form>	
	</div>
</div>
</div>
</div>
@endsection