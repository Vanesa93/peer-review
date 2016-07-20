<link href='{{ URL::asset('styles/header.css')}}' rel='stylesheet' type='text/css'>
<div class='header'>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Peer-Review</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="/">{{trans('messages.home')}}</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                    <li><a href="/auth/login">{{trans('messages.login')}}</a></li>
                    <li><a href="/auth/register">{{trans('messages.register')}}</a></li>
                    <li class="dropdown" style="float:right">                        
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="float:right">
                            <span class="glyphicons glyphicons-globe"></span>
                            <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu" name="language" style="float:right;">
                            <li><a href="/language/en" value='en' name='locale'>EN</a></li>
                            <li><a href="/language/bg" value='bg' name='locale'>BG</a></li>
                            <li><a href="/language/de" value='de' name='locale'>DE</a></li>


                        </ul>
                    </li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/auth/logout">{{trans('messages.logout')}}</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>