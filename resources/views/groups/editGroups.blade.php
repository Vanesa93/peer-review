@extends('app')
@section('edit_group')
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
div.ui-datepicker-inline.ui-datepicker.ui-widget.ui-widget-content.ui-helper-clearfix.ui-corner-all{
    width:250px
}
</style>
<div class="container-fluid">
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
                        <div class="form-group">
                            <h2 style="margin-left: -55%;">{{trans('messages.editGroup')}}</h2> 

                        </div>
                        {!! Form::model($group, array('route' => array('updateGroup', $group->id), 'method' => 'PUT','id'=>'editGroup')) !!}
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.name')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.course')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                               {!! Form::select('course_id', $courses, $group->course_id,['class'=>'form-control'])!!}           

                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.faculty')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                               {!! Form::select('faculty_id', $faculties, $group->faculty_id,['class'=>'form-control','id'=>'selectFaculty'])!!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.major')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::select('major_id', $majors, $group->major_id,['class'=>'form-control','id'=>'selectMajor'])!!}
                            </div>
                        </div>
                       <div class="form-group" id="year" >
                            <label class="col-md-offset-3 col-md-2 control-label">{{trans('messages.year')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <div class="input-group date" id="studentFirstYear" data-provide="datepicker">
                                    <input type="text" style="display:none;" class="form-control" id="getDate" name="student_first_year"  style="width:250px;"/>
                                </div>
                            </div>
                            <label for="student_first_year" generated="true" id="labelForYear" class="error"></label>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">{{trans('messages.users')}}</label>  
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <select class="form-group usersSelect" id="selectUsers" name="student_ids[]"  multiple="multiple" style="width:250px;">
                                @foreach($studentsAll as $student) 
                                    <option value="{{$student->id}}" @foreach($students as $selected) @if($student->id == $selected->student_id)selected="selected"@endif @endforeach>{{$student->username}}</option>
                                @endforeach                                  
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 " style="margin-bottom: 1%;">
                                {!! Form::button(trans('messages.goToGroups'), array('class' => 'btn buttonBack','id'=>'back')) !!}
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
        $('.ui-datepicker select.ui-datepicker-year ').attr('name', 'student_first_year');
        
        var date = new Date("{{$group->student_first_year}}");
        var startYear = date.getFullYear();
        $("#studentFirstYear").datepicker({
            dateFormat: 'yy',
            changeYear: true,  
            changeMonth: false,  
         }).datepicker("setDate",new Date("{{$group->student_first_year}}"));
         
          $("#studentFirstYear").datepicker().on("input change", function (e) {             
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
         
        $("#back").on("click", function () {
            location.href = "{{url("groups")}}";
        });
         $('#selectUsers').select2();
         
         //select faculty on change
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
            $('.ui-datepicker-year').attr('disabled', true);
            $('.ui-datepicker-year').css( "background",'#eee');
            $('div.ui-datepicker-inline.ui-datepicker.ui-widget.ui-widget-content.ui-helper-clearfix.ui-corner-all').css( "background",'#eee');
            $('#selectUsers').attr('disabled', true);
        });
        
         //select major on change
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
        
         $('#editGroup').validate({
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
            },
            });
        });        

</script>

@stop