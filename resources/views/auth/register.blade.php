@extends('app')

@section('content')
<link href='{{ URL::asset('styles/register.css')}}' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" >
            <div class="panel panel-default" style="padding-top: 2%;">
                <ul id="progressbar">
                    <li class="active" id='firstActive'></li>
                    <li id='secondActive'></li>                
                </ul>
                <div class="panel-heading">{{trans('messages.register')}}</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form class="form-horizontal" id="registerForm"  method="POST" action="/auth/register" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @include('partials.firstRegistrationForm')
                        @include('partials.secondRegistrationForm')

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    $('#secondForm').hide();
    $('#studentMajor').hide();
    $('#teacherMajor').hide();
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

    $('#nextToSecondForm').click(function () {

        $('#username').valid();
        $('#forename').valid();
        $('#familyName').valid();
        $('#email').valid();
        $('#password').valid();
        $('input[name=position]').valid();
        if ($('#username').valid() && $('#forename').valid() && $('#familyName').valid()
                && $('#email').valid() && $('#password').valid() && $('input[name=position]').valid()) {
            $('#firstForm').hide();
            $('#secondForm').show();
            if ($('input[name=position]:checked').val() == 2) {
                $('#studentInfo').show();
                $('#teacherInfo').hide();
                $('#studentMajor').show();
                $('#teacherMajor').hide();

            } else {
                $('#teacherInfo').show();
                $('#studentInfo').hide();
                $('#studentMajor').hide();
                $('#teacherMajor').show();
            }

            $("#secondActive").addClass("active");
            $("#firstActive").removeClass("active");
        }


    });


    $("#backToFirstForm").click(function () {
        $('#secondForm').hide();
        $('#firstForm').show();
        $("#secondActive").removeClass("active");
        $("#firstActive").addClass("active");
    });

//TO DO show image - later to implement
//        $(' input:file').change(function (e) {
//            var img = URL.createObjectURL(e.target.files[0]);
//            $('#show_Image').attr('src', img);
//
//        });
    jQuery.validator.addMethod("phone", function (phone_number, element) {
        phone_number = phone_number.replace(/\s+/g, "");
        return this.optional(element) || phone_number.length > 9 &&
                phone_number.match(/[0-9 -()+]+$/);
    }, "Please specify a valid phone number");



    $('#registerForm').validate({
        ignore: ":hidden",
        rules: {
            username: {
                remote: {
                    url: "{{ url('/checkUsername')}}",
                    type: "get",
                    data: {
                        username: function () {
                            return $("#username").val();
                        }
                    },
                    dataFilter: function (data) {
                        var json = JSON.parse(data);
                        if (json.msg === "false") {
                            return 'false';
                        } else {
                            return 'true';
                        }
                    }
                },
                required: true
            },
            forename: {
                required: true,
            },
            familyName: {
                required: true,                
            },
            position: {
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
                remote: {
                    url: "{{ url('/checkEmail')}}",
                    type: "get",
                    data: {
                        username: function () {
                            return $("#email").val();
                        }
                    },
                    dataFilter: function (data) {
                        var json = JSON.parse(data);
                        if (json.msg === "false") {
                            return 'false';
                        } else {
                            return 'true';
                        }
                    }
                },
                required: true
            },
            password: {
                required: true
            },
            password_confirmation: {
                equalTo: "#password"
            },
            facNumber: {
                remote: {
                    url: "{{ url('/checkFacNumbers')}}",
                    type: "get",
                    data: {
                        facNumber: function () {
                            return $("#facNumber").val();
                        }
                    },
                    dataFilter: function (data) {
                        var json = JSON.parse(data);
                        if (json.msg === "false") {
                            return 'false';
                        } else {
                            return 'true';
                        }
                    }
                },
                required: true,
                number: true
            },
            department: {
                required: true
            },
            mobile: {
                required: true,
                phone:true
            },
        },
        // Specify the validation error messages
        messages: {
            username: {
                required: "Please enter your username",
                remote: "Not unique",
            },
            forename: {
                required: "Please enter your first name"
            },
            email: {
                required: "Please enter your email",
                remote: "Not unique",
            },
            password: {
                required: "Please enter your password",
            },
            password_confirmation: {
                equalTo: "Password doesn't match"
            },
            position: {
                required: "Please enter your position"
            },
            faculty: {
                required: "Please enter your faculty"
            },
            facNumber: {
                required: "Please enter your faculty number",
                remote: "Not unique",
                number: "Please enter valid faculty number"
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
                phone:'Please enter valid mobile'
            },
        }
    });
});



</script>
@endsection
