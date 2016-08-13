@extends('app')
@section('students_to_task')
<style>
    .buttonEdit{
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
                    <button type="button" class="btn button" id="back" >Go to all tasks</button>
                    @if(!(empty($students)))
                    <center>
                        <h2>Task  {{$task->name}} </h2>
                    </center>
                    <div class="table-responsive">
                        <table id="usersToGroupTable" class="display" style="border: solid;
                               border-width: 0.8px;border-color:#979797;">
                            <thead>
                                <tr style="background-color: #b3b3b3; ">
                                    <th>Faculty number</th>
                                    <th>Forename</th>
                                    <th>Family name</th>        
                                    <th>Task Ready</th>
                                    <th>Uploaded solution</th>
                                </tr>
                            </thead>
                            <tbody>                             
                                @foreach($students as $student)
                                <tr>
                                    <td style="max-width:100px!important;word-wrap: break-word;">{{$student->username}}</td>

                                    <td style="max-width:100px;">{{$student->forename}}</td>
                                    <td style="max-width:100px;">{{$student->familyName}}</td>
                                    <td style="max-width:100px;"><input type="checkbox" disabled name="ready" class='readyTask' value="{{$student->ready}}"></td>
                                    <td style="max-width:100px;"></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <h2>No assigned students groups for these task</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!--{{$task->name}}
@foreach($students as $student)
{{$student->username}}
@endforeach
-->
<script>
    $(document).ready(function () {
        
        if( $('.readyTask').val()==0){
            $('.readyTask')[0].checked = false;            
        }else{
             $('.readyTask')[0].checked = true;    
        }
       
        
        //datatable create
        $('#usersToGroupTable').DataTable();
        //hide datatable info tag
        $('.dataTables_info').hide();
        $("#back").on("click", function () {
            location.href = "{{url("tasks")}}";
        });
    });
</script>
@stop