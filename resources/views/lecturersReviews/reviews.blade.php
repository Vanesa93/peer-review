@extends('app')
@section('reviews_lecturers')
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
                        <h2>{{trans('messages.questionaries')}}</h2>
                    </center>
                    <div class="row">
                        <button type="button" class="btn button" id="create" >{{trans('messages.createQuestionary')}}</button>
                    </div>
                    @if(!($lecturersReviews->isEmpty()))
                    <div class="table-responsive">
                        <table id="lecturersReviewsTable" class="display" style="border: solid;
                               border-width: 0.8px;border-color:#979797;">
                            <thead>
                                <tr style="background-color: #b3b3b3; ">
                                    <th>{{trans('messages.taskName')}}</th>
                                    <th>{{trans('messages.description')}}</th>
                                    <th>{{trans('messages.sentAt')}}</th>
                                    <th>{{trans('messages.endDate')}}</th>
                                    <th>{{trans('messages.questionary')}}</th>
                                    <th>{{trans('messages.edit')}}</th>
                                    <th>{{trans('messages.delete')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lecturersReviews as $lecturerReview)
                                <tr>
                                    <td style="max-width:100px!important;word-wrap: break-word;"><a href='{{url('task')}}/{{$lecturerReview->task_id}}'>{{$lecturerReview->task_name}}</a></td>
                                    <td style="max-width:150px!important;word-wrap: break-word;">{{$lecturerReview->description}}</td>
                                    <td style="word-wrap: break-word;">{{$lecturerReview->sent_at}}</td>
                                    <td style="word-wrap: break-word;">{{$lecturerReview->end_date}}</td>                                   
                                    <td style="word-wrap: break-word;">
<!--                                        <button type="button" >-->
                                           <a href="/file/{{$lecturerReview->file_id}}/{{ $lecturerReview->filename }}/open"  class="buttonEdit" style="float:right;"> <span class="glyphicon glyphicon-file"></span></a>
                                        <!--</button>-->
                                    </td>                                
                                    <td style="word-wrap: break-word;">
                                        <button type="button" class="buttonEdit" style="float:right;"  id="edit{{$lecturerReview->id}}">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </button>
                                    </td>
                                    <td>
                                        {!! Form::open(array('url' => 'task/remove/' . $lecturerReview->id)) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        <button type="button" class="buttonEdit" style="float:right;" id="delete{{$lecturerReview->id}}">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                <div id="dialog{{$lecturerReview->id}}" title="{{trans('messages.deleteQuestionary')}}" style="display:none;max-width:400px;word-wrap: break-word;">
                                <h5>{{trans('messages.areYouSureYouWantToDeleteTheseReviewTask')}}</h5>
                                <button type="button" class="button" style="float:right" id="onDelete{{$lecturerReview->id}}">
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
                                {{trans('messages.noQuestionariesFound')}}                              
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
    $('#lecturersReviewsTable').DataTable();
    //hide datatable info tag
    $('.dataTables_info').hide();
    $("#create").on("click", function () {
        location.href = "{{url("reviews/create")}}";
    });
    
    <?php foreach ($lecturersReviews as $lecturerReview) { ?>
         $("#uploadFile{{$lecturerReview->id}}").on("click", function () {
            location.href="{{url("tasks")}}"+"/"+"{{$lecturerReview->id}}"+"/upload";
        });
        $("#filesForTask{{$lecturerReview->id}}").on("click", function () {
            location.href="{{url("tasks")}}"+"/"+"{{$lecturerReview->id}}"+"/helpmaterials";
        });
        $("#edit{{$lecturerReview->id}}").on("click", function () {
            location.href = "{{url("reviews")}}"+"/"+"{{$lecturerReview->id}}"+"/edit";
        });
        $("#studentsForTask{{$lecturerReview->id}}").on("click", function () {
            location.href = "{{url("tasks")}}"+"/"+"{{$lecturerReview->id}}"+"/students";
        });
        $("#delete{{$lecturerReview->id}}").on("click", function () {
        $("#dialog{{$lecturerReview->id}}").dialog();
        });
        $("#onDelete{{$lecturerReview->id}}").on("click", function () {
        $.ajax({
        url: "{{url("reviews/remove/")}}" + "/" + "{{$lecturerReview -> id}}",
                type: 'delete',
                data: {_token: '{{csrf_token()}}', _method: 'delete'},
                success: function(){
                location.href = "{{url("reviews")}}";
                }
        });
        });
<?php } ?>
    });
</script>
@stop