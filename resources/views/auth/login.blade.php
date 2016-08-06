@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{trans('messages.login')}}</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form id="loginForm" class="form-horizontal" role="form" method="POST" action="/auth/login">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <!--                                                     <div class="form-group has-feedback">
                                                <div>
                                                    <input type="text" class="form-control" name="login" placeholder="{{trans('staticTexts.usernameOrEmail')}}">
                                                    <span class="glyphicon form-control-feedback" id="fname1"></span>
                                                </div>
                                            </div>-->
                            <label class="col-md-4 control-label">Username or email</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="login" >

<!--								<input type="email" class="form-control" name="email" value="{{ old('email') }}">-->
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{trans('messages.password')}}</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> {{trans('messages.rememberMe')}}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                                    {{trans('messages.login')}}
                                </button>

                                <a href="/password/email">{{trans('messages.forgotPassword')}}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
     $(document).ready(function () {
    var form = $("#loginForm");
    form.validate({
        ignore: ":hidden",
        rules: {
            login: {
                required: true,
            },
            password: {
                required: true,
            },
        },
        messages: {
            password: {
                required: "{{trans('staticTexts.passwordReq')}}",
            },
            login: {
                required: "{{trans('staticTexts.usernameOrEmailReq')}}",
            },
        }
    });
     });
</script>
@endsection
