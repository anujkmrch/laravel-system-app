<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {!! SEO::generate(true) !!}
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/style.css">
        <link href="/fa/css/font-awesome.min.css" rel="stylesheet">

        <script src="/js/jquery.min.js" type="text/javascript"></script>
        <script src="/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-custom" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Menu</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/"><span>{{config('app.name')}}</span> Web</a>
                </div>
                @if(position_has_widget('user'))
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <div class="navbar-right">
                        {!! widget_render("user") !!}
                    </div>
                </div><!-- /.navbar-collapse -->
                @endif
            </div>
        </nav>
        
        @if(position_has_widget('banner'))
         <div class="jumbotron" id="banner">
            <div class="container">
                {!! widget_render("banner") !!}
            </div>
          </div><!-- /.navbar-collapse -->
        @endif

         @if(position_has_widget('featuring'))
         <div id="featuring">
            <div class="container">
                <div class="row">
                {!! widget_render("featuring") !!}
                </div>
            </div>
          </div><!-- /.navbar-collapse -->
          @endif
        
        @if(position_has_widget('containment'))
         <div class="onetwothree" id="containment">
            <div class="container">
                <div class="row">
                {!! widget_render("containment",'half') !!}
                </div>
            </div>
          </div><!-- /.navbar-collapse -->
          @endif
         
          
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @if(Session::has('alert-' . $msg))
                  <div class="container">
              <div class="row">
                  <div class="col-lg-8 col-lg-offset-2">
                      <div class="flash-message">
                  <p class="alert alert-{{ $msg }}"><i class="fa fa-coffee"></i> {{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                  </div>
                  </div>
              </div>
          </div>
          @endif
        @endforeach
        @yield("content")
         <div id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                     <ul class="list-inline socials">
                        <li><a class="fa fa-facebook" href="#"></a></li>
                        <li><a class="fa fa-twitter" href="#"></a></li>
                        <li><a class="fa fa-github" href="#"></a></li>
                    </ul>
                    <div class="cpr">&reg; &copy; 2016-18 {{config('app.name')}}&trade;</div>
                    @if(position_has_widget('footer_one'))
                    <div id="footer_one">
                            <div class="row">
                            {!! widget_render("footer_one",'full') !!}
                            </div>
                    </div>
                    
                    @endif
                </div>
            </div>
        </div>
    </div>
        
        <script type="text/javascript">
             $(function(){
                $(".dropdown").hover(            
                        function() {
                            $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
                            $(this).toggleClass('open');
                            // $('b', this).toggleClass("caret caret-up");                
                        },
                        function() {
                            $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
                            $(this).toggleClass('open');
                            // $('b', this).toggleClass("caret caret-up");                
                        });

                $('li.dropdown').on('click', function() {
                    var $el = $(this);
                    if ($el.hasClass('open')) {
                        var $a = $el.children('a.dropdown-toggle');
                        if ($a.length && $a.attr('href')) {
                            location.href = $a.attr('href');
                        }
                    }
                    });
                });
        </script>
        @yield('script')
    </body>
</html>
