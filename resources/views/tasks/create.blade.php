@extends('app')
@section('create_task')
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
</style>
<div class="container-fluid">
    {!!Form::open(['url' => 'storeTask','id'=>'createTask', 'files' => true])!!}
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
                        <h2 style="margin-bottom: 2%;">{{trans('messages.createTask')}}</h2>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">{{trans('messages.taskName')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <input type="text" class="form-control" id="enterYear" name="name"/>
                            </div>
                            <label for="name" generated="true"  class="error"></label>
                        </div>    
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">{{trans('messages.description')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <textarea class="form-control"  name="description"></textarea>
                            </div>
                            <label for="description" generated="true"  class="error"></label>
                        </div> 
                        <div class="form-group" id="year" >
                            <label class="col-md-offset-3 col-md-2 control-label">{{trans('messages.endDate')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <div class="input-group input-append date" id="endDate">
                                    <input type="text" class="form-control" name="end_date" readonly/>
                                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                            <label for="end_date" generated="true" id="labelForYear" class="error"></label>
                        </div>  
                        <div class="form-group" id="users">
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.selectCourse')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <select class="form-control " id="selectCourse" name="course_id"   style="width:250px;">
                                    <option value="">{{trans('messages.selectCourse')}}</option>
                                    @foreach($courses as $course)
                                    <option value="{{$course->id}}">
                                        {{$course->name}}
                                    </option>
                                    @endforeach
                                </select>
                                <label for="course_id" generated="true" class="error"></label>

                            </div>
                        </div>
                        <div class="form-group" id="users">
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.selectGroup')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <select class="form-control " id="selectGroups" name="group_id"   style="width:250px;" disabled>
                                    <option value="">{{trans('messages.selectGroup')}}</option>
                                    @foreach($groups as $group)
                                    <option value="{{$group->id}}">
                                        {{$group->name}}
                                    </option>
                                    @endforeach
                                </select>
                                <label for="course_id" generated="true" class="error"></label>

                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">{{trans('messages.uploadHelpMaterials')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                    <input type="file" class="btn  floatRight"  name="filefield"/>
                            </div>
                        </div> 

                        <input type="hidden" name="_token" id="csrf-token" value="{{ \Session::token() }}" />
                        <div class="form-group">
                            <div class="col-md-6 " style="margin-bottom: 1%;">
                                <input type="button" name="button" id='back' class="btn buttonBack action-button floatRight" style="float: left;" value="{{trans('messages.goToTasks')}}" />
                            </div>
                            <div class="col-md-6  " style="margin-bottom: 1%;">
                                <input type="submit" name="submit" id='submit' class="btn button action-button floatRight" style="float: right;" value="{{trans('messages.submit')}}" />
                            </div>
                        </div>


                    </div>
                </div>  

            </div>
        </div>
    {!!Form::close()!!}
</div>
<script>
$(document).ready(function () {

    $('#back').on('click', function () {
        location.href = '{{url("tasks")}}';
    });

    $('#selectCourse').on('change', function (e) {
        var courseId = $("#selectCourse option:selected").val();
        $('#selectGroups').empty();
        $.ajax({
            url: "{{url("getGroupsForCourse")}}",
            type: 'get',
            data: {courseId: courseId},
            success: function (response) {

                $.each(response.groups, function (key, value) {
                    $('#selectGroups').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
        $("#selectGroups").attr('disabled', false);

    });

    $("#endDate").datepicker({
    });


    $('#createTask').validate({
        rules: {
            name: {
                required: true,
                maxlength: 100
            },
            description: {
                required: true,
                maxlength: 1000
            },
            end_date: {
                required: true,
                maxlength: 100
            },
            course_id: {
                required: true,
                maxlength: 100
            },
            group_id: {
                required: true,
                maxlength: 100
            },
        },
        // Specify the validation error messages
        messages: {
            name: {
                required: "{{trans('messages.nameRequired')}}",
                maxlength: "{{trans('messages.maxLenght100')}}"+100
            },
            description: {
                required: "{{trans('messages.descriptionRequired')}}",
                maxlength: "{{trans('messages.maxLenght100')}}"+1000
            },
            end_date: {
                required: "{{trans('messages.endDateRequired')}}",
                maxlength: "{{trans('messages.maxLenght100')}}"+100
            },
            course_id: {
                required: "{{trans('messages.courseRequired')}}",
                maxlength: "{{trans('messages.maxLenght100')}}"+100
            },
            group_id: {
                required: "{{trans('messages.groupRequired')}}",
                maxlength: "{{trans('messages.maxLenght100')}}"+100
            }
        }
    });
});
</script>
@stop