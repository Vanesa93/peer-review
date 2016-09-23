@extends('app')
@section('my_profile')
<div class="container-fluid">
    {!!Form::open()!!}
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
                    <center>
                        <h2 style="margin-bottom:2%;">{{trans('messages.myProfile')}}</h2>
                    </center>
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.username')}}</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            {!! Form::text('username', $userData->username, array('class' => 'form-control','readonly'=>'true')) !!}       
                        </div>
                    </div>   
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.forename')}}</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            {!! Form::text('forename', $userData->forename, array('class' => 'form-control','readonly'=>'true')) !!}       
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.familyName')}}</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            {!! Form::text('familyName', $userData->familyName, array('class' => 'form-control','readonly'=>'true')) !!}       
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.email')}}</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            {!! Form::text('email',  $userData->email, array('class' => 'form-control','readonly'=>'true')) !!}       
                        </div>
                    </div>
                    @if($userData->account_type===1)                   
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.department')}}</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            {!! Form::text('faculty', $userData->department, array('class' => 'form-control','readonly'=>'true')) !!}       
                        </div>
                    </div> 
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.degree')}}</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            {!! Form::text('faculty', $userData->degree, array('class' => 'form-control','readonly'=>'true')) !!}       
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.cabinetNumber')}}</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            {!! Form::text('faculty', $userData->cabinet, array('class' => 'form-control','readonly'=>'true')) !!}       
                        </div>
                    </div> 
                     <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.mobile')}}</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            {!! Form::text('faculty', $userData->mobile, array('class' => 'form-control','readonly'=>'true')) !!}       
                        </div>
                    </div> 
                    @elseif($userData->account_type===2)
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.faculty')}}</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            {!! Form::text('faculty', $userData->faculty, array('class' => 'form-control','readonly'=>'true')) !!}       
                        </div>
                    </div> 
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.courseOfStudy')}}</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            {!! Form::text('major', $userData->major, array('class' => 'form-control','readonly'=>'true')) !!}       
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.degree')}}</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            {!! Form::text('degree', $userData->degree, array('class' => 'form-control','readonly'=>'true')) !!}       
                        </div>
                    </div> 
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.semester')}}</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            {!! Form::text('semester', $userData->semester, array('class' => 'form-control','readonly'=>'true')) !!}       
                        </div>
                    </div> 
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.year')}}</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            {!! Form::text('year', $userData->year, array('class' => 'form-control','readonly'=>'true')) !!}       
                        </div>
                    </div> 
                    <div class="form-group" >
                        <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.mobile')}}</label>
                        <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                            {!! Form::text('mobile', $userData->mobile, array('class' => 'form-control','readonly'=>'true')) !!}       
                        </div>
                    </div> 
                    @endif
                </div>
            </div>  

        </div>
    </div>
    {!!Form::close()!!}
</div>
@stop