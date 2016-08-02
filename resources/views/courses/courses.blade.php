@extends('app')
@section('courses')

<div class="container-fluid">

    <div class="row">
        <div class="col-md-offset-1 col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
            <div class="panel panel-default" style="border-radius: 0px;">
                <div class="panel-body">
                    <center>
                        <h2 style="margin-bottom: 2%;">Courses</h2>
                    </center>
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label"> Course name</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            <input type="text" id='course_name' class="form-control" name="name">
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label"> Description</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            <textarea  type="text" id='description' class="form-control" name="description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-offset-3 col-md-2 control-label">Language</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            <input type="text" id='language' class="form-control" name="language">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-offset-3 col-md-2 control-label">Start date</label>

                        <div class='input-group date'>
                            <input type='text' class="form-control" data-provide="datepicker" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $("#datepicker").datepicker("option", "dateFormat", 'd MM, y');
    });
</script>
@stop