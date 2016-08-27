@extends('app')
@section('tasks')
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
                        <h2>{{trans('messages.tasks')}}</h2>
                    </center>
                    <div class="row">
                        <button type="button" class="btn button" id="create" >{{trans('messages.createTask')}}</button>
                    </div>
                    @if(!($tasks->isEmpty()))
                    <div class="table-responsive">
                        <table id="tasksTable" class="display" style="border: solid;
                               border-width: 0.8px;border-color:#979797;">
                            <thead>
                                <tr style="background-color: #b3b3b3; ">
                                    <th>{{trans('messages.taskName')}}</th>
                                    <th>{{trans('messages.description')}}</th>
                                    <th>{{trans('messages.sentAt')}}</th>
                                    <th>{{trans('messages.endDate')}}</th>
                                    <th>{{trans('messages.course')}}</th>
                                    <th>{{trans('messages.group')}}</th>
                                     <th>{{trans('messages.upload')}}</th>
                                    <th>{{trans('messages.helpMaterials')}}</th>
                                    <th>{{trans('messages.students')}}</th>
                                     <th>{{trans('messages.edit')}}</th>
                                    <th>{{trans('messages.delete')}}</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach($tasks as $task)
                                <tr>
                                    <td style="max-width:100px!important;word-wrap: break-word;"><a href='{{url('task')}}/{{$task->id}}'>{{$task->name}}</a></td>
                                    <td style="max-width:150px!important;word-wrap: break-word;">{{$task->description}}</td>
                                    <td style="word-wrap: break-word;">{{$task->sent_at}}</td>
                                    <td style="word-wrap: break-word;">{{$task->end_date}}</td>
                                    <td style="word-wrap: break-word;">{{$task->course_id}}</td>
                                    <td style="word-wrap: break-word;">{{$task->group}}</td>
                                    <td style="word-wrap: break-word;">
                                        <button type="button" class="buttonEdit" style="float:right;"  id="uploadFile{{$task->id}}">
                                            <span class="glyphicon glyphicon-upload"></span>
                                        </button>
                                    </td>
                                    <td style="word-wrap: break-word;">
                                        <button type="button" class="buttonEdit" style="float:right;"  id="filesForTask{{$task->id}}">
                                            <span class="glyphicon glyphicon-file"></span>
                                        </button>
                                    </td>
                                    <td style="word-wrap: break-word;">
                                        <button type="button" class="buttonEdit" style="float:right;"  id="studentsForTask{{$task->id}}">
                                            <span class="glyphicon glyphicon-user"></span>
                                        </button>
                                    </td>
                                    <td style="word-wrap: break-word;">
                                        <button type="button" class="buttonEdit" style="float:right;"  id="edit{{$task->id}}">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </button>
                                    </td>
                                    <td>
                                        {!! Form::open(array('url' => 'task/remove/' . $task->id)) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        <button type="button" class="buttonEdit" style="float:right;" id="delete{{$task->id}}">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            <div id="dialog{{$task->id}}" title="{{trans('messages.deleteTask')}}" style="display:none;max-width:400px;word-wrap: break-word;">
                                <h5>{{trans('messages.areYouSureYouWantToDeleteTheseTask')}}</h5>
                                <button type="button" class="button" style="float:right" id="onDelete{{$task->id}}">
                                    {{trans('messages.delete')}}
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
    $("#create").on("click", function () {
        location.href = "{{url("tasks/create")}}";
    });
    
    <?php foreach ($tasks as $task) { ?>
         $("#uploadFile{{$task->id}}").on("click", function () {
            location.href="{{url("tasks")}}"+"/"+"{{$task->id}}"+"/upload";
        });
        $("#filesForTask{{$task->id}}").on("click", function () {
            location.href="{{url("tasks")}}"+"/"+"{{$task->id}}"+"/helpmaterials";
        });
        $("#edit{{$task->id}}").on("click", function () {
            location.href = "{{url("tasks")}}"+"/"+"{{$task->id}}"+"/edit";
        });
        $("#studentsForTask{{$task->id}}").on("click", function () {
            location.href = "{{url("tasks")}}"+"/"+"{{$task->id}}"+"/students";
        });
        $("#delete{{$task->id}}").on("click", function () {
        $("#dialog{{$task->id}}").dialog();
        });
        $("#onDelete{{$task->id}}").on("click", function () {
        $.ajax({
        url: "{{url("tasks/remove/")}}" + "/" + "{{$task -> id}}",
                type: 'delete',
                data: {_token: '{{csrf_token()}}', _method: 'delete'},
                success: function(){
                location.href = "{{url("tasks")}}";
                }
        });
        });
<?php } ?>
    });
</script>
@stop