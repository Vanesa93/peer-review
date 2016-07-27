<div id='firstForm'>  
    <div class="form-group">
        <label class="col-md-4 control-label">  {{trans('messages.username')}}</label>
        <div class="col-md-6">
            <input type="text" id='username' class="form-control" name="username">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label"> {{trans('messages.forename')}}</label>
        <div class="col-md-6">
            <input type="text" id='forename' class="form-control" name="forename">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label"> {{trans('messages.familyName')}}</label>
        <div class="col-md-6">
            <input type="text" id='familyName' class="form-control" name="familyName" value="{{ old('familyName') }}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label"> {{trans('messages.email')}}</label>
        <div class="col-md-6">
            <input type="email" id='email' class="form-control" name="email" value="{{ old('email') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label"> {{trans('messages.password')}}</label>
        <div class="col-md-6">
            <input type="password" id='password' class="form-control" name="password">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label"> {{trans('messages.confirmPassword')}}</label>
        <div class="col-md-6">
            <input type="password" class="form-control" name="password_confirmation">
        </div>
    </div>  

    <div class="form-group">
        <label class="col-md-4 control-label"> {{trans('messages.rank')}}</label>
        <div class="col-md-6">
            <input type="radio" id='tutor' name="account_type" value="1">  {{trans('messages.tutor')}}<br>
            <input type="radio" id='student' name="account_type" value="2">  {{trans('messages.student')}}<br>
            <label id="position-error" class="error" for="account_type" hidden></label>
        </div>

    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">  
        <div class="col-md-6 col-md-offset-4">

            <input type="button" id="nextToSecondForm"  class="btn btn-primary" style="float:right;" value=" {{trans('messages.next')}}">

        </div>
    </div>
</div>