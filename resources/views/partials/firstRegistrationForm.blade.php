<div id='firstForm'>  
    <div class="form-group">
        <label class="col-md-4 control-label">Username</label>
        <div class="col-md-6">
            <input type="text" id='username' class="form-control" name="username">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">Forename</label>
        <div class="col-md-6">
            <input type="text" id='forename' class="form-control" name="forename">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">Family Name</label>
        <div class="col-md-6">
            <input type="text" id='familyName' class="form-control" name="familyName" value="{{ old('familyName') }}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">E-Mail Address</label>
        <div class="col-md-6">
            <input type="email" id='email' class="form-control" name="email" value="{{ old('email') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Password</label>
        <div class="col-md-6">
            <input type="password" id='password' class="form-control" name="password">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Confirm Password</label>
        <div class="col-md-6">
            <input type="password" class="form-control" name="password_confirmation">
        </div>
    </div>  
  
    <div class="form-group">
        <label class="col-md-4 control-label">Rank</label>
        <div class="col-md-6">
            <input type="radio" id='tutor' name="position" value="1"> Tutor<br>
            <input type="radio" id='student' name="position" value="2"> Student<br>
            <label id="position-error" class="error" for="position" hidden></label>
        </div>

    </div>
<div class="form-group">  
    <div class="col-md-6 col-md-offset-4">

        <input type="button" id="nextToSecondForm"  class="btn btn-primary" style="float:right;" value="Next">
                 
    </div>
</div>
</div>