@extends('app')
@section('edit_faculty')
<style>
    .buttonBack{
        background-color: #999999!important;
        border: solid;
        border-width: 1px;
        color: white;
        padding: 12px 29px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-left: 2%;
        border-radius: 5px;
    }
    .button {
        background-color: #002b80; /* Green */
        border: solid;
        border-width: 1px;
        color: white;
        padding: 12px 29px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-left: 2%;
        border-radius: 5px;
    }

    .btn:hover, .btn:focus, .btn.focus {
        color: #99bbff; 
        text-decoration: none;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-offset-1 col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
            <div class="panel panel-default" style="border-radius: 0px;">
                <div class="panel-body">
 @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    <center>
                        <div class="form-group">
                            <center>
                            <h2 style="margin-left: -55%;"> {{trans('messages.editFaculty')}}</h2> 
                            </center>
                        </div>
                        {!! Form::model($faculty, array('route' => array('updateFaculty', $faculty->id), 'method' => 'PUT','id'=>'editFaculty')) !!}
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">  {{trans('messages.bulgarianName')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('bg_name', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">  {{trans('messages.englishName')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('en_name', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">  {{trans('messages.germanName')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('de_name', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>              
                        <div class="form-group">
                            <div class="col-md-6 " style="margin-bottom: 1%;">
                                {!! Form::button(trans('messages.goToFaculties'), array('class' => 'btn buttonBack','id'=>'back')) !!}
                            </div>
                            <div class="col-md-6 " style="margin-bottom: 1%;">
                                {!! Form::submit(trans('messages.update'), array('class' => 'btn button')) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </center>
                </div>

            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        $("#back").on("click", function () {
            location.href = "{{url("faculties")}}";
        });
        
            $('#editFaculty').validate({
        ignore: ":hidden",
        rules: {
            bg_name: {
                required: true
            },
             en_name: {
                required: true
            },
             de_name: {
                required: true
            }
        },
        // Specify the validation error messages
        messages: {
            bg_name: {
                required: "{{trans('messages.enterBgName')}}",
            },
             en_name: {
                required: "{{trans('messages.enterEnName')}}",
            },
             de_name: {
                required: "{{trans('messages.enterDeName')}}",
            },
           
        }
    });
    });
</script>
@stop