@extends('app')
@section('courses')

<div class="container-fluid">
   
    <div class="row">
        <div class="col-md-offset-1 col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
            <div class="panel panel-default" style="border-radius: 0px;">
                <div class="panel-body">
                    <center>
                    <h2>Courses</h2>
                    </center>
                    
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