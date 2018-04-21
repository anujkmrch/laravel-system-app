<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Welcome</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/admin.css">
        <link href="/fa/css/font-awesome.min.css" rel="stylesheet">
        {{-- <script src="/js/jquery-3.2.1.min.js"></script> --}}
    <link href="/css/admin.css" rel="stylesheet">

    </head>
    <body>
        <nav class="navbar main" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/admin">{{config('app.name')}}:Admin</a>
                </div>

                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <form class="navbar-form navbar-left" method="GET" role="search">
                        <div class="form-group">
                            <input type="text" name="q" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </form>
                    <div class="navbar-right">
                        {!! \Admin::getHydratedMenu('usermenu',true) !!}
                    </div>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>

        @if(\Admin::has_menus('sidebar'))
            <nav class="navbar dashbar" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-dashbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    
                </div>
                <div class="collapse navbar-collapse navbar-dashbar-collapse">
                    {!! \Admin::getHydratedMenu('sidebar',true) !!}


                </div><!-- /.navbar-collapse -->
            </div>
        </nav>
        @endif
        @if(\Admin::has_toolbar())
            <div class="container">
                <div class="col-lg-12 text-right">
                    <div class="toolbar">
                        {!! \Admin::getToolbar(true); !!}
                    </div>
                </div>
            </div>
        @endif
        @yield("content")
        <script src="https://code.jquery.com/jquery.js"></script>
    {{-- <script src="/js/jquery.min.js" type="text/javascript"></script>  --}}
        <script src="/js/bootstrap.min.js"></script>
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
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
        <script>
            $(function() {
                $( 'input[type="date"]' ).datepicker({ dateFormat: 'dd-M-yy'});
            });
        </script>


    </body>
</html>
