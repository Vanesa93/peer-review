@extends('app')
@section('faculties')
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
                        <div class='col-md-6'>
                            <button type="button" class="btn button" id="create" >Add Faculty</button>
                        </div>
                        <div class='col-md-6'>
                            <button type="button" class="btn button" id="createMajor" style="float:right;">Add Major To Faculty </button>
                        </div>
                    </div>

                    <center>
                        <h2>Faculties</h2>
                    </center>
                    <div class="table-responsive">
                        <table id="coursesTable" class="display" style="border: solid;
                               border-width: 0.8px;border-color:#979797;">
                            <thead>
                                <tr style="background-color: #b3b3b3; ">
                                    <th>Number</th>
                                    <th>Bulgarian name</th>
                                    <th>English name</th>
                                    <th>German name</th>
                                    <th>Majors</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if(!empty($faculties))
                                @foreach($faculties as $faculty)
                                <tr>
                                    <td style="max-width:60px!important;word-wrap: break-word;">{{$faculty->id}}</dtd>
                                    <td style="max-width:60px!important;word-wrap: break-word;">{{$faculty->bg_name}}</td>
                                    <td style="max-width:60px!important;word-wrap: break-word;">{{$faculty->en_name}}</td>
                                    <td style="max-width:60px!important;word-wrap: break-word;">{{$faculty->de_name}}</td>
                                    <td>
                                        <button type="button" class="buttonEdit"  id="seeMajor{{$faculty->id}}">
                                            <span class="glyphicon glyphicon-eye-open"></span>
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="buttonEdit"  id="edit{{$faculty->id}}">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </button>
                                    </td>
                                    <td>
                                        {!! Form::open(array('url' => 'faculty/remove/' . $faculty->id)) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        <button type="button" class="buttonEdit"  id="delete{{$faculty->id}}">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            <div id="dialog{{$faculty->id}}" title="Delete faculty?" style="display:none;max-width:400px;word-wrap: break-word;">
                                <h5>Are you sure you want to delete these faculty</h5>
                                <button type="button" class="button" style="float:right" id="onDelete{{$faculty->id}}">
                                    Delete
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
    //datepicker
    $("#datepicker").datepicker("option", "dateFormat", 'd MM, y');
    //datatable create
    $('#coursesTable').DataTable();
    //hide datatable info tag
    $('.dataTables_info').hide();
    $("#create").on("click", function () {
    location.href = "{{url("add / faculty")}}";
    });
    $("#createMajor").on("click", function () {
    location.href = "{{url("add / major ")}}";
    });
<?php foreach ($faculties as $faculty) { ?>
        $("#edit{{$faculty->id}}").on("click", function () {
        location.href = "{{url("faculty / edit / ")}}" + "/" + {{$faculty - > id}};
        });
        $("#seeMajor{{$faculty->id}}").on("click", function () {
        location.href = "{{url("majors")}}" + "/" + {{$faculty - > id}};
        });
        $("#delete{{$faculty->id}}").on("click", function () {
        $("#dialog{{$faculty->id}}").dialog();
        });
        $("#onDelete{{$faculty->id}}").on("click", function () {
        $.ajax({
        url: "{{url("faculty / remove / ")}}" + "/" + "{{$faculty -> id}}",
                type: 'delete',
                data: {_token: '{{csrf_token()}}', _method: 'delete'},
                success: function(){
                location.href = "{{url("faculties")}}";
                }
        });
        });
<?php } ?>



    });
</script>
@stop