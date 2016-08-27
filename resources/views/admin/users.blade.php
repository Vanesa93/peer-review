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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-offset-1 col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
            <div class="panel panel-default" style="border-radius: 0px;">
                <div class="panel-body">
                    <div class="row">
                        <button type="button" class="btn button" id="create" >{{trans('messages.registerUser')}}</button>
                    </div>
                    <center>
                        <h2>{{trans('messages.lecturers')}}</h2>
                    </center>
                    <div class="table-responsive">
                        <table id="lecturersTable" class="display" style="border: solid;
                               border-width: 0.8px;border-color:#979797;">
                            <thead>
                                <tr style="background-color: #b3b3b3; ">
                                   <th>{{trans('messages.username')}}</th>
                                    <th>{{trans('messages.forename')}}</th>
                                    <th>{{trans('messages.familyName')}}</th>
                                    <th>{{trans('messages.email')}}</th>
                                    <th>{{trans('messages.department')}}</th>
                                    <th>{{trans('messages.degree')}}</th>
                                    <th>{{trans('messages.mobile')}}</th>
                                    <th>{{trans('messages.cabinetNumber')}}</th>                                    
                                    <th>{{trans('messages.edit')}}</th>
                                    <th>{{trans('messages.delete')}}</th>
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
                                    <div id="dialogLecturer{{$lecturer->user_id_lecturer}}" title="{{trans('messages.deleteLecturer')}}" style="display:none;max-width:400px;word-wrap: break-word;">
                                <h5>{{trans('messages.areYouSureYouWantToDeleteLecturer')}}<b>{{$lecturer->username}}<b></h5>
                                            <button type="button" class="button" style="float:right" id="onDeleteLecturer{{$lecturer->user_id_lecturer}}">
                                    {{trans('messages.delete')}}
                                </button>
                            </div>

                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <center>
                        <h2>{{trans('messages.students')}}</h2>
                    </center>
                     <div class="table-responsive">
                        <table id="studentsTable" class="display" style="border: solid;
                               border-width: 0.8px;border-color:#979797;">
                            <thead>
                                <tr style="background-color: #b3b3b3; ">
                                    <th>{{trans('messages.facultyNumber')}}</th>
                                    <th>{{trans('messages.forename')}}</th>
                                    <th>{{trans('messages.familyName')}}</th>
                                    <th>{{trans('messages.email')}}</th>
                                    <th>{{trans('messages.faculty')}}</th>
                                    <th>{{trans('messages.major')}}</th>
                                    <th>{{trans('messages.year')}}</th>
                                    <th>{{trans('messages.semester')}}</th>
                                    <th>{{trans('messages.group')}}</th>
                                    <th>{{trans('messages.mobile')}}</th>
                                    <th>{{trans('messages.edit')}}</th>
                                    <th>{{trans('messages.delete')}}</th>
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
                                     <td style="max-width:40px;">{{$student->major}}</td>
                                    <td style="max-width:40px;">{{$student->year}}</td>
                                    <td style="max-width:40px;">{{$student->semester}}</td>
                                    <td style="max-width:40px;">{{$student->group}}</td>
                                    <td style="max-width:40px;">{{$student->mobile}}</td>
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
                            <div id="dialogStudent{{$student->user_id_students}}" title="{{trans('messages.deleteStudent')}}" style="display:none;max-width:400px;word-wrap: break-word;">
                                <h5>{{trans('messages.areYouSureDeleteStudent')}} <b>{{$student->username}}<b></h5>
                                            <button type="button" class="button" style="float:right" id="onDeleteStudent{{$student->user_id_students}}">
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
        $("#deleteLecturer{{$lecturer->user_id_lecturer}}").on("click", function () {
            $("#dialogLecturer{{$lecturer->user_id_lecturer}}").dialog();                  
            });
        $("#onDeleteLecturer{{$lecturer->user_id_lecturer}}").on("click", function () {
            $.ajax({
                    url: "{{url("users/remove/")}}" + "/" + "{{$lecturer -> user_id_lecturer}}",
                    type: 'delete',
                    data: {_token: '{{csrf_token()}}' ,_method: 'delete'},
                    success: function(){
                                     location.href = "{{url("users")}}";
                    }
            });
        });
        <?php } ?>
        <?php foreach ($students as $student) { ?>
        $("#editStudent{{$student->user_id_students}}").on("click", function () {
        location.href = "{{url("users/edit/")}}" + "/" + {{$student -> user_id_students}};
        });
         $("#deleteStudent{{$student->user_id_students}}").on("click", function () {
            $("#dialogStudent{{$student->user_id_students}}").dialog();                  
            });
                $("#onDeleteStudent{{$student->user_id_students}}").on("click", function () {
            $.ajax({
                    url: "{{url("users/remove/")}}" + "/" + "{{$student -> user_id_students}}",
                    type: 'delete',
                    data: {_token: '{{csrf_token()}}' ,_method: 'delete'},
                    success: function(){
                                     location.href = "{{url("users")}}";
                    }
            });
        });

<?php } ?>
    });
</script>
@stop