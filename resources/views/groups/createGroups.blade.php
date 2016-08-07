@extends('app')
@section('create_groups')
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
    <form method="post" action='{{url('/storeCourse')}}' id="createGroups">
        <div class="row">
            <div class="col-md-offset-1 col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
                <div class="panel panel-default" style="border-radius: 0px;">
                    <div class="panel-body">
                        @if(\Session::has('error'))
                        <div class="flash-message">
                            <div class="alert alert-danger">
                                {{\Session::get('error')}}
                            </div>
                        </div>
                        @endif
                        <h2 style="margin-bottom: 2%;">Create Groups</h2>
                        </center>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> Course name</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> Description</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <textarea  type="text" class="form-control" name="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-offset-3 col-md-2 control-label">Language</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <input type="text" class="form-control" name="language">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-offset-3 col-md-2 control-label">Duration</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <input type="text" class="form-control" name="duration">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-offset-3 col-md-2 control-label">Prerequisites</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <input type="text"  class="form-control" name="requirments"/>
                            </div>
                        </div>
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <div class="form-group">
                            <div class="col-md-6 " style="margin-bottom: 1%;">
                                <input type="button" name="button" id='back' class="btn buttonBack action-button floatRight" style="float: left;" value="Back to courses" />
                            </div>
                            <div class="col-md-6  " style="margin-bottom: 1%;">
                                <input type="submit" name="submit" id='submit' class="btn button action-button floatRight" style="float: right;" value="Submit" />
                            </div>
                        </div>
                    </div>
                </div>  

            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {
        
        $("#back").on("click",function(){
            location.href="{{url("groups")}}";
        });

        $('#createGroups').validate({
            ignore: ":hidden",
            rules: {
                name: {
                    required: true,
                    maxlength: 100
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
                    required: "Please enter your name",
                    maxlength: 100
                },
                description: {
                    required: "Please enter your description",
                    maxlength: 1000
                },
                language: {
                    required: "Please enter the language of your course",
                    maxlength: 100
                },
                duration: {
                    required: "Please enter the duration of your course",
                    maxlength: 100
                },
                requirments: {
                    required: "Please enter the duration of your course",
                    maxlength: 100
                }
            }
        });
    });
</script>

@stop