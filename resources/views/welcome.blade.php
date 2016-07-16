@extends('app')
@section('welcome')

<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
<link href='{{ URL::asset('styles/welcome.css')}}' rel='stylesheet' type='text/css'>
<div class="wrapper" >
        <img src="{{ URL::asset('images/welcomeBanner.jpg')}}" alt="" class="welcomeBanner">
    </div>
<div class="container-fluid">
   
    <div class="row">
        <div class="col-md-offset-1 col-md-10 col-md-offset-1">
            <div class="panel panel-default" style="border-radius: 0px;">
                <div class="panel-body">
                    <div class="title">{{trans('messages.welcome')}}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop