@extends('app')
@section('edit_course')
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

                    <center>
                        <div class="form-group">
                            <h2 style="margin-left: -55%;">Edit course</h2> 

                        </div>
                        {!! Form::model($course, array('route' => array('updateCourse', $course->id), 'method' => 'PUT')) !!}
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> Course name</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> Description</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::textarea('description', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> Language</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('language', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> Duration</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('duration', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">Prerequisites</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('requirments', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 " style="margin-bottom: 1%;">
                                {!! Form::button('Back to courses', array('class' => 'btn buttonBack','id'=>'back')) !!}
                            </div>
                            <div class="col-md-6 " style="margin-bottom: 1%;">
                                {!! Form::submit('Update', array('class' => 'btn button')) !!}
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
            location.href = "{{url("courses")}}";
        });
    });
</script>
@stop