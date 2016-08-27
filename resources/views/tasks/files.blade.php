@extends('app')
@section('lecturer_file')
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
                    <div class="row">
                        <div class="col-md-6 " style="margin-bottom: 1%;">
                            <input type="button" name="button" id='back' class="btn buttonBack action-button floatRight" style="float: left;" value="{{trans('messages.goToTasks')}}" />
                        </div>
                         <div class="col-md-6 " style="margin-bottom: 1%;">
                            <input type="button" name="button" id='upload' class="btn buttonBack action-button floatRight" style="float: right;background-color: #5cb85c!important;color:white" value="{{trans('messages.goToUpload')}}" />
                        </div>
                       
                    </div>
                    <center>
                        <h2 style="margin-bottom:2%;"> {{trans('messages.helpMaterialsForTask')}}{{$task->name}}</h2>
                    </center>
                    {!!Form::open(['url' => 'files','id'=>'filesLecturer','files'=>'true'])!!}
                    <input type="hidden" id="token" name="token" value="{{ csrf_token() }}">
                    @if(!($files->isEmpty()))
                    <table class="table ">
                        @foreach($files as $file)                        
                        <tr>
                            <td><a href="/file/{{$file->id}}/{{ $file->filename }}/open">{{ $file->filename }}</a></td>
                            <td style="float:right"><button type="button" class="btn btn-sm btn-danger" id="delete{{$file->id}}" >{{trans('messages.remove')}}</button></td>
                        </tr>
                        
                        <div id="dialog{{$file->id}}" title="{{trans('messages.deleteHelpMaterial')}}?" style="display:none;max-width:400px;word-wrap: break-word;">
                                <h5>{{trans('messages.areYouSureYouWantToDeleteTheseHelpMaterial')}}</h5>
                                <button type="button" type="button" class="button" style="float:right" id="onDelete{{$file->id}}">
                                    {{trans('messages.delete')}}
                                </button>
                            </div>
                        @endforeach
                    </table>
                    @else
                    <h4>{{trans('messages.noHelpMaterialsFound')}}</h4>
                    @endif
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {

    $('#back').on('click', function () {
        location.href = '{{url("tasks")}}';
    });
    $('#upload').on('click', function () {
        location.href = '{{url("tasks")}}'+"/"+{{$task->id}}+"/upload";
    });
    
    <?php foreach ($files as $file) { ?>       
        $("#delete{{$file->id}}").on("click", function () {
        $("#dialog{{$file->id}}").dialog();
        });
        $("#onDelete{{$file->id}}").on("click", function () {

        $.ajax({
        url: "{{url("file/remove/")}}" + "/" + "{{$file -> filename}}",
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