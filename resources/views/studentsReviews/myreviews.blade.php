@extends('app')
@section('myreviews')
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
                        <h2>{{trans('messages.reviewTasks')}}</h2>
                    </center>               
                    @if(!($reviews->isEmpty()))
                    <div class="table-responsive">
                        <table id="lecturersReviewsTable" class="display" style="border: solid;
                               border-width: 0.8px;border-color:#979797;">
                            <thead>
                                <tr style="background-color: #b3b3b3; ">
                                    <th>{{trans('messages.taskName')}}</th>
                                    <th>{{trans('messages.sentAt')}}</th>
                                    <th>{{trans('messages.questionaryToFill')}}</th>
                                    <th>{{trans('messages.solutionToReview')}}</th>
                                    <th>{{trans('messages.uploadReview')}}</th>
                                    <th>{{trans('messages.openReviewSolution')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reviews as $review)
                                <tr>
                                    <td style="word-wrap: break-word;"><a href='{{url('mytasks')}}/{{$review->task_id}}'>{{$review->task_name}}</a></td>
                                    <td style="word-wrap: break-word;">{{$review->sent_at}}</td>
                                    <td style="word-wrap: break-word;">
                                        <button type="button" class="buttonEdit" style="float:right;" >
                                            <a href="myreviews/questionary/{{$review->questionary->id}}/{{ $review->questionary->filename }}/open"> <span class="glyphicon glyphicon-file"></span></a>
                                        </button>
                                    </td> 
                                    <td style="word-wrap: break-word;">
                                        <button type="button" class="buttonEdit" style="float:right;" >
                                            <a href="/myreviews/solutionreview/{{$review->review_file->id}}/{{ $review->review_file->filename }}/open"> <span class="glyphicon glyphicon-file"></span></a>
                                        </button>
                                    </td>  
                                    <td style="word-wrap: break-word;">
                                        <button type="button" class="buttonEdit" style="float:right;" id='uploadFile{{$review->id}}'>
                                            <a href="/myreviews/upload/review/{{$review->id}}" id="uploadFileHref{{$review->id}}"> <span class="glyphicon glyphicon-upload"></span></a>
                                        </button>
                                    </td> 
                                    @if( !empty($review->uploaded_solution) )
                                    <td style="word-wrap: break-word;">
                                        <button type="button" class="buttonEdit" style="float:right;" >
                                            <a href="/myreviews/writerreview/{{ $review->uploaded_solution->id}}/{{  $review->uploaded_solution->filename }}/open"> <span class="glyphicon glyphicon-open"></span></a>
                                        </button>
                                    </td>
                                    @else
                                     <td style="word-wrap: break-word;">
                                        <button type="button" class="buttonEdit" style="float:right;"  id="noReview{{$review->id}}">
                                            <span class="glyphicon glyphicon-unchecked"></span>
                                        </button>     
                                    </td>
                                    @endif
                            <div id="dialogReview{{$review->id}}" title="{{trans('messages.noReview')}}" style="display:none;max-width:400px;word-wrap: break-word;">
                                <h5>{{trans('messages.noUploadedReview')}}</h5>
                            </div>

                            {!! Form::close() !!}
                            </tr>                             
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div>
                        <center>
                            <h5>
                                {{trans('messages.noUploadedReview')}}
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

<?php
foreach ($reviews as $review) {
    if ($review->lecturersReviewActive == 0) {
        ?>
                $("#uploadFile{{$review->id}}").attr('disabled', true);
                $("#uploadFileHref{{$review->id}}").attr('href', "");
                $("#uploadFile{{$review->id}}").css('background', '#ff8080');
    <?php } ?>
            $("#filesForTask{{$review->id}}").on("click", function () {
                location.href = "{{url("tasks")}}" + "/" + "{{$review->id}}" + "/helpmaterials";
            });
            
            $("#noReview{{$review->id}}").on("click", function () {
        $("#dialogReview{{$review->id}}").dialog();
        });

<?php } ?>
    });
</script>
@stop
