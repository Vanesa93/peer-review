<link href='{{ URL::asset('styles/header.css')}}' rel='stylesheet' type='text/css'>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

<div class='header'>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#languages">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Peer-Review</a>
            </div>
            <div class="collapse navbar-collapse" id="languages">
                <ul class="nav navbar-nav">
                    @if(Auth::guest())
                    <li><a href="/">{{trans('messages.home')}}</a></li>
                    <li class="dropdown" style="float:right">   
                        <span class=" dropdown-toggle glyphicon glyphicon-globe" data-toggle="dropdown" role="button" aria-expanded="false" style="cursor:pointer;font-size: 18px"></span>

                        <ul class="dropdown-menu" role="menu" name="language" style="float:right;">
                            <li><a href="/language/en" value='en' name='locale'>EN</a></li>
                            <li><a href="/language/bg" value='bg' name='locale'>BG</a></li>
                            <li><a href="/language/de" value='de' name='locale'>DE</a></li>


                        </ul>
                    </li>

                    @else
                    <li><a href="/">{{trans('messages.home')}}</a></li>
                    <li class="dropdown" style="float:right">   
                        <span class=" dropdown-toggle glyphicon glyphicon-globe" data-toggle="dropdown" role="button" aria-expanded="false" style="cursor:pointer;font-size: 18px"></span>
                        <ul class="dropdown-menu" role="menu" name="language" style="float:right;">
                            <li><a href="/language/en" value='en' name='locale'>EN</a></li>
                            <li><a href="/language/bg" value='bg' name='locale'>BG</a></li>
                            <li><a href="/language/de" value='de' name='locale'>DE</a></li>


                        </ul>
                    </li>
                    @if (Auth::user()->account_type==1)
                    <li><a href="{{ url('/courses') }}"> {{trans('messages.courses')}}</a></li>
                    <li><a href="/groups"> {{trans('messages.groups')}}</a></li>
                    <li><a href="/tasks"> {{trans('messages.tasks')}}</a></li>                    
                    <li><a href="/reviews"> {{trans('messages.questionaries')}}</a></li>
                    @elseif(Auth::user()->account_type==2)
                    <li><a href="/mycourses"> {{trans('messages.myCourses')}}</a></li>
                    <li><a href="/mygroups"> {{trans('messages.myGroups')}}</a></li>
                    <li><a href="/mytasks">{{trans('messages.myTasks')}}</a></li>
                    <li><a href="/myreviews"> {{trans('messages.reviewTasks')}}</a></li>
                    @elseif(Auth::user()->account_type==0)                   
                    <li><a href="/register"> {{trans('messages.registerUsers')}}</a></li>
                    <li><a href="/users"> {{trans('messages.users')}}</a></li>
                    <li><a href="/faculties">{{trans('messages.faculties')}}</a></li>
                    @endif
                    @endif

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                    <li><a href="/auth/login">{{trans('messages.login')}}</a></li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="glyphicon glyphicons-globe caret"></span></a>
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
