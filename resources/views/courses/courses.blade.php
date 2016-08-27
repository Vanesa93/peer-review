@extends('app')
@section('courses')
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
    <div class="row">
        <div class="col-md-offset-1 col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
            <div class="panel panel-default" style="border-radius: 0px;">
                <div class="panel-body">
                    <div class="row">
                        <button type="button" class="btn button" id="create" >{{trans('messages.createCourse')}}</button>
                    </div>
                    <center>
                        <h2>Courses</h2>
                    </center>
                    <div class="table-responsive">
                        <table id="coursesTable" class="display" style="border: solid;
                               border-width: 0.8px;border-color:#979797;">
                            <thead>
                                <tr style="background-color: #b3b3b3; ">
                                    <th>{{trans('messages.name')}}</th>
                                    <th>{{trans('messages.description')}}</th>
                                    <th>{{trans('messages.duration')}}</th>
                                    <th>{{trans('messages.prerequisites')}}</th>
                                    <th>{{trans('messages.language')}}</th>
                                    <th>{{trans('messages.edit')}}</th>
                                    <th>{{trans('messages.delete')}}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if(!empty($courses))
                                @foreach($courses as $course)
                                <tr>
                                    <td style="max-width:60px!important;word-wrap: break-word;">{{$course->name}}</td>

                                    <td style="max-width:100px;">{{$course->description}}</td>

                                    <td style="max-width:40px;">{{$course->duration}}</td>

                                    <td style="max-width:60px;">{{$course->requirments}}</td>

                                    <td style="max-width:40px;">{{$course->language}}</td>
                                    <td>
                                        <button type="button" class="buttonEdit"  id="edit{{$course->id}}">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </button>
                                    </td>
                                    <td>
                                        {!! Form::open(array('url' => 'courses/remove/' . $course->id)) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        <button type="button" class="buttonEdit"  id="delete{{$course->id}}">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            <div id="dialog{{$course->id}}" title="{{trans('messages.deleteCourse')}}" style="display:none;max-width:400px;word-wrap: break-word;">
                                <h5>{{trans('messages.areYouSureYouWantToDeleteCourse')}} <b>{{$course->name}}<b> {{trans('messages.deleteWant')}}</h5>
                                            <button type="button" class="button" style="float:right" id="onDelete{{$course->id}}">
                                    {{trans('messages.delete')}}
                                </button>
                            </div>

                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
    //datatable create
    $('#coursesTable').DataTable();
    //hide datatable info tag
    $('.dataTables_info').hide();
    $("#create").on("click", function () {
    location.href = "{{url("courses/create")}}";
    });
<?php foreach ($courses as $course) { ?>
        $("#edit{{$course->id}}").on("click", function () {
        location.href = "{{url("courses/edit/")}}" + "/" + {{$course -> id}};
        });
        $("#delete{{$course->id}}").on("click", function () {
        $("#dialog{{$course->id}}").dialog();                  
        });
        $("#onDelete{{$course->id}}").on("click", function () {
            $.ajax({
    url: "{{url("courses/remove/")}}" + "/" + "{{$course -> id}}",
    type: 'delete',
    data: {_token: '{{csrf_token()}}' ,_method: 'delete'},
    success: function(){
                     location.href = "{{url("courses")}}";

    }
        });
        });
<?php } ?>



    });
</script>
@stop