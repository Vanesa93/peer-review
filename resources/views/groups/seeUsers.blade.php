@extends('app')
@section('see_users_from_group')
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
                    <!--<div class="row">-->
                        <button type="button" class="btn button" id="back" >Back to groups</button>
                    <!--</div>-->    
                    @if(!(empty($students)))
                    <center>
                        <h2>Students from group {{$groupName}}</h2>
                    </center>
                    <div class="table-responsive">
                        <table id="usersToGroupTable" class="display" style="border: solid;
                               border-width: 0.8px;border-color:#979797;">
                            <thead>
                                <tr style="background-color: #b3b3b3; ">
                                    <th>Faculty number</th>
                                    <th>Forename</th>
                                    <th>Family name</th>                                   
                                </tr>
                            </thead>
                            <tbody>                             
                                @foreach($students as $student)
                                <tr>
                                    <td style="max-width:100px!important;word-wrap: break-word;">{{$student->username}}</td>

                                    <td style="max-width:100px;">{{$student->forename}}</td>

                                    <td style="max-width:100px;">{{$student->familyName}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <center>
                        <h5>No users from these group</h5>
                    </center>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        //datatable create
        $('#usersToGroupTable').DataTable();
        //hide datatable info tag
        $('.dataTables_info').hide();
        $("#back").on("click", function () {
            location.href = "{{url("groups")}}";
        });
    });
</script>
@stop
