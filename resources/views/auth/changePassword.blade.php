@extends('app')
@section('change_password')
<div class="container-fluid">
    <form class="form-horizontal" id="changePasswordForm" method="POST" action="save/password" >
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif     
        @if (Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
        @endif
        <div class="row">
            <div class="col-md-offset-1 col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
                <div class="panel panel-default" style="border-radius: 0px;">
                    <div class="panel-body">
                        <center>
                            <h2 style="margin-bottom:2%;">{{trans('messages.changePassword')}}</h2>
                        </center>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.oldPassword')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <input type="password" id="old_password" class="form-control" name="old_password">      
                            </div>
                        </div>   
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.newPassword')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <input type="password" id="newPassword" class="form-control" name="new_password">    
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-offset-3 col-md-2 control-label"> {{trans('messages.confirmPassword')}}</label>
                            <div class="col-md-5 col-md-offset-right-2 " style="margin-bottom: 1%;">
                                <input type="password" class="form-control" name="confirm_password">  
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">  
                            <div class="col-md-6 col-md-offset-4">
                                <input type="submit"  class="btn btn-primary" style="float:right;" value=" {{trans('messages.submit')}}">
                            </div>
                        </div>
                    </div>  
                </div>
            </div
    </form>
</div>
<script>
    $(document).ready(function () {
        $('#changePasswordForm').validate({
            ignore: ":hidden",
            rules: {
                old_password: {
                    remote: {
                        url: "{{ url('/checkOldPassword')}}",
                        type: "get",
                        data: {
                            old_password: function () {
                                return $("#old_password").val();
                            }
                        },
                        dataFilter: function (data) {
                            var json = JSON.parse(data);
                            if (json.msg === "false") {
                                return 'false';
                            } else {
                                return 'true';
                            }
                        }
                    },
                    required: true                    
                },
                new_password: {
                    required: true
                },
                confirm_password: {
                    equalTo: "#newPassword"
                }
            },
            // Specify the validation error messages
            messages: {
                old_password: {
                    required: "Please enter your current password",
                    remote:"Parolata ne syvpada"
                },
                new_password: {
                    required: "Please enter your new password",
                },
                confirm_password: {
                    equalTo: "Password doesn't match"
                }
            }
        });
    });



</script>
@stop