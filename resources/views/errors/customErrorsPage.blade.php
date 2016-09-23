@extends('app')
@section('custom_errors')
<style>
    @media screen and (min-width: 430px) {
        .title{
            font-size: 35px;
            color:silver;
            padding: 100px;
        }
    }
      @media screen and (max-width: 429px) {
        .title{
            font-size: 35px;
            color:silver;
            padding: 50px;
        }
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-offset-1 col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
            <div class="panel panel-default" style="border-radius: 0px;">
                <div class="panel-body">
                    <center>
                        <div class="title">
                            {{trans('messages.somethingWentWrong')}}                           
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@stop