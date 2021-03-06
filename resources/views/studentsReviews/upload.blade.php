@extends('app')
@section('upload_review_solution')
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
                    <div class="row">
                        <div class="col-md-6 " style="margin-bottom: 1%;">
                            <input type="button" name="button" id='back' class="btn buttonBack action-button floatRight" style="float: left;" value="{{trans('messages.goToMyReviews')}}" />
                        </div>
                    </div>
                    <center>
                        <h2 style="margin-bottom:5%;"> {{trans('messages.uploadReviewForTask')}} {{$task->name}}{{trans('messages.uploadReviewForTaskEnd')}}</h2>
                    </center>
                    {!!Form::open(['url' => 'myreviews/upload/review/solution/'.$questionary->id,'id'=>'uploadFileForTask', 'files' => true])!!}
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
                        <div class='row'>

                            <div class="form-group" >
                                <div class="" style="margin-bottom: 1%;margin-left: 10%;">
                                    <input type="file" class="btn"   name="filefield"/>
                                </div>
                            </div> 
                        </div>
                        <div class='row'>
                            <div class="form-group">
                                <input type="submit" name="submit" id='submit' class="btn button action-button"  value="{{trans('messages.submit')}}" />
                            </div>
                        </div>
                    </center>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        $('#back').on('click', function () {
            location.href = '{{url("myreviews")}}';
        });
    });
</script>
@stop