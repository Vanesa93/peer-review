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
                        <button type="button" class="btn button" id="create" >Create Course</button>
                    </div>
                    <center>
                        <h2>Courses</h2>
                    </center>

                    <table id="coursesTable" class="display table-responsive" style="border: solid;
                           border-width: 1px;">
                        <thead>
                            <tr style="background-color: #b3b3b3; ">
                                <th>Name</th>
                                <th>Description</th>
                                <th>Duration</th>
                                <th>Prerequisites</th>
                                <th>Language</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @if(!empty($courses))
                            @foreach($courses as $course)
                            <tr>
                                <td>{{$course->name}}</td>

                                <td>{{$course->description}}</td>

                                <td>{{$course->duration}}</td>

                                <td>{{$course->requirments}}</td>

                                <td>{{$course->language}}</td>
                                <td>
                                    <button type="button" class="buttonEdit" value="{{$course->id}}" id="edit{{$course->id}}">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </button>
                                </td>
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

<script>
    $(document).ready(function () {
        //datepicker
        $("#datepicker").datepicker("option", "dateFormat", 'd MM, y');
        //datatable create
        $('#coursesTable').DataTable();
        //hide datatable info tag
        $('.dataTables_info').hide();
        $("#create").on("click", function () {
            location.href = "{{url("courses/create")}}";
        });
        
       

    });
</script>
@stop