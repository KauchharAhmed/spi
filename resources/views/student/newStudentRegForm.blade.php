@extends('admin.masterDepartmentHead')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    ADD NEW STUDENT
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
                {!! Form::open(['url' =>'addNewStudentInfo','method' => 'post','files' => true]) !!}
                <div class="row">
                <div class="col-md-6">
                    <h3><strong>ACADEMIC INFORMATION</strong></h3>
                <div class="form-group m-form__group">
                        <label for="full_name">Department Name </label>
                        <input type="text" class="form-control m-input m-input--square" value="<?php echo $row->departmentName ?>" disabled> 
                        <input type="hidden" class="form-control m-input m-input--square" name="department" id="dept_id" value="<?php echo $row->id ?>"> 
                    </div>
                        <div class="form-group m-form__group">
                        <label for="full_name">Year </label>
                        <input type="text" class="form-control m-input m-input--square" value="<?php echo '2019';?>" disabled> 
                         <input type="hidden" class="form-control m-input m-input--square" name="year" value="<?php echo '2019';?>">  
                    </div>
                    <div class="form-group m-form__group">
                        <label for="full_name">Enter RfId Number</label> 
                        <input type="text" class="form-control m-input m-input--square" name="rfid">
                    </div> 
                       <div class="form-group m-form__group">
                        <label for="full_name">Session </label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" id="session" name="session" required="">
                            <option value="">Select Session</option>
                            <?php foreach ($session as $sesssions) { ?>
                                <option value="<?php echo $sesssions->id ; ?>"><?php echo $sesssions->sessionName;?></option>
                            <?php } ?>
                            
                        </select> 
                    </div>

                        <div class="form-group m-form__group">
                        <label for="full_name">Shift Name </label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" id="shift_id" name="shift" required="">
                            <option value="">Select Shift</option>
                            <?php foreach ($shift as  $shifts) { ?>
                                <option value="<?php echo $shifts->id ; ?>"><?php echo $shifts->shiftName;?></option>
                            <?php } ?>
                            
                        </select> 
                    </div>

                    <div class="form-group m-form__group">
                        <label for="full_name">Semister Name </label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" id="semister_id" name="semister" required="">
                            <option value="">Select Semister</option>
                            <?php foreach ($result as  $value) { ?>
                                <option value="<?php echo $value->id ; ?>"><?php echo $value->semisterName;?></option>
                            <?php } ?>
                            
                        </select> 
                    </div>
                      <div class="form-group m-form__group">
                        <label for="full_name">Section Name </label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" id="section_id" name="section" required="">
                            <option value="">Select Section</option>
                            <?php foreach ($section as  $sections) { ?>
                                <option value="<?php echo $sections->id ; ?>"><?php echo $sections->section_name;?></sections>
                            <?php } ?>
    
                        </select> 
                    </div>
                        <div class="form-group m-form__group">
                        <label for="full_name">Board Roll</label><span style="color:red ; padding-left:30px;" >*</span> 
                        <input type="number" class="form-control m-input m-input--square" name="roll" >
                    </div> 
                        <div class="form-group m-form__group">
                        <label for="full_name">Registration Number</label><span style="color:red ; padding-left:30px;" >*</span> 
                        <input type="number" class="form-control m-input m-input--square" name="registration" >
                    </div>

                        <div class="form-group m-form__group">
                        <label for="full_name">Status </label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" id="activity_status" name="activity_status" required="">
                            <option value="">Select Status</option>
                            <option value="1">Regular</option>
                            <option value="2">Irregular</option>                            
                        </select> 
                    </div>
                <!-- end colum md - 6 ----->
                </div>

                <div class="col-md-6">
                 <h3><strong>BASIC INFORMATION</strong></h3>
                      <div class="form-group m-form__group">
                        <label for="full_name">Student Name </label><span style="color:red ; padding-left:30px;" >*</span> 
                        <input type="text" class="form-control m-input m-input--square" name="student_name" required="" >
                    </div>

                        <div class="form-group m-form__group">
                        <label for="full_name">Father Name </label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="text" class="form-control m-input m-input--square" name="father_name">
                    </div>
                     <div class="form-group m-form__group">
                        <label for="full_name">Mother Name </label>
                        <input type="text" class="form-control m-input m-input--square" name="mother_name">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="full_name">Student Email (If It) </label>
                        <input type="email" class="form-control m-input m-input--square" name="email">
                    </div>
                      <div class="form-group m-form__group">
                        <label for="full_name">Student Mobile (Must Be 11 Digits) </label> 
                        <input type="number" class="form-control m-input m-input--square" name="student_mobile">
                    </div>
                        <div class="form-group m-form__group">
                        <label for="full_name">Parents Mobile </label>
                        <input type="number" class="form-control m-input m-input--square" name="parents_mobile" >
                    </div>
                        <div class="form-group m-form__group">
                        <label for="full_name">Date Of Birth </label>
                        <input type="number" class="form-control m-input m-input--square" name="date_of_birth" >
                    </div>

                      <div class="row">
                        <!-- first col 6 -->
                        <div class="col-md-6">
                        <div class="form-group m-form__group">
                        <label for="full_name">Sex </label>
                        <select class="form-control m-input m-input--square" name="sex">
                            <option value="">Select Sex</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                    </div>
                </div>
                <!-- end first col-6----->
                  <!-- second col 6 -->
                  <div class="col-md-6">
                      <div class="form-group m-form__group">
                        <label for="full_name">Religion </label>
                        <select class="form-control m-input m-input--square" name="religion">
                            <option value="">Select Religion</option>
                            <option value="1">Islam</option>
                            <option value="2">Hindu</option>
                            <option value="3">Christan</option>
                            <option value="4">Buddist</option>
                            <option value="5">Other</option>
                        </select>
                    </div>
                </div>
                <!-- end second col-6----->
                   </div>

                    <div class="form-group m-form__group">
                        <label for="phone_number">Present Address</label>
                        <textarea type="text" class="form-control m-input m-input--square" name="present_address"></textarea>
                    </div>
                      <div class="form-group m-form__group">
                        <label for="phone_number">Permanent Address</label>
                        <textarea type="text" class="form-control m-input m-input--square" name="permanent_address"></textarea>
                    </div>
                   
                    <div class="form-group m-form__group">
                        <label for="phone_number">Remarks</label>
                        <textarea type="text" class="form-control m-input m-input--square" name="remarks"></textarea>
                    </div>

                    <div class="form-group m-form__group">
                        <label for="phone_number">Picture</label>
                        <input type="file" class="form-control m-input m-input--square" name="image" >
                    </div>
                </div>
            </div>
                    <div class="form-group m-form__group">
                       <button type="submit" class="btn btn-primary" style="margin-top: 25px;">ADD NEW STUDENT</button>
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
@section('js')
<script>
   $('#session').select2({

   });
</script>
@endsection