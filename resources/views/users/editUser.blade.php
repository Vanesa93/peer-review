@extends('app')
@section('edit_user')
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

                    <center>
                        <div class="form-group">
                            <h2 style="margin-left: -55%;"> {{trans('messages.edit')}} {{$userAccountType}} {{$user->username}}</h2> 
                        </div>
                        {!! Form::model($user, array('route' => array('updateUser', $userId), 'method' => 'PUT','id'=>'editForm')) !!}
                        @if(\Session::has('error'))
                        <div class="flash-message">
                            <div class="alert alert-danger">
                                {{\Session::get('error')}}
                            </div>
                        </div>
                        @endif
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            Username and email must be unique
                        </div>
                        @endif
                         @if($user->account_type==1)
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">  {{trans('messages.username')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('username', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                         @elseif($user->account_type==2)
                         <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">  {{trans('messages.facultyNumber')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('username', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                         @endif
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">   {{trans('messages.forename')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('forename', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">  {{trans('messages.familyName')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('familyName', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.email')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('email', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        @if($user->account_type==1)
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.mobile')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('mobile', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.cabinetNumber')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('cabinet', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.department')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('department', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.degree')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('degree', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        @elseif($user->account_type==2)
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.mobile')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('mobile', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.year')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('year', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.semester')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('semester', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.group')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('group', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.faculty')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                         {!! Form::select('faculty', $faculties, $user->faculty,['class'=>'form-control'])!!}           
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.major')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                 {!! Form::select('major', $majors, $user->major,['class'=>'form-control'])!!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.degree')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('degree', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <div class="col-md-6 " style="margin-bottom: 1%;">
                                {!! Form::button(trans('messages.goToUsers'), array('class' => 'btn buttonBack','id'=>'back')) !!}
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

        $("#back").on("click", function () {
            location.href = "{{url("users")}}";
        });
    });

    jQuery.validator.addMethod("phone", function (phone_number, element) {
        phone_number = phone_number.replace(/\s+/g, "");
        return this.optional(element) || phone_number.length > 9 &&
                phone_number.match(/[0-9 -()+]+$/);
    }, "Please specify a valid phone number");

    $('#editForm').validate({
        ignore: ":hidden",
        rules: {
            username: {
                required: true
            },
            forename: {
                required: true,
            },
            familyName: {
                required: true,
            },
            account_type: {
                required: true
            },
            faculty: {
                required: true
            },
            group: {
                required: true,
                number: true
            },
            degree: {
                required: true
            },
            semester: {
                number: true,
                required: true
            },
             cabinet: {
                number: true,
                required: true
            },
            email: {
                email: true,
                required: true
            },
            password: {
                required: true
            },
            password_confirmation: {
                equalTo: "#password"
            },
            year: {
                required: true,
                number: true
            },
            department: {
                required: true
            },
            mobile: {
                required: true,
                phone: true
            },
        },
        // Specify the validation error messages
         messages: {
                username: {
                    required: "{{trans('messages.usernameRequired')}}",
                    remote: "{{trans('message.notUnique')}}",
                },
                forename: {
                    required: "{{trans('messages.forenameRequired')}}"
                },
                email: {
                    required: "{{trans('messages.emailRequired')}}",
                    email: "{{trans('messages.notValidEmail')}}",
                    remote: "{{trans('messages.notUniqueEmail')}}",
                },
                password: {
                    required: "{{trans('messages.passwortRequired')}}",
                },
                password_confirmation: {
                    equalTo: "{{trans('messages.passwortDontMatch')}}"
                },
                account_type: {
                    required: "{{trans('messages.positionRequired')}}"
                },
                faculty: {
                    required: "{{trans('messages.facultyRequired')}}"
                },
                year: {
                    required: "{{trans('messages.firstYearRequired')}}",
                    number: "{{trans('messages.validFirstYear')}}"
                },
                familyName: {
                    required: "{{trans('messages.familyNameRequired')}}"
                },
                group: {
                    required: "{{trans('messages.groupRequired')}}",
                },
                degree: {
                    required: "{{trans('messages.degreeRequired')}}"
                },
                semester: {
                    required: "{{trans('messages.semesterRequired')}}",
                    number: "{{trans('messages.validSemester')}}"
                },
                department: {
                    required: "{{trans('messages.departmentRequired')}}"
                },
                major: {
                    required: "{{trans('messages.majorRequired')}}"
                },
                mobile: {
                    required: "{{trans('messages.mobileNumberRequired')}}",
                    phone: "{{trans('messages.validMobileNumber')}}"
                },
            }
    });
</script>
@stop