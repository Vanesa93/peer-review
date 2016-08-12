@extends('app')
@section('get_groups')

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
                  
                    <center>
                        <h2>Groups</h2>
                    </center>
                    <div class="row">
                        <button type="button" class="btn button" id="create" >Add Group</button>
                    </div>
                    @if(!($groups->isEmpty()))
                    <div class="table-responsive">
                        <table id="groupsTable" class="display" style="border: solid;
                               border-width: 0.8px;border-color:#979797;">
                            <thead>
                                <tr style="background-color: #b3b3b3; ">
                                    <th>Group name</th>
                                    <th>Course name</th>
                                    <th>Faculty name</th>
                                    <th>Major name</th>
                                    <th>Student year</th>
                                    <th>Students</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach($groups as $group)
                                <tr>
                                    <td style="max-width:60px!important;word-wrap: break-word;">{{$group->name}}</td>
                                    <td style="max-width:60px!important;word-wrap: break-word;">{{$group->course_id}}</td>
                                    <td style="max-width:60px!important;word-wrap: break-word;">{{$group->faculty_id}}</td>
                                    <td style="max-width:60px!important;word-wrap: break-word;">{{$group->major_id}}</td>
                                    <td style="max-width:60px!important;word-wrap: break-word;">{{$group->student_first_year}}</td>
                                    <td style="max-width:60px!important;word-wrap: break-word;">
                                        <button type="button" class="buttonEdit"  id="seeUsers{{$group->id}}">
                                            <span class="glyphicon glyphicon-eye-open"></span>
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="buttonEdit"  id="edit{{$group->id}}">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </button>
                                    </td>
                                    <td>
                                        {!! Form::open(array('url' => 'group/remove/' . $group->id)) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        <button type="button" class="buttonEdit"  id="delete{{$group->id}}">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            <div id="dialog{{$group->id}}" title="Delete group?" style="display:none;max-width:400px;word-wrap: break-word;">
                                <h5>Are you sure you want to delete these group?</h5>
                                <button type="button" class="button" style="float:right" id="onDelete{{$group->id}}">
                                    Delete
                                </button>
                            </div>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    @else
                    <div>
                        <center>
                        <h5>
                        No groups found.
                        You must have created faculties,majors and courses to  create groups.
                        </h5>
                            </center>
                    </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
    //datatable create
    $('#groupsTable').DataTable();
    //hide datatable info tag
    $('.dataTables_info').hide();
    $("#create").on("click", function () {
    location.href = "{{url("groups/create")}}";
    });
<?php foreach ($groups as $group) { ?>
        $("#seeUsers{{$group->id}}").on("click", function () {
        location.href = "{{url("groups")}}" + "/" + {{$group -> id}} + "/users";
        });
        $("#edit{{$group->id}}").on("click", function () {
        location.href = "{{url("groups/edit/")}}" + "/" + {{$group -> id}};
        });
        $("#delete{{$group->id}}").on("click", function () {
        $("#dialog{{$group->id}}").dialog();
        });
        $("#onDelete{{$group->id}}").on("click", function () {
        $.ajax({
        url: "{{url("groups/remove/")}}" + "/" + "{{$group -> id}}",
                type: 'delete',
                data: {_token: '{{csrf_token()}}', _method: 'delete'},
                success: function(){
                location.href = "{{url("groups")}}";
                }
        });
        });
<?php } ?>



    });
</script>

@stop