@extends('app')
@section('edit_task')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
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
                            <h2 style="margin-left: -55%;">Edit task</h2> 

                        </div>
                        {!! Form::model($task, array('route' => array('updateTask', $task->id), 'method' => 'PUT','id'=>'editTask')) !!}
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> Task name</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> Task description</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::textarea('description', null, array('class' => 'form-control')) !!}      

                            </div>
                        </div>
                        <div class="form-group" id="year" >
                            <label class="col-md-offset-3 col-md-2 control-label">End date</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <div class="input-group input-append date" id="endDate">
                                    <input type="text" class="form-control" name="end_date" />
                                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                            <label for="end_date" generated="true" id="labelForYear" class="error"></label>
                        </div>
                         <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> Course name</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                {!! Form::select('course_id', $courses, $task->course_name,['class'=>'form-control','id'=>'selectCourse'])!!}
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label">Users</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <select class="form-group usersSelect" id="selectGroups" name="group_ids[]"  multiple="multiple" style="width:250px;">
                                @foreach($allGroups as $group)
                                    <option value="{{$group->id}}" @foreach($groups as $selected) @if($group->id == $selected->group_id)selected="selected"@endif @endforeach>{{$group->name}}</option>
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
    var date = new Date("{{$task->end_date}}");
    
     $("#endDate").datepicker({
        format: 'dd/mm/yyyy'
    });
    $("#endDate").datepicker().datepicker("setDate",date);
    
    $("#selectCourse").on("change", function () {    
            $('#selectGroups').empty()  ;
            $('#selectGroups').attr('disabled',true);
                  var courseId = $("#selectCourse option:selected").val();
                  $.ajax({
                      url: "{{url("getGroupsForCourse")}}",
                      type: 'get',
                      data: {courseId:courseId},
                      success: function (response) {
                          $('#selectGroups').attr('disabled',false);                    
                         $.each(response.groups, function (key, value) {
                                  $('#selectGroups').append('<option value="' + value.id + '">'+value.name +'</option>');
                              });   
                      }
                  });
                   $('#selectGroups').attr('disabled',false);
      });
      

        $("#back").on("click", function () {
            location.href = "{{url("tasks")}}";
        });
        $('#selectGroups    ').select2();
        //select faculty on change

        $('#editTask').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 100
                },
                description: {
                    required: true,
                    maxlength: 100
                },
                end_date: {
                    required: true,
                    maxlength: 100
                },
                course_id: {
                    required: true,
                    maxlength: 100
                },
                group_ids: {
                    required: true,
                    maxlength: 100
                }
            },
            // Specify the validation error messages
            messages: {
                name: {
                    required: "Please enter name of the task",
                    maxlength: 100
                },
                description: {
                    required: "Please enter description",
                    maxlength: 100
                },
                course_id: {
                    required: "Please select course",
                    maxlength: 100
                },
                group_ids: {
                    required: "Please select groups",
                    maxlength: 100
                }
            }
        });
    });

</script>
@stop