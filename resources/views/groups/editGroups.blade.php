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
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-offset-1 col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
            <div class="panel panel-default" style="border-radius: 0px;">
                <div class="panel-body">

                    <center>
                        <div class="form-group">
                            <h2 style="margin-left: -55%;">Edit course</h2> 

                        </div>
                        {!! Form::model($group, array('route' => array('updateGroup', $group->id), 'method' => 'PUT')) !!}
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> Group name</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> Course name</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                               {!! Form::select('course_id', $courses, $group->course_id,['class'=>'form-control'])!!}           

                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> Faculty name</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                               {!! Form::select('faculty_id', $faculties, $group->faculty_id,['class'=>'form-control'])!!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> Major name</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::select('major_id', $majors, $group->major_id,['class'=>'form-control'])!!}
                            </div>
                        </div>
                       <div class="form-group" id="year" >
                            <label class="col-md-offset-3 col-md-2 control-label">Year</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <div class="input-group date" name="student_first_year" id="studentFirstYear" data-provide="datepicker">
                                    <input type="text" style="display:none;" class="form-control" id="getDate" name="student_first_year"/>
                                </div>
                            </div>
                            <label for="student_first_year" generated="true" id="labelForYear" class="error"></label>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">Users</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <select class="form-group usersSelect" id="selectUsers" name="student_ids[]"  multiple="multiple" style="width:250px;">
                                @foreach($studentsAll as $student)
                                    <option value="{{$student->id}}" @foreach($students as $selected) @if($student->id == $selected->id)selected="selected"@endif @endforeach>{{$student->username}}</option>
                                @endforeach                                  
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 " style="margin-bottom: 1%;">
                                {!! Form::button('Go to groups', array('class' => 'btn buttonBack','id'=>'back')) !!}
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
        $('.ui-datepicker select.ui-datepicker-year ').attr('name', 'student_first_year');
        
        var date = new Date("{{$group->student_first_year}}");
        var startYear = date.getFullYear();
        console.log(startYear);
        $("#studentFirstYear").datepicker({
            dateFormat: 'yy',
            changeYear: true,  
            changeMonth: false,  
         }).datepicker("setDate",new Date("{{$group->student_first_year}}"));
        $("#back").on("click", function () {
            location.href = "{{url("groups")}}";
        });
        var students= <?php $students ?>
//         $("#selectUsers").select2().select2('val',);
         $('#selectUsers').select2().select2('val', students);

    });
</script>

@stop