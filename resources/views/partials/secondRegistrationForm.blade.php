<div id='secondForm'> 
    <div id='studentInfo'>
        <div class="form-group">
            <label class="col-md-4 control-label"> {{trans('messages.faculty')}}</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="faculty" value="{{ old('faculty') }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label"> {{trans('messages.facultyNumber')}}</label>
            <div class="col-md-6">
                <input type="text" class="form-control" id='facNumber' name="facNumber" value="{{ old('facNumber') }}">
            </div>
        </div>                                
        <div class="form-group">
            <label class="col-md-4 control-label"> {{trans('messages.semester')}}</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="semester" value="{{ old('semester') }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label"> {{trans('messages.group')}}</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="group" value="{{ old('group') }}">
            </div>
        </div>
        
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label" id="studentMajor" > {{trans('messages.major')}}</label>
        <label class="col-md-4 control-label" id="teacherMajor" > {{trans('messages.department')}}</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="department" value="{{ old('department') }}">
        </div>
    </div>
  
    <div class="form-group">
        <label class="col-md-4 control-label"> {{trans('messages.degree')}}</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="degree" value="{{ old('degree') }}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label"> {{trans('messages.mobile')}}</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="mobile" value="{{ old('mobile') }}">
        </div>
    </div>                           
    <div id='teacherInfo'>                             
        <div class="form-group">
            <label class="col-md-4 control-label"> {{trans('messages.cabinetNumber')}}</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="cabinet" value="{{ old('cabinet') }}">
            </div>
        </div>                               
    </div>
    <div class="form-group">  
        <div class="col-md-6 col-md-offset-4">
            <input type="button" id="backToFirstForm"  class="btn btn-primary" style="float:left;" value=" {{trans('messages.back')}}">

            <input type="submit" id="submit"  class="btn btn-primary" style="float:right;" value=" {{trans('messages.finishReg')}}">

        </div>
    </div>

</div>