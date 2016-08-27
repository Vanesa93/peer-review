@extends('app')
@section('create_courses')
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
</style>
<div class="container-fluid">
    <form method="post" action='{{url('/storeCourse')}}' id="createCourses">
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
                        <h2 style="margin-bottom: 2%;">{{trans('messages.createCourse')}}</h2>
                        </center>
                        <center>
                            <div class="form-group" >
                                <label class="col-md-offset-3 col-md-2 control-label">{{trans('messages.name')}}</label>
                                <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="form-group" >
                                <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.description')}}</label>
                                <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                    <textarea  type="text" class="form-control" name="description"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-offset-3 col-md-2 control-label">{{trans('messages.language')}}</label>
                                <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                    <input type="text" class="form-control" name="language">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-offset-3 col-md-2 control-label">{{trans('messages.duration')}}</label>
                                <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                    <input type="text" class="form-control" name="duration">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-offset-3 col-md-2 control-label">{{trans('messages.prerequisites')}}</label>
                                <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                    <input type="text"  class="form-control" name="requirments">
                                </div>
                            </div>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" >
                            <div class="form-group" style='margin-top:5%;'>
                                <div class="col-md-6 " style="margin-bottom: 1%;">
                                    <input type="button" name="button" id='back' class="btn buttonBack action-button floatRight" style="float:left" value="{{trans('messages.goToCourses')}}" >
                                </div>
                                    <div class="col-md-6 " style="margin-bottom: 1%;">
                                        <input type="submit" name="submit" id='submit' class="btn button action-button floatRight"  style="float:right" value="{{trans('messages.submit')}}" >
                                    </div>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {

        $("#back").on("click", function () {
            location.href = "{{url("courses")}}";
        });

        $('#createCourses').validate({
            ignore: ":hidden",
            rules: {
                name: {
                    required: true,
                    maxlength: 100,
                },
                description: {
                    required: true,
                    maxlength: 1000
                },
                language: {
                    required: true,
                    maxlength: 100
                },
                duration: {
                    required: true,
                    maxlength: 100
                },
                requirments: {
                    required: true,
                    maxlength: 255
                },
            },
            // Specify the validation error messages
            messages: {
                name: {
                    required: "{{trans('messages.nameRequired')}}",
                    maxlength: "{{trans('messages.maxLenght100')}}"+100,
                },
                description: {
                    required: "{{trans('messages.descriptionRequired')}}",
                    maxlength: "{{trans('messages.maxLenght100')}}"+1000,
                },
                language: {
                    required: "{{trans('messages.languageRequired')}}",
                    maxlength: "{{trans('messages.maxLenght100')}}"+100,
                },
                duration: {
                    required: "{{trans('messages.durationRequired')}}",
                    maxlength: "{{trans('messages.maxLenght100')}}"+100,
                },
                requirments: {
                    required: "{{trans('messages.prerequisitiesRequired')}}",
                    maxlength: "{{trans('messages.maxLenght100')}}"+255,
                }
            }
        });
    });
</script>

@stop