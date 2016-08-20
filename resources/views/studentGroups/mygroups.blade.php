@extends('app')
@section('mygroups')
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
                        <h2>My groups</h2>
                    </center>

                    @if(!empty($groups))
                    <div class="table-responsive">
                        <table id="groupsTable" class="display" style="border: solid;
                               border-width: 0.8px;border-color:#979797;">
                            <thead>
                                <tr style="background-color: #b3b3b3; ">
                                    <th>Tutor name</th>
                                    <th>Group name</th>
                                    <th>Course name</th>
                                    <th>Faculty name</th>
                                    <th>Major name</th>
                                    <th>Student year</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach($groups as $group)
                                <tr>
                                    <td style="max-width:60px!important;word-wrap: break-word;">{{$group->tutor_name}}</td>
                                    <td style="max-width:60px!important;word-wrap: break-word;">{{$group->name}}</td>
                                    <td style="max-width:60px!important;word-wrap: break-word;">{{$group->course_name}}</td>
                                    <td style="max-width:60px!important;word-wrap: break-word;">{{$group->faculty_name}}</td>
                                    <td style="max-width:60px!important;word-wrap: break-word;">{{$group->major_name}}</td>
                                    <td style="max-width:60px!important;word-wrap: break-word;">{{$group->student_first_year}}</td>                                  

                                </tr>
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
    });
</script>
@stop