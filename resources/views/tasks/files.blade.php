@extends('app')
@section('lecturer_file')
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
        margin-bottom: 2%;
    }
    .buttonEdit{
        /*          background-color: #002b80;  Green */
        border: solid;
        border-width: 1px;
        color: white;
        padding: 5px 8px 4px 8px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
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
                    <center>
                        <h2> Help materials</h2>
                    </center>
                    {!!Form::open(['url' => 'files','id'=>'filesLecturer', 'files' => true])!!}
                    @if(!($files->isEmpty()))
                    <table class="table d">
                        <!-- List all documents based on authenticated user -->
                        @foreach($files as $file)                        
                        <tr>
                            <td><a href="/file/{{ $file->filename }}/open">{{ $file->original_filename }}</a></td>
                            <td><a href="document/remove/{{ $file->id }}" class="btn btn-sm btn-danger">Remove</a></td>
                        </tr>
                        @endforeach
                    </table>
                    @else
                    <h4>No helps files for these task</h4>
                    @endif
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop