<div id='secondForm'> 
    <div id='studentInfo'>
        <div class="form-group">
            <label class="col-md-4 control-label">Faculty number</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="facNumber" value="{{ old('facNumber') }}">
            </div>
        </div>                                
        <div class="form-group">
            <label class="col-md-4 control-label">Semester</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="semester" value="{{ old('semester') }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Group</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="group" value="{{ old('group') }}">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">Major</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="department" value="{{ old('department') }}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">Degree</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="degree" value="{{ old('degree') }}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">Mobile</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="mobile" value="{{ old('mobile') }}">
        </div>
    </div>                           
    <div id='teacherInfo'>                             
        <div class="form-group">
            <label class="col-md-4 control-label">Cabinet Number</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="cabinet" value="{{ old('cabinet') }}">
            </div>
        </div>                               
    </div>
    <div class="form-group">  
        <div class="col-md-6 col-md-offset-4">
            <input type="button" id="backToFirstForm"  class="btn btn-primary" style="float:left;" value="Back">

            <input type="submit" id="submit"  class="btn btn-primary" style="float:right;" value="Register">

        </div>
    </div>

</div>