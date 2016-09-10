@extends('app')
@section('students_to_task')
<style>
    .buttonEdit{
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
                    <button type="button" class="btn button" id="back" style="margin-bottom:3%;">{{trans('messages.goToTasks')}}</button>
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(!(empty($students)))
                    <center>
                         <h2>{{trans('messages.studentsForTask')}} {{$task->name}} </h2>

                    </center>
                    <div class="table-responsive">
                        <table id="usersToGroupTable" class="display" style="border: solid;
                               border-width: 0.8px;border-color:#979797;">
                            <thead>
                                <tr style="background-color: #b3b3b3; ">
                                    <th>{{trans('messages.facultyNumber')}}</th>
                                    <th>{{trans('messages.forename')}}</th>
                                    <th>{{trans('messages.familyName')}}</th>        
                                    <th>{{trans('messages.ready')}}</th>
                                    <th>{{trans('messages.solution')}}</th>
                                    <th>{{trans('messages.review')}}</th>
                                    <th>{{trans('messages.grade')}}</th>
                                </tr>
                            </thead>
                            <tbody>                             
                                @foreach($students as $student)
                                <tr>
                                    <td style="max-width:100px!important;word-wrap: break-word;">{{$student->username}}</td>

                                    <td style="max-width:100px;">{{$student->forename}}</td>
                                    <td style="max-width:100px;">{{$student->familyName}}</td>
                                    <td style="max-width:100px;"><input type="checkbox" disabled name="ready" id='readyTask{{$student->id}}' value="{{$student->ready}}"></td>
                                    @if( !empty( $student->solution) )
                                    <td style="word-wrap: break-word;">
                                        <button type="button" class="buttonEdit" style="float:right;" >
                                            <a href="/tasks/solution/{{ $student->solution->id}}/{{  $student->solution->filename }}/open"> <span class="glyphicon glyphicon-open"></span></a>
                                        </button>
                                    </td>
                                    @else
                                    <td style="word-wrap: break-word;">
                                        <button type="button" class="buttonEdit" style="float:right;"  id="noReview{{$student->id}}">
                                            <span class="glyphicon glyphicon-unchecked"></span>
                                        </button>     
                                    </td>
                                    @endif
                                    @if( !empty( $student->review_to_solution) )
                                    <td style="word-wrap: break-word;">
                                        <button type="button" class="buttonEdit" style="float:right;" >
                                            <a href="/myreviews/writerreview/{{ $student->review_to_solution->id}}/{{  $student->review_to_solution->filename }}/open"> <span class="glyphicon glyphicon-open"></span></a>
                                        </button>
                                    </td>
                                    @else
                                    <td style="word-wrap: break-word;">
                                        <button type="button" class="buttonEdit" style="float:right;"  id="noUploadedReview{{$student->id}}">
                                            <span class="glyphicon glyphicon-unchecked"></span>
                                        </button>     
                                    </td>
                                    @endif
                                    @if( !empty( $student->grade) )
                                    <td style="word-wrap: break-word;">
                                       {{$student->grade}}  
                                    </td>
                                    @else
                                   <td style="word-wrap: break-word;">
                                        <button type="button" class="buttonEdit" style="float:right;"  id="enterGrade{{$student->id}}">
                                            <span class="glyphicon glyphicon-arrow-up"></span>
                                        </button>     
                                    </td>
                                    @endif
                                   
                                </tr>
                            <div id="dialogReview{{$student->id}}" title="{{trans('messages.noReview')}}" style="display:none;max-width:400px;word-wrap: break-word;">
                                <h5>{{trans('messages.noUploadedReview')}}</h5>
                            </div>
                            <div id="grade{{$student->id}}" title="{{trans('messages.gradeForTask')}}{{$task->name}} " style="display:none;max-width:400px;word-wrap: break-word;">
                                {!!Form::open(['url' => 'storeGrade','id'=>'setGrade'])!!}
                                <h5>{{trans('messages.enterGrade')}}{{$student->username}}: </h5>
                                <div>
                                    <input type="text" class="form-control" name="grade" style="margin-bottom: 5%;"/>
                                    <input hidden class="form-control" name="task_id" value="{{$task->id}}" style="margin-bottom: 5%;"/>
                                    <input hidden class="form-control" name="student_id" value="{{$student->student_id}}" style="margin-bottom: 5%;"/>
                                </div>
                                <div >
                                    <input type="submit" name="submit" id='submit' class="btn button action-button floatRight" style="float: right;" value="{{trans('messages.submit')}}" />
                                </div>
                                {!!Form::close()!!}
                            </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <h2>{{trans('messages.noStudentsFound')}}</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $('#setGrade').validate({
            rules: {
                grade: {
                    required: true,
                }
            },
            // Specify the validation error messages
            messages: {
                name: {
                    required: "{{trans('messages.gradeRequired')}}",
                }
            }
        });


<?php foreach ($students as $student) { ?>
            if ($('#readyTask{{$student->id}}').val() == 0) {
                $('#readyTask{{$student->id}}')[0].checked = false;
            } else {
                $('#readyTask{{$student->id}}')[0].checked = true;
            }
            $("#noReview{{$student->id}}").on("click", function () {
                $("#dialogReview{{$student->id}}").dialog();
            });
            $("#noUploadedReview{{$student->id}}").on("click", function () {
                $("#dialogReview{{$student->id}}").dialog();
            });
            $("#enterGrade{{$student->id}}").on("click", function () {
                $("#grade{{$student->id}}").dialog();
            });

<?php } ?>


        //datatable create
        $('#usersToGroupTable').DataTable();
        //hide datatable info tag
        $('.dataTables_info').hide();
        $("#back").on("click", function () {
            location.href = "{{url("tasks")}}";
        });
    });
</script>
@stop