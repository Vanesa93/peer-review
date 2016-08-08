@extends('app')
@section('majors')

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
                        <button type="button" class="btn button" id="create" >Add Major To Faculty </button>
                    </div>
                    @if(!empty($majors) AND !(empty($faculty)))
                    <center>
                        <h2>Majors for faculty {{$facultyName}}</h2>
                    </center>
                    <div class="table-responsive">
                        <table id="coursesTable" class="display" style="border: solid;
                               border-width: 0.8px;border-color:#979797;">
                            <thead>
                                <tr style="background-color: #b3b3b3; ">
                                    <th>Bulgarian name</th>
                                    <th>English name</th>
                                    <th>German name</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                
                                @foreach($majors as $major)
                                <tr>
                                    <td style="max-width:60px!important;word-wrap: break-word;">{{$major->bg_name}}</td>
                                    <td style="max-width:60px!important;word-wrap: break-word;">{{$major->en_name}}</td>
                                    <td style="max-width:60px!important;word-wrap: break-word;">{{$major->de_name}}</td>

                                    <td>
                                        <button type="button" class="buttonEdit"  id="edit{{$major->id}}">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </button>
                                    </td>
                                    <td>
                                        {!! Form::open(array('url' => 'major/remove/' . $major->id)) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        <button type="button" class="buttonEdit"  id="delete{{$major->id}}">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            <div id="dialog{{$major->id}}" title="Delete course?" style="display:none;max-width:400px;word-wrap: break-word;">
                                <h5>Are you sure you want to delete these major</h5>
                                <button type="button" class="button" style="float:right" id="onDelete{{$major->id}}">
                                    Delete
                                </button>
                            </div>

                            @endforeach
                            
                            </tbody>
                        </table>
                    </div>
@endif
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
    location.href = "{{url("add/major")}}";
    });
<?php foreach ($majors as $major) { ?>
        $("#edit{{$major->id}}").on("click", function () {
        location.href = "{{url("major/edit")}}" +"/"+ {{$major -> id}};
        });
        $("#delete{{$major->id}}").on("click", function () {
        $("#dialog{{$major->id}}").dialog();
        });
        $("#onDelete{{$major->id}}").on("click", function () {
        $.ajax({
        url: "{{url("major/remove/")}}" + "/" + "{{$major->id}}",
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