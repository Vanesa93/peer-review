@extends('app')

@section('content')
<link href='{{ URL::asset('styles/register.css')}}' rel='stylesheet' type='text/css'>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" >
            <div class="panel panel-default" style="height:470px">
                <div class="panel-heading">Register</div>
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

                    <form class="form-horizontal" role="form" method="POST" action="/auth/register">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div id='firstForm'>  
                            <div class="form-group">
                                <label class="col-md-4 control-label">Forename</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="forename" value="{{ old('forename') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Family Name</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="familyName" value="{{ old('familyName') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Confirm Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>                           
                            <div class="form-group">
                                <label class="col-md-4 control-label">Rank</label>
                                <div class="col-md-6">
                                    <input type="radio" id='tutor' name="position" value="1"> Tutor<br>
                                    <input type="radio" id='student' name="position" value="2"> Student<br>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="button" class="btn btn-primary" id='nextToSecondForm' style="float:right;">
                                        Next
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id='secondForm'> 
                            <div id='studentInfo'>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Faculty number</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="facNumber" value="{{ old('facNumber') }}">
                                    </div>
                                </div>                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Semester</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="semester" value="{{ old('semester') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Group</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="group" value="{{ old('group') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Major</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="department" value="{{ old('department') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Degree</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="degree" value="{{ old('degree') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Mobile</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="mobile" value="{{ old('mobile') }}">
                                </div>
                            </div>                           
                            <div id='teacherInfo'>                             
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Cabinet Number</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="cabinet" value="{{ old('cabinet') }}">
                                    </div>
                                </div>                               
                            </div>
                            <div class="form-group">  
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="button" class="btn btn-primary" id='backToFirstForm' style="float:left;">
                                        Back
                                    </button>
                                    <button type="button" id='nextToThirdForm' class="btn btn-primary" style="float:right;">
                                        Next
                                    </button>                                   
                                </div>
                            </div>
                        </div>
                        <div id='thirdForm'> 
                            <div class="form-group">  
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Profile picture</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="profilePhoto" value="{{ old('profilePhoto') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="button" class="btn btn-primary" id='backToSecondForm' style="float:left;">
                                        Back
                                    </button>
                                    <button type="submit" id='submit' class="btn btn-primary" style="float:right;">
                                        Register
                                    </button>                                 
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#secondForm').hide();
        $('#thirdForm').hide();
        $('#nextToSecondForm').click(function () {
            $('#firstForm').hide();
            $('#thirdForm').hide();
            $('#secondForm').show();
            if ($('input[name=position]:checked').val() == 2) {
                $('#studentInfo').show();
                $('#teacherInfo').hide();
            } else {
                $('#teacherInfo').show();
                $('#studentInfo').hide();
            }
        });
        $('#backToFirstForm').click(function () {
            $('#secondForm').hide();
            $('#firstForm').show();
            $('#thirdForm').hide();
        });
        $('#nextToThirdForm').click(function () {
            $('#secondForm').hide();
            $('#firstForm').hide();
            $('#thirdForm').show();
        });
        $('#backToSecondForm').click(function () {
            $('#secondForm').show();
            $('#firstForm').hide();
            $('#thirdForm').hide();
        });
    });

</script>
@endsection
