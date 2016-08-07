@extends('app')
@section('add_faculty')

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
    <form method="post" action='{{url('/storeFaculty')}}' id="addFaculty">
        @if(\Session::has('error'))
        <div class="flash-message">
            <div class="alert alert-danger">
                {{\Session::get('error')}}
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-offset-1 col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
                <div class="panel panel-default" style="border-radius: 0px;">
                    <div class="panel-body">

                        <h2 style="margin-bottom: 2%;">Add course</h2>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> Bulgarian name</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <input type="text" class="form-control" name="bg_name"/>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> German name</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <input  type="text" class="form-control" name="de_name"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-offset-3 col-md-2 control-label">English name</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <input type="text" class="form-control" name="en_name"/>
                            </div>
                        </div>
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <div class="form-group">
                            <div class="col-md-6 " style="margin-bottom: 1%;">
                                <input type="button" name="button" id='back' class="btn buttonBack action-button floatRight" style="float: left;" value="Back to faculties" />
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

        $("#back").on("click", function () {
            location.href = "{{url("faculties")}}";
        });

        $('#addFaculty').validate({
            ignore: ":hidden",
            rules: {
                bg_name: {
                    required: true,
                    maxlength: 100
                },
                en_name: {
                    required: true,
                    maxlength: 100
                },
                de_name: {
                    required: true,
                    maxlength: 100
                }
            },
            // Specify the validation error messages
            messages: {
                bg_name: {
                    required: "Please enter faculty bulgarian name",
                    maxlength: 100
                },
                en_name: {
                    required: "Please enter faculty english name",
                    maxlength: 100
                },
                de_name: {
                    required: "Please enter faculty german name",
                    maxlength: 100
                }
            }
        });
    });
</script>
@stop