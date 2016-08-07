@extends('app')
@section('users')
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
<div id="dialog" title="Basic dialog" style="display:none;">
    <p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-offset-1 col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
            <div class="panel panel-default" style="border-radius: 0px;">
                <div class="panel-body">
                    <div class="row">
                        <button type="button" class="btn button" id="create" >Register user</button>
                    </div>
                    <center>
                        <h2>Lecturers</h2>
                    </center>
                    <div class="table-responsive">
                        <table id="lecturersTable" class="display" style="border: solid;
                               border-width: 0.8px;border-color:#979797;">
                            <thead>
                                <tr style="background-color: #b3b3b3; ">
                                   <th>Username</th>
                                    <th>Forename</th>
                                    <th>Family Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Degree</th>
                                    <th>Mobile</th>
                                    <th>Cabinet Number</th>                                    
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @if(!empty($lecturers))
                                @foreach($lecturers as $lecturer)
                                <tr>
                                    <td style="max-width:60px!important;word-wrap: break-word;">{{$lecturer->username}}</td>


                                    <td style="max-width:40px;">{{$lecturer->forename}}</td>

                                    <td style="max-width:60px;">{{$lecturer->familyName}}</td>

                                    <td style="max-width:40px;">{{$lecturer->email}}</td>
                                    <td style="max-width:40px;">{{$lecturer->department}}</td>
                                    <td style="max-width:40px;">{{$lecturer->degree}}</td>
                                    <td style="max-width:40px;">{{$lecturer->mobile}}</td>
                                    <td style="max-width:40px;">{{$lecturer->cabinet}}</td>
                                    <td>
                                        <button type="button" class="buttonEdit"  id="editLecturer{{$lecturer->user_id_lecturer}}">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </button>
                                    </td>
                                    <td>
                                        {!! Form::open(array('url' => 'courses/remove/' . $lecturer->user_id_lecturer)) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        <button type="button" class="buttonEdit"  id="deleteLecturer{{$lecturer->user_id_lecturer}}">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            <div id="dialogLecturer{{$lecturer->user_id_lecturer}}" title="Delete course?" style="display:none;max-width:400px;word-wrap: break-word;">
                                <h5>Are you sure you want to delete lecturer <b>{{$lecturer->username}}<b></h5>
                                            <button type="button" class="button" style="float:right" id="onDeleteLecturer{{$lecturer->user_id_lecturer}}">
                                    Delete
                                </button>
                            </div>

                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <center>
                        <h2>Students</h2>
                    </center>
                     <div class="table-responsive">
                        <table id="studentsTable" class="display" style="border: solid;
                               border-width: 0.8px;border-color:#979797;">
                            <thead>
                                <tr style="background-color: #b3b3b3; ">
                                    <th>Faculty Number</th>
                                    <th>Forename</th>
                                    <th>Family Name</th>
                                    <th>Email</th>
                                    <th>Faculty</th>
                                    <th>First year</th>
                                    <th>Semester</th>
                                    <th>Group</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @if(!empty($students))
                                @foreach($students as $student)
                                <tr>
                                    <td style="max-width:60px!important;word-wrap: break-word;">{{$student->username}}</td>

                                    <td style="max-width:100px;">{{$student->forename}}</td>

                                    <td style="max-width:40px;">{{$student->familyName}}</td>

                                    <td style="max-width:60px;">{{$student->email}}</td>

                                    <td style="max-width:40px;">{{$student->faculty}}</td>
                                    <td style="max-width:40px;">{{$student->year}}</td>
                                    <td style="max-width:40px;">{{$student->semester}}</td>
                                    <td style="max-width:40px;">{{$student->group}}</td>
                                    <td>
                                        <button type="button" class="buttonEdit"  id="editStudent{{$student->user_id_students}}">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </button>
                                    </td>
                                    <td>
                                        {!! Form::open(array('url' => 'courses/remove/' . $student->user_id_students)) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        <button type="button" class="buttonEdit"  id="deleteStudent{{$student->user_id_students}}">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            <div id="dialogStudent{{$student->user_id_students}}" title="Delete course?" style="display:none;max-width:400px;word-wrap: break-word;">
                                <h5>Are you sure you want to delete student <b>{{$student->username}}<b></h5>
                                            <button type="button" class="button" style="float:right" id="onDeleteStudent{{$student->user_id_students}}">
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
    $('#lecturersTable').DataTable();
    $('#studentsTable').DataTable();
    //hide datatable info tag
    $('.dataTables_info').hide();
    $("#create").on("click", function () {
    location.href = "{{url("register")}}";
    });
<?php foreach ($lecturers as $lecturer) { ?>
        $("#editLecturer{{$lecturer->user_id_lecturer}}").on("click", function () {
        location.href = "{{url("users/edit/")}}" + "/" + {{$lecturer -> user_id_lecturer}};
        });
        $("#editStudent{{$student->user_id_students}}").on("click", function () {
        location.href = "{{url("users/edit/")}}" + "/" + {{$student -> user_id_students}};
        });
//        $("#deleteLecturer{{$lecturer->id}}").on("click", function () {
//        $("#dialoglecturer{{$lecturer->id}}").dialog();                  
//        });
//        $("#onDeleteLecturer{{$lecturer->id}}").on("click", function () {
//            $.ajax({
//    url: "{{url("courses/remove/")}}" + "/" + "{{$lecturer -> id}}",
//    type: 'delete',
//    data: {_token: '{{csrf_token()}}' ,_method: 'delete'},
//    success: function(){
//                     location.href = "{{url("courses")}}";
//
//    }
//        });
//        });
<?php } ?>



    });
</script>
@stop