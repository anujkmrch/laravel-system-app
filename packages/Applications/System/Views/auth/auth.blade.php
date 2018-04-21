<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	{!! SEO::generate(true) !!}
	<link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link href="/fa/css/font-awesome.min.css" rel="stylesheet">
    <script src="/js/jquery-3.2.1.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="flash-message">
		    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
		      @if(Session::has('alert-' . $msg))
		      <p class="alert alert-{{ $msg }}"><i class="fa fa-coffee"></i> {{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
		      @endif
		    @endforeach
		</div>
	</div>
@yield('content')
</body>
</html>