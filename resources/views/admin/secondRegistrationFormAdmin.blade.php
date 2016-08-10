<div id='secondForm'> 
    <div id='studentInfo'>
        <div class="form-group">
            <label class="col-md-4 control-label"> {{trans('messages.faculty')}}</label>
            <div class="col-md-6">
                <select class="form-control" id='selectFaculty' name="faculty">
                    <option  value="">Select faculty</option>
                    @foreach($faculties as $faculty)
                    <option value="{{$faculty->id}}">{{$faculty->$facultyColumnName}}</option>
                    @endforeach
                </select>        
            </div>
        </div>
        <div id="afterChoosedFaculty">
            <div class="form-group">
                <label class="col-md-4 control-label" id="studentMajor" > {{trans('messages.major')}}</label>

                <div class="col-md-6">
                    <div id="textNoMajor"></div>
                    <select class="form-control" id='selectMajor' name="major" style="display: none">
                        <option  value="">Select Major</option>
                    </select>  
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label"> {{trans('messages.year')}}</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id='year' name="year" value="{{ old('year') }}">
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
    </div>



    <div id='teacherInfo'> 
        <div class="form-group">
            <label class="col-md-4 control-label" id="teacherMajor" > {{trans('messages.department')}}</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="department" value="{{ old('department') }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label"> {{trans('messages.cabinetNumber')}}</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="cabinet" value="{{ old('cabinet') }}">
            </div>
        </div>                               
    </div>
    <div id="commonInfo">
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
    </div>
    <div class="form-group">  
        <div class="col-md-6 col-md-offset-4">
            <input type="button" id="backToFirstForm"  class="btn btn-primary" style="float:left;" value=" {{trans('messages.back')}}">

            <input type="submit" id="submit"  class="btn btn-primary" style="float:right;" value=" {{trans('messages.finishReg')}}">

        </div>
    </div>
</div>
</div>