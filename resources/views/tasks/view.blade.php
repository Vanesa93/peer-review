@extends('app')
@section('view_task')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<style>
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
        margin-bottom: 2%;
    }
    .buttonEdit{
        /*          background-color: #002b80;  Green */
        border: solid;
        border-width: 1px;
        color: white;
        padding: 5px 8px 4px 8px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border-radius: 5px;
    }
    .btn:hover, .btn:focus, .btn.focus {
        color: #99bbff; 
        text-decoration: none;
    }
</style>
<div class="container-fluid">
    {!!Form::open()!!}
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row">
        <div class="col-md-offset-1 col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
            <div class="panel panel-default" style="border-radius: 0px;">
                <div class="panel-body">
                    <center>
                        <h2 style="margin-bottom:2%;"> Details for task {{$task->name}}</h2>
                    </center>
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label">Task name</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            {!! Form::text('name', $task->name, array('class' => 'form-control')) !!}       
                        </div>
                    </div>   
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label">Task description</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            {!! Form::text('description', $task->description, array('class' => 'form-control')) !!}       
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label">Created at</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            {!! Form::text('sent_at', $task->sent_at, array('class' => 'form-control')) !!}       
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label">End date</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            {!! Form::text('end_date', $task->end_date, array('class' => 'form-control')) !!}       
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label">Course</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            {!! Form::text('course_id', $task->course_name, array('class' => 'form-control')) !!}       
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label">Group</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            {!! Form::text('group_id', $task->group_name, array('class' => 'form-control')) !!}       
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label">Students</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            <button type="button" class="buttonEdit" style="float:left;"  id="studentsForTask{{$task->id}}">
                                <span class="glyphicon glyphicon-user"></span>
                            </button>                        
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label">Files</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            <button type="button" class="buttonEdit" style="float:left;"  id="filesForTask{{$task->id}}">
                                <span class="glyphicon glyphicon-file"></span>
                            </button>                      
                        </div>
                    </div>


                    <input type="hidden" name="_token" id="csrf-token" value="{{ \Session::token() }}" />
                    <div class="form-group">
                        <div class="col-md-6 " style="margin-bottom: 1%;">
                            <input type="button" name="button" id='back' class="btn buttonBack action-button floatRight" style="float: left;" value="Go to tasks" />
                        </div>
                        <div class="col-md-6  " style="margin-bottom: 1%;">
                            <input type="submit" name="submit" id='submit' class="btn button action-button floatRight" style="float: right;" value="Submit" />
                        </div>
                    </div>


                </div>
            </div>  

        </div>
    </div>
    {!!Form::close()!!}
</div>
<script>
    $(document).ready(function () { 

    $('#back').on('click', function () {
        location.href = '{{url("tasks")}}';
    });
        $("#filesForTask{{$task->id}}").on("click", function () {
            location.href="{{url("tasks")}}"+"/"+"{{$task->id}}"+"/helpmaterials";
        });
        $("#studentsForTask{{$task->id}}").on("click", function () {
            location.href = "{{url("tasks")}}"+"/"+"{{$task->id}}"+"/students";
        });

    });
</script>
@stop