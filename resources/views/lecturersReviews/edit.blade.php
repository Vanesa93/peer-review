@extends('app')
@section('edit_lecturer_review')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<style>
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
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <center>
                        <div class="form-group">
                            <h2 style="margin-left: -55%;">{{trans('messages.editQuestionary')}}</h2> 

                        </div>
                        {!! Form::model($lecturerReview, array('route' => array('updateLecturerReview', $lecturerReview->id), 'method' => 'PUT','id'=>'editLecturerReview','files' => true)) !!}
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.selectTask')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::select('task_id', $tasks, $lecturerReview->task_id,['class'=>'form-control','id'=>'selectLecturerReview'])!!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">{{trans('messages.description')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::textarea('description', null, array('class' => 'form-control')) !!}      

                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">{{trans('messages.uploadNewQuestionary')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <input type="file" class="btn  floatRight"  name="questionary"/>
                            </div>
                        </div> 
                        <div class="form-group" id="year" >
                            <label class="col-md-offset-3 col-md-2 control-label">{{trans('messages.endDate')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <div class="input-group input-append date" id="endDate">
                                    <input type="text" class="form-control" name="end_date" />
                                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                            <label for="end_date" generated="true" id="labelForYear" class="error"></label>
                        </div>                       


                        <div class="form-group">
                            <div class="col-md-6 " style="margin-bottom: 1%;">
                                {!! Form::button(trans('messages.goToReviews'), array('class' => 'btn buttonBack','id'=>'back')) !!}
                            </div>
                            <div class="col-md-6 " style="margin-bottom: 1%;">
                                {!! Form::submit(trans('messages.update'), array('class' => 'btn button')) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </center>
                </div>

            </div>

        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    var date = new Date("{{$lecturerReview->end_date}}");

    $("#endDate").datepicker({
        format: 'dd/mm/yyyy'
    });
    $("#endDate").datepicker().datepicker("setDate", date);

    $("#back").on("click", function () {
        location.href = "{{url("reviews")}}";
    });

    //select faculty on change

    $('#editLecturerReview').validate({
        rules: {
            task_id: {
                required: true,
                maxlength: 100
            },
            description: {
                maxlength: 100
            },
            end_date: {
                required: true,
                maxlength: 100
            },
        },
        // Specify the validation error messages
        messages: {
            task_id: {
                required: "{{trans('messages.taskRequired')}}",
                maxlength: "{{trans('messages.maxLenght100')}}"+100
            },
            description: {
                maxlength: "{{trans('messages.maxLenght100')}}"+100
            },
            end_date: {
                required: "{{trans('messages.endDateRequired')}}",
                maxlength: "{{trans('messages.maxLenght100')}}"+100
            }
        }
    });
});

</script>
@stop