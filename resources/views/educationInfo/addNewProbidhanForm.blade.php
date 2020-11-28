@extends('admin.masterAdmin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    ADD NEW PROBIDHAN
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
                {!! Form::open(['url' =>'addNewProbidhanInfo','method' => 'post','files' => true]) !!}
                    <div class="form-group m-form__group">
                        <label for="full_name">Probidhan Name </label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="text" class="form-control m-input m-input--square" name="probidhan_name" placeholder="Probidhan Name" required="">  
                    </div>
                    <div class="form-group m-form__group">
                        <label for="full_name">Pass / Fail Status </label><span style="color:red ; padding-left:30px;" >*</span>  
                        <select class="form-control m-input m-input--square" name="probidhan_pass_fail_status"  required="">
                            <option value="">Select Pass / Fail Status</option>
                            <option value="1">Continious And Final Marks Together (TC + TF + PC + PF)</option>
                            <option value="2">Individualy Therory And Practical Marks ({ TC + TF } ,  { PC + PF })</option> 
                            <option value="3">Individualy Continious Theory And Practical And Final Therory And Practical Marks ( { TC } , { TF } ,  { PC } , { PF })</option>
                        </select>
                    </div>
                    <div class="form-group m-form__group">
                        <label for="full_name">Mid Term Marks Percentage (%) From Continious Theory Marks</label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="number" class="form-control m-input m-input--square" name="mid_tearm_marks_percentage" placeholder="Mid Term Marks Percentage From Continious Theory" required="" min=0.00 max=100.00 oninput="validity.valid||(value='')">  
                    </div>
                    <div class="form-group m-form__group">
                        <label for="full_name">Pass Marks % (For Semester Result)</label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="number" class="form-control m-input m-input--square" name="pass_marks_percentage" placeholder="Pass Marks % (For Semester Result)" required="" min=0.00 max=100.00 oninput="validity.valid||(value='')">  
                    </div>
                       <div class="form-group m-form__group">
                        <label for="full_name">How Many Subject Fail For Dropout</label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="number" class="form-control m-input m-input--square" name="dropout_subject" placeholder="How Many Subject Fail For Dropout" required="" min=1 max=5 oninput="validity.valid||(value='')">  
                    </div>
                    <div class="form-group m-form__group">
                        <label for="full_name">Select Internal Result Semester</label><span style="color:red ; padding-left:30px;" >*</span>  
                    </div>
                     <?php foreach ($semister as $semister_value) { ?>
                    <div class="form-group m-form__group">
                        <label for="full_name"><?php echo $semister_value->semisterName ; ?></label>
                        <input type="checkbox" class="form-control m-input m-input--square" name="active_semister[]" value="<?php echo $semister_value->id ;?>">  
                    </div>
                    <?php } ?>
                    <div class="form-group m-form__group">
                        <label for="phone_number">Remarks</label>
                        <textarea type="text" class="form-control m-input m-input--square" name="remarks" placeholder="Remarks"></textarea>
                    </div>
                    <div class="form-group m-form__group">
                       <button type="submit" class="btn btn-primary">ADD NEW PROBIDHAN</button>
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