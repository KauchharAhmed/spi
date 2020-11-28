@extends('admin.masterDepartmentHead')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    ADD NEW SUBJECT
                </h3>
            </div>
        </div>
    </div>
    <!--<div class="m-portlet__body">-->
       <!--begin::Form--> 
    <div class="m-portlet__body">
        <!-- START SESSION MESSAGE -->
    <?php if(Session::get('succes') != null) { ?>
   <div class="alert alert-info alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    </button>
  <strong><?php echo Session::get('succes') ;  ?></strong>
  <?php Session::put('succes',null) ;  ?>
</div>
<?php } ?>
<?php
if(Session::get('failed') != null) { ?>
 <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    </button>
 <strong><?php echo Session::get('failed') ; ?></strong>
 <?php echo Session::put('failed',null) ; ?>
</div>
<?php } ?>

  @if (count($errors) > 0)
    @foreach ($errors->all() as $error)      
 <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    </button>
  <strong>{{ $error }}</strong>
</div>
@endforeach
@endif
<!-- end sesssion message-->
    <div class="12">
    <div style="background-color: #e7f3fe;
    border-left: 6px solid #2196F3; margin-bottom: 15px;
    padding: 4px 12px;">
    <strong> Must Be Filled Input Box Which Symbol Is <span style="color:red ; padding-left:5px;" >*</span>
    </strong>                                  
    </div>
    </div>
                {!! Form::open(['url' =>'addSubjectInfo','method' => 'post','files' => true]) !!}
                <div class="row">
                <div class="col-md-6">
                <div class="form-group m-form__group">
                        <label for="full_name">Department Name </label>
                        <input type="text" class="form-control m-input m-input--square" value="<?php echo $row->departmentName ?>" disabled> 
                        <input type="hidden" class="form-control m-input m-input--square" name="dept_id" value="<?php echo $row->id ?>"> 
                    </div>
                    <div class="form-group m-form__group">
                        <label for="full_name">Semister Name </label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" name="semister_id" required="">
                            <option value="">Select Semister</option>
                            <?php foreach ($result as  $value) { ?>
                                <option value="<?php echo $value->id ; ?>"><?php echo $value->semisterName;?></option>
                            <?php } ?>
                            
                        </select> 
                    </div>

                     <div class="form-group m-form__group">
                        <label for="full_name">Subject Name </label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="text" class="form-control m-input m-input--square" name="subject_name" placeholder="Subject Name" required="">  
                    </div>
                      <div class="form-group m-form__group">
                        <label for="full_name">Subject Code </label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="text" class="form-control m-input m-input--square" name="subject_code" placeholder="Subject Code" required="">  
                    </div>
                        <div class="form-group m-form__group">
                        <label for="full_name">Subject Creadit Value </label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="number" class="form-control m-input m-input--square" name="cradit" placeholder="Subject Creadit Value" min=1 max=8 oninput="validity.valid||(value='')"; required="">  
                    </div>

                    <div class="form-group m-form__group">
                        <label for="full_name">Subject Type </label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" name="subject_type" required="">
                          <option value="">Select Subject Type</option>
                          <option value="1">Theorotical</option>
                          <option value="2">Practical</option>  
                          <option value="3">Theorotical And Practical</option>  
                        </select>  
                    </div>
                </div>
                <div class="col-md-6">
                       <div class="form-group m-form__group">
                        <label for="full_name">Subject Status </label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" name="subject_status" required="">
                          <option value="">Select Subject Status</option>
                          <option value="1">Regular</option>
                          <option value="2">Optional</option>   
                        </select>  
                    </div>

                           <div class="form-group m-form__group">
                        <label for="full_name">Continous Theroy Marks </label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="number" class="form-control m-input m-input--square" name="cont_theroy_marks" placeholder="Continous Theroy Marks" min=0  oninput="validity.valid||(value='')"; required="">  
                    </div>
                        <div class="form-group m-form__group">
                        <label for="full_name">Final Theroy Marks </label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="number" class="form-control m-input m-input--square" name="theroy_marks" placeholder="Theory Marks" min=0  oninput="validity.valid||(value='')"; required="">  
                    </div>
                        <div class="form-group m-form__group">
                        <label for="full_name">Continous Practical Marks </label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="number" class="form-control m-input m-input--square" name="cont_practical_marks" placeholder="Continous Practical Marks" min=0 oninput="validity.valid||(value='')"; required="">  
                    </div>
                        <div class="form-group m-form__group">
                        <label for="full_name">Final Practical Marks </label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="number" class="form-control m-input m-input--square" name="practical_marks" placeholder="Final Practical Marks" min=0 oninput="validity.valid||(value='')"; required="">  
                    </div>
                    <div class="form-group m-form__group">
                        <label for="phone_number">Remarks</label>
                        <textarea type="text" class="form-control m-input m-input--square" name="remarks" placeholder="Remarks"></textarea>
                    </div>
                </div>
            </div>
                    <div class="form-group m-form__group">
                       <button type="submit" class="btn btn-primary">ADD NEW SUBJECT</button>
                    </div>
                </div>
                {!! Form::close() !!}
         
        <!--end: Search Form -->
        <!--begin: Datatable -->
   <!-- </div>-->
</div>              
</div>
</div>
</div>
</div>
@endsection