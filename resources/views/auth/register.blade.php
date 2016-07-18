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
            if ($('input[name=position]:checked').val() == 2) {
                $('#studentInfo').show();
                $('#teacherInfo').hide();
            } else {
                $('#teacherInfo').show();
                $('#studentInfo').hide();
            }
            $('#firstForm').hide();
            $('#secondForm').show();
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

    ;


    $.validator.addMethod("checkExistingUsername", function (value, element)
    {
        var inputElem = $('#registerForm :input[name="username"]'),
                data = {"username": inputElem.val(), "_token": "{{ csrf_token() }}"};
        var isSuccess;
        $.ajax(
                {
                    method: "POST",
                    url: '/checkUsername/' + data,
                    dataType: "json",
                    data: data,
                    success: function (returnData)
                    {
                        console.log('return data:'+' '+returnData);
                        if (returnData == false)
                        {
                            isSuccess = true;
                            console.log('rezultat true:' + ' ' + isSuccess);
                            return true
                        } else {
                            isSuccess = false;
                            console.log('rezultat false:' + ' ' + isSuccess);
                            return false;
                        }
                    }

                });

    }, 'Message');


    $('#registerForm').validate({
        rules: {
            username: {
                required: true,
                checkExistingUsername: true
            },
            forename: {
                required: true,
            },
            familyName: {
                required: true
            },
            position: {
                required: true
            },
            group: {
                required: true
            },
            degree: {
                required: true
            },
            semester: {
                required: true
            },
            email: {
                required: true
            },
            password: {
                required: true
            },
            facNumber: {
                required: true
            },
            department: {
                required: true
            },
            mobile: {
                required: true
            },
        },
        // Specify the validation error messages
        messages: {
            username: {
                required: "Please enter your username",
                checkExistingUsername: "Not unique",
            },
            forename: {
                required: "Please enter your first name"
            },
            email: {
                required: "Please enter your email"
            },
            password: {
                required: "Please enter your password"
            },
            position: {
                required: "Please enter your position"
            },
            facNumber: {
                required: "Please enter your faculty number"
            },
            familyName: {
                required: "Please enter your family name"
            },
            group: {
                required: "Please enter your group"
            },
            degree: {
                required: "Please enter your degree"
            },
            semester: {
                required: "Please enter your semester"
            },
            department: {
                required: "Please enter your department name"
            },
            mobile: {
                required: "Please enter your mobile number"
            },
        }
    });
});



</script>
@endsection
