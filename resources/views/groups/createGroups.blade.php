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
    .ui-datepicker-calendar {
       display: none;
    }
    .ui-datepicker-month {
       display: none;
    }
    .ui-datepicker-prev{
       display: none;
    }
    .ui-datepicker-next{
       display: none;
    }
    .ui-widget-header {
     border: none;
     background: none; 
    color: #333333;
    font-weight: bold;
}
.ui-datepicker-year{
    border:none;
}
    
</style>
<div class="container-fluid">
    <form method="post" action='{{url('/storeGroup')}}' id="createGroup">
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
                        <h2 style="margin-bottom: 2%;">{{trans('messages.createGroup')}}</h2>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">{{trans('messages.name')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <input type="text" class="form-control" id="enterYear" name="name"/>
                            </div>
                            <label for="name" generated="true"  class="error"></label>
                        </div>    
                         <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.selectCourse')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <select class="form-control" name="course_id">
                                    <option value="">{{trans('messages.selectCourse')}}</option>
                                    @foreach($courses as $course)
                                    <option value="{{$course->id}}">{{$course->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.selectFaculty')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <select class="form-control" id='selectFaculty' name="faculty_id">
                                    <option value="">{{trans('messages.selectFaculty')}}</option>
                                    @foreach($faculties as $faculty)
                                    <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="majors" >
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.selectCourseOfStudy')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <select class="form-control"  id="selectMajor" name="major_id">
                                    <option value="">{{trans('messages.selectCourseOfStudy')}}</option>
                                    @foreach($majors as $major)
                                    <option value="{{$major->id}}">{{$major->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                         <div class="form-group" id="year" >
                            <label class="col-md-offset-3 col-md-2 control-label">{{trans('messages.year')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <div class="input-group date" name="student_first_year" id="studentFirstYear" data-provide="datepicker">
                                    <input type="text" style="display:none;" class="form-control" id="getDate" name="student_first_year"/>
                                </div>
                            </div>
                            <label for="student_first_year" generated="true" id="labelForYear" class="error"></label>
                        </div>
                        
                        <div class="form-group" id="users">
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.selectUsers')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <select class="form-group usersSelect" id="selectUsers" name="student_ids[]"  multiple="multiple" style="width:250px;">
                                    @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->forename}} {{$user->familyName}} {{$user->username}}</option>
                                    @endforeach
                                </select>
                                <label for="student_id" generated="true" class="error"></label>

                            </div>
                        </div>

                        <input type="hidden" name="_token" id="csrf-token" value="{{ \Session::token() }}" />
                        <div class="form-group">
                            <div class="col-md-6 " style="margin-bottom: 1%;">
                                <input type="button" name="button" id='back' class="btn buttonBack action-button floatRight" style="float: left;" value="Go to groups" />
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
            location.href = "{{url("groups")}}";
        });
        $('.ui-datepicker select.ui-datepicker-year ').attr('name', 'student_first_year');
        $("#studentFirstYear").datepicker({dateFormat: 'yy',  changeYear: true,  changeMonth: false,
         }).on("input change", function (e) {             
            $('#selectUsers').empty();
                  var facId = $("#selectFaculty option:selected").val();
                  var majorId = $("#selectMajor option:selected").val();
                  var year=$(".ui-datepicker-year").val();
                   $('#getDate').attr('value', year);
                  $.ajax({
                      url: "{{url("getUsersGroupWithYear")}}",
                      type: 'get',
                      data: {facId: facId,majorId:majorId,year:year},
                      success: function (response) {
                          $('#selectUsers').empty();                    
                         $.each(response.users, function (key, value) {
                                  $('#selectUsers').append('<option value="' + value.id + '">' + value.forename + ' '
                                  +value.familyName+' '+value.username+'</option>');
                              });   
                      }
                  });
                  $('#users').show(1000);
      });
    
            
        $(".usersSelect").select2();

        $("#selectMajor").attr('disabled',true);
        $("#selectUsers").attr('disabled',true);
        $('.ui-datepicker-year').css( "background",'#eee');
         $('div.ui-datepicker-inline.ui-datepicker.ui-widget.ui-widget-content.ui-helper-clearfix.ui-corner-all').css( "background",'#eee');
        
        $('#selectFaculty').on('change', function (e) {
            var facId = $("#selectFaculty option:selected").val();
             $('#selectMajor').empty();
              $('#selectUsers').empty();
            $.ajax({
                url: "{{url("getGroupMajors")}}",
                type: 'get',
                data: {facId: facId},
                success: function (response) {     
                    $('#selectMajor').append('<option value="">{{trans('messages.selectCourseOfStudy')}}</option>');
                   $.each(response.majors, function (key, value) {
                            
                            $('#selectMajor').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });     
                }
            });
            $("#selectMajor").attr('disabled',false);

        });

        $('#selectMajor').on('change', function (e) {
           $('#selectUsers').empty();
            var facId = $("#selectFaculty option:selected").val();
            var majorId = $("#selectMajor option:selected").val();
            var year=$(".ui-datepicker-year").val();
            $.ajax({
                url: "{{url("getUsersGroupWithYear")}}",
                type: 'get',
                data: {facId: facId,majorId:majorId,year:year},
                success: function (response) {
                    console.log(response.users);
                    $('#selectUsers').empty();                    
                   $.each(response.users, function (key, value) {
                            $('#selectUsers').append('<option value="' + value.id + '">' + value.forename + ' '
                            +value.familyName+' '+value.username+'</option>');
                        });   
                }
            });
         $('.ui-datepicker-year').attr('disabled', false);
            $('.ui-datepicker-year').css( "background",'white');
            $('div.ui-datepicker-inline.ui-datepicker.ui-widget.ui-widget-content.ui-helper-clearfix.ui-corner-all').css( "background",'white');
            $('#selectUsers').attr('disabled', false);
        });
 
        
        $('#createGroup').validate({
            rules: {
                name:{
                     required: true,
                    maxlength: 100
                },
                faculty_id: {
                    required: true,
                    maxlength: 100
                },
                course_id: {
                    required: true,
                    maxlength: 100
                },
                major_id: {
                    required: true,
                    maxlength: 100
                },
                student_ids: {
                    required: true,
                    maxlength: 100
                },
                student_first_year: {
                    required: true,
                    date: true,
                    maxlength: 100
                }
            },
            // Specify the validation error messages
            messages: {
                name: {
                    required: "{{trans('messages.nameRequired')}}",
                    maxlength:"{{trans('messages.maxLenght100')}}"+ 100
                },
                faculty_id: {
                    required: "{{trans('messages.facultyRequired')}}",
                    maxlength:"{{trans('messages.maxLenght100')}}"+ 100
                },
                 course_id: {
                    required: "{{trans('messages.courseRequired')}}",
                    maxlength: "{{trans('messages.maxLenght100')}}"+100
                },
                major_id: {
                    required: "{{trans('messages.courseOfStudyRequired')}}",
                    maxlength:"{{trans('messages.maxLenght100')}}"+ 100
                },
                student_ids: {
                    required: "{{trans('messages.usersRequired')}}",
                    maxlength:"{{trans('messages.maxLenght100')}}"+ 100
                },
                student_first_year: {
                    required: "{{trans('messages.yearRequired')}}",
                    date: "{{trans('messages.notValidYear')}}",
                    maxlength: "{{trans('messages.maxLenght100')}}"+100
                },
            }
        });
    });
</script>
@stop

