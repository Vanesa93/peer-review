@extends('app')

@section('content')
<link href='{{ URL::asset('styles/register.css')}}' rel='stylesheet' type='text/css'>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" >
            <div class="panel panel-default" style="padding-top: 2%;">
                <ul id="progressbar">
                    <li class="active" id='firstActive'></li>
                    <li id='secondActive'></li>                
                </ul>
                <div class="panel-heading">{{trans('messages.registerUser')}}</div>
                <div class="panel-body">


                    <form class="form-horizontal" id="registerForm"  method="POST" action="/register/user" enctype="multipart/form-data">
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @if($faculties->isEmpty())
                        <center>
                            <p>{{trans('messages.noFacultiesFound')}}</p>
                        </center>
                        @elseif($majors->isEmpty())
                        <center>
                            <p>{{trans('messages.noMajorsFound')}}</p>
                        </center>
                        @else
                        @include('partials.firstRegistrationForm')
                        @include('admin.secondRegistrationFormAdmin')
                        @endif
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
        $('#afterChoosedFaculty').hide();
        $('#showFormForAccountType').hide();
        $('#commonInfo').hide();

        $('#selectFaculty').on('change', function (e) {
            var facId = $("#selectFaculty option:selected").val();
            $.ajax({
                url: "{{url("getMajors")}}",
                type: 'get',
                data: {facId: facId},
                success: function (response) {
                    $("#textNoMajor").empty();
                    $('#selectMajor').empty();
                    if (response.success == false) {
                        $('#textNoMajor').append('<input name="major"  readonly="readonly" type="text" class="form-control" /><br>' + '<p class="error">' + response.message + '</p>');
                        $('#selectMajor').hide();
                        $('#noMajors').show();
                        
                    } else {
                        $.each(response.majors, function (key, value) {
                            $('#selectMajor').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                        $('#noMajors').hide();
                        $('#selectMajor').show();
                        
                    }
                }
            });
            $('#commonInfo').show();
            $('#afterChoosedFaculty').show(1000);


        });

        $('input[type=radio][name=account_type]').change(function () {
            if ($('input[name=account_type]:checked').val() == 2) {
                $('#usernameLabelLecturer').hide();
                $('#usernameLabelStudent').show();
                $('#showFormForAccountType').show(1000);


            } else {
                $('#usernameLabelStudent').hide();
                $('#usernameLabelLecturer').show();
                $('#showFormForAccountType').show(1000);
                 $('#commonInfo').show();

            }
        });


        $('#registerForm').keydown(function (e) {
            return e.which !== 13
        });

        $('#nextToSecondForm').click(function () {

            $('#username').valid();
            $('#forename').valid();
            $('#familyName').valid();
            $('#email').valid();
            $('#password').valid();
            $('input[name=account_type]').valid();
            if ($('#username').valid() && $('#forename').valid() && $('#familyName').valid()
                    && $('#email').valid() && $('#password').valid() && $('input[name=account_type]').valid()) {
                $('#firstForm').hide(1000);
                $('#secondForm').show(1000);
                if ($('input[name=account_type]:checked').val() == 2) {
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
            $('#secondForm').hide(1000);
            $('#firstForm').show(1000);
            $("#secondActive").removeClass("active");
            $("#firstActive").addClass("active");
        });

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
                account_type: {
                    required: true
                },
                faculty: {
                    required: true
                },
                group: {
                    required: true,
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
                major: {
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
    });



</script>
@endsection
