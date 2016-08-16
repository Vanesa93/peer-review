@extends('app')
@section('mycourses')
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
                        <h2>My Courses</h2>
                    </center>
                    <div class="table-responsive">
                        <table id="coursesTable" class="display" style="border: solid;
                               border-width: 0.8px;border-color:#979797;">
                            <thead>
                                <tr style="background-color: #b3b3b3;">
                                    <th>Tutor</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Duration</th>
                                    <th>Prerequisites</th>
                                    <th>Language</th>                                  
                                </tr>
                            </thead>
                            <tbody>

                                @if(!empty($courses))
                                @foreach($courses as $course)
                                <tr>
                                    <td style="max-width:60px!important;word-wrap: break-word;">{{$course->forename}} {{$course->familyName}}</td>
                                    <td style="max-width:60px!important;word-wrap: break-word;">{{$course->name}}</td>

                                    <td style="max-width:100px;">{{$course->description}}</td>

                                    <td style="max-width:40px;">{{$course->duration}}</td>

                                    <td style="max-width:60px;">{{$course->requirments}}</td>

                                    <td style="max-width:40px;">{{$course->language}}</td>                                  
                                </tr>  
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

    });
</script>
@stop