@extends('app')
@section('create_reviews_lecturers')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
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

    .buttonBack{
        background-color: #999999!important;
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

    input[type="file"] {
        margin-left:-3.4%;

    }
    .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control .input-group-addon .add-on{
        cursor: pointer!important;
    }

</style>
<div class="container-fluid">
    {!!Form::open(['url' => 'storeLecturerReview','id'=>'createLecturerReview', 'files' => true])!!}
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row">
        <div class="col-md-offset-1 col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
            <div class="panel panel-default" style="border-radius: 0px;">
                <div class="panel-body">
                    <h2 style="margin-bottom: 2%;">Create review tasks</h2>                   

                    <div class="form-group" id="users">
                        <label class="col-md-offset-3 col-md-2 control-label"> Select task</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            <select class="form-control " id="selectTask" name="task_id"   style="width:250px;">
                                <option value="">Select task</option>
                                @foreach($tasks as $task)
                                <option value="{{$task->id}}">
                                    {{$task->name}}
                                </option>
                                @endforeach
                            </select>
                            <label for="task_id" generated="true" class="error"></label>

                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label">Description</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            <textarea class="form-control"  name="description"></textarea>
                        </div>
                        <label for="description" generated="true"  class="error"></label>
                    </div> 
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label">Upload questionary</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            <input type="file" class="btn  floatRight"  name="questionary"/>
                        </div>
                    </div> 
                    <div class="form-group" id="end_date" >
                        <label class="col-md-offset-3 col-md-2 control-label">End date</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            <div class="input-group input-append date" id="endDate">
                                <input type="text" class="form-control" name="end_date" readonly/>
                                <span class="input-group-addon add-on" style="cursor: pointer!important;"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>
                        <label for="end_date" generated="true" id="labelForYear" class="error"></label>
                    </div>  
                    <input type="hidden" name="_token" id="csrf-token" value="{{ \Session::token() }}" />
                    <div class="form-group">
                        <div class="col-md-6 " style="margin-bottom: 1%;">
                            <input type="button" name="button" id='back' class="btn buttonBack action-button floatRight" style="float: left;" value="Go to reviews" />
                        </div>
                        <div class="col-md-6  " style="margin-bottom: 1%;">
                            <input type="submit" name="submit" id='submit' class="btn button action-button floatRight" style="float: right;" value="Submit" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {

    $('#back').on('click', function () {
        location.href = '{{url("reviews")}}';
    });

    $("#endDate").datepicker({
    });
    
      $('#createLecturerReview').validate({
            rules: {
                task_id: {
                    required: true,
                    maxlength: 100
                },
                description:{
                    maxlength:100
                },
                end_date: {
                    required: true,
                    maxlength: 100
                }
            },
            // Specify the validation error messages
            messages: {
                task_id: {
                    required: "Please select task",
                    maxlength: 100
                },
                description:{
                    maxlength:100
                },
                end_date: {
                    required: "Please select end date",
                    maxlength: 100
                }
            }
        });
});
</script>
@stop