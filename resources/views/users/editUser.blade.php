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
                            <h2 style="margin-left: -55%;">Edit {{$userAccountType}} {{$user->username}}</h2> 
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
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> Username</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('username', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> Forename</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('forename', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> Family name</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('familyName', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">Email</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('email', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        @if($user->account_type==1)
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">Mobile</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('mobile', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">Cabinet number</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('cabinet', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">Department/катедра</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('department', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">Degree</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('degree', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        @elseif($user->account_type==2)
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">Mobile</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('mobile', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">Year</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('year', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">Semester</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('semester', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">Group</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('group', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">Faculty</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                         {!! Form::select('faculty', $faculties, $user->faculty,['class'=>'form-control'])!!}           
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">Major/Специалност</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('department', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">Degree</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('degree', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <div class="col-md-6 " style="margin-bottom: 1%;">
                                {!! Form::button('Back to users', array('class' => 'btn buttonBack','id'=>'back')) !!}
                            </div>
                            <div class="col-md-6 " style="margin-bottom: 1%;">
                                {!! Form::submit('Update', array('class' => 'btn button')) !!}
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
                required: "Please enter your username/faculty number(for students)",
            },
            forename: {
                required: "Please enter your first name"
            },
            email: {
                required: "Please enter your email",
                email: "Enter valid email",
            },
            password: {
                required: "Please enter your password",
            },
            password_confirmation: {
                equalTo: "Password doesn't match"
            },
            account_type: {
                required: "Please enter your position"
            },
            faculty: {
                required: "Please enter your faculty"
            },
            year: {
                required: "Please enter first year",
                number: "Please enter valid first year"
            },
            familyName: {
                required: "Please enter your family name"
            },
            group: {
                required: "Please enter your group",
                number: "Please enter valid group"
            },
            degree: {
                required: "Please enter your degree"
            },
            semester: {
                required: "Please enter your semester",
                number: "Please enter valid semester"
            },
            department: {
                required: "Please enter your department name"
            },
            mobile: {
                required: "Please enter your mobile number",
                phone: 'Please enter valid mobile'
            },
        }
    });
</script>
@stop