@extends('app')
@section('mytasks')
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
        margin-bottom: 2%;
    }
    .buttonEdit{
        background: #b3c6ff;  
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
                        <h2>{{trans('messages.myTasks')}}</h2>
                    </center>
                    @if(!empty($tasks))
                    <div class="table-responsive">
                        <table id="tasksTable" class="display" style="border: solid;
                               border-width: 0.8px;border-color:#979797;">
                            <thead>
                                <tr style="background-color: #b3b3b3; ">
                                    <th>{{trans('messages.taskName')}}</th>
                                    <th>{{trans('messages.tutor')}}</th>                                   
                                    <th>{{trans('messages.description')}}</th>
                                    <th>{{trans('messages.sentAt')}}</th>
                                    <th>{{trans('messages.endDate')}}</th>
                                    <th>{{trans('messages.course')}}</th>
                                    <th>{{trans('messages.group')}}</th>
                                    <th>{{trans('messages.solution')}}</th>
                                    <th>{{trans('messages.uploadSolution')}}</th>
                                    <th>{{trans('messages.helpMaterials')}}</th>
                                    <th>{{trans('messages.review')}}</th>
                                    <th>{{trans('messages.grade')}}</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach($tasks as $task)
                                <tr>                                   
                                    <td style="word-wrap: break-word;"><a href='{{url('mytasks')}}/{{$task->task_id}}'>{{$task->name}}</a></td>
                                    <td style="word-wrap: break-word;">{{$task->tutor_name}}</td>
                                    <td style="word-wrap: break-word;">{{$task->description}}</td>
                                    <td style="word-wrap: break-word;">{{$task->sent_at}}</td>
                                    <td style="word-wrap: break-word;">{{$task->end_date}}</td>
                                    <td style="word-wrap: break-word;">{{$task->course_name}}</td>
                                    <td style="word-wrap: break-word;">{{$task->group}}</td>
                                    @if(!empty($task->file_id))
                                    <td style="word-wrap: break-word;">
                                        <button type="button" class="buttonEdit" style="float:right;"  id="seeSolution{{$task->task_id}}">
                                            <span class="glyphicon glyphicon-check"></span>
                                        </button>     
                                    </td>
                                    @else
                                    <td style="word-wrap: break-word;">
                                        <button type="button" class="buttonEdit" style="float:right;"  id="noSolution{{$task->task_id}}">
                                            <span class="glyphicon glyphicon-unchecked"></span>
                                        </button>     
                                    </td>
                                    @endif
                                    <td style="word-wrap: break-word;">
                                        <button type="button" class="buttonEdit" style="float:right;"  id="uploadFile{{$task->task_id}}">
                                            <span class="glyphicon glyphicon-upload"></span>
                                        </button>
                                    </td>
                                    <td style="word-wrap: break-word;">
                                        <button type="button" class="buttonEdit" style="float:right;"  id="filesForTask{{$task->task_id}}">
                                            <span class="glyphicon glyphicon-file"></span>
                                        </button>
                                    </td>  
                                    @if(!($task->uploaded_review->isEmpty()))
                                    <td style="word-wrap: break-word;">
                                         <button type="button" class="buttonEdit" style="float:right;"  id="reviews{{$task->task_id}}">
                                            <span class="glyphicon glyphicon-thumbs-up"></span>
                                        </button>    
                                    </td>
                                    @else
                                    <td style="word-wrap: break-word;">
                                        <button type="button" class="buttonEdit" style="float:right;"  id="noReview{{$task->task_id}}">
                                            <span class="glyphicon glyphicon-unchecked"></span>
                                        </button>     
                                    </td>
                                    @endif
                                    @if( !empty( $task->grade) )
                                    <td style="word-wrap: break-word;">
                                        <center style="font-weight:bold;">
                                       {{$task->grade}}
                                        </center>
                                    </td>
                                    @else
                                   <td style="word-wrap: break-word;">
                                       <center style="font-weight:bold;">
                                        X   
                                        </center>
                                    </td>
                                    @endif

                            <div id="dialog{{$task->task_id}}" title="{{trans('messages.noSolution')}}" style="display:none;max-width:400px;word-wrap: break-word;">
                                <h5>{{trans('messages.noUploadedSolution')}}</h5>
                            </div>
                            <div id="dialogReview{{$task->task_id}}" title="{{trans('messages.noReview')}}" style="display:none;max-width:400px;word-wrap: break-word;">
                                <h5>{{trans('messages.noUploadedReview')}}</h5>
                            </div>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    @else
                    <div>
                        <center>
                            <h5>
                                {{trans('messages.noTasksFound')}}
                                
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
    $('#tasksTable').DataTable();
    //hide datatable info tag
    $('.dataTables_info').hide();
<?php foreach ($tasks as $task) {
    if ($task->active==false) {
        ?>
            $("#uploadFile{{$task->task_id}}").attr('disabled', true);
            $("#uploadFile{{$task->task_id}}").css('background', '#ff8080');
    <?php } ?>

        $("#reviews{{$task->task_id}}").on("click", function () {
        location.href = "{{url("mytasks")}}" + "/" + "{{$task->task_id}}" + "/review";
        });
        $("#uploadFile{{$task->task_id}}").on("click", function () {
        location.href = "{{url("mytasks")}}" + "/" + "{{$task->task_id}}" + "/upload";
        });
        $("#filesForTask{{$task->task_id}}").on("click", function () {
        location.href = "{{url("mytasks")}}" + "/" + "{{$task->task_id}}" + "/helpmaterials";
        });
        $("#seeSolution{{$task->task_id}}").on("click", function () {
        location.href = "{{url("solution")}}" + "/" + "{{$task->file_id}}" + "/" + "{{ $task->solution_filename }}" + "/open";
        });
        $("#noSolution{{$task->task_id}}").on("click", function () {
        $("#dialog{{$task->task_id}}").dialog();
        });
        $("#noReview{{$task->task_id}}").on("click", function () {
        $("#dialogReview{{$task->task_id}}").dialog();
        });
<?php } ?>
    });
</script>
@stop