@extends('SystemView::client.client')
@section('content')
<div class="content auth email">
    <div class="wrapper container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
            <form class="form" role="form" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                <legend>{{@trans('SystemLang::authentication.forgot_password.title')}}</legend>
                <div class="form-group fc-grp{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="fc-lbl"> {{trans('SystemLang::auth.forgot_password.key_label')}}</label>
                    <input id="email" type="email" class="form-control fc-in" name="email" value="{{ old('email') }}" required placeholder=" {{trans('SystemLang::auth.forgot_password.key_input')}}">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group fc-grp">
                    <button type="submit" class="fc-btn btn btn-primary btn-auth-email">
                        {{trans('SystemLang::auth.forgot_password.button_text')}}
                    </button>
                </div>
                <hr>
                <div class="fc-grp">
                    {!! trans('SystemLang::auth.forgot_password.login_link',['link'=>route('auth.login')])!!}
                </div>
            </form>
        </div>
    </div>
</div></div>
@stop


{{-- 
 @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}