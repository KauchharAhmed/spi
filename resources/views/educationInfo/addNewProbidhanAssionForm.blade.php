@extends('admin.masterAdmin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    ADD NEW ASSIGN YEAR IN PROBIDHAN
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
            {!! Form::open(['url' =>'addAssignYearProbidhanInfo','method' => 'post','files' => true]) !!}
                    <div class="form-group m-form__group">
                        <label for="full_name">Year</label><span style="color:red ; padding-left:30px;" >*</span>
                        <input class="form-control m-input m-input--square" type="text" name="year" value="<?php echo date('Y');?>" required="" readonly="">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="full_name">Select Probidhan</label><span style="color:red ; padding-left:30px;" >*</span>  
                        <select class="form-control m-input m-input--square" name="probidhan" required="">
                        <option value="">Select Probidhan</option>
                        <?php foreach ($probidhan as $probidhan_value) { ?>
                          <option value="<?php echo $probidhan_value->id;?>"><?php echo $probidhan_value->probidhan_name ; ?></option>  
                        <?php } ?>  
                        </select>
                    </div>
                        <div class="form-group m-form__group">
                        <label for="full_name">Select Probidhan Status</label><span style="color:red ; padding-left:30px;" >*</span>  
                        <select class="form-control m-input m-input--square" name="probidhan_status" required="">
                        <option value="">Select Probidhan Status</option>
                        <option value="0">Active For All Semesters</option>
                          <option value="<?php echo $semister->id;?>"> Active For <?php echo $semister->semisterName ; ?></option>    
                        </select>
                    </div>
                    <div class="form-group m-form__group">
                        <label for="phone_number">Remarks</label>
                        <textarea type="text" class="form-control m-input m-input--square" name="remarks" placeholder="Remarks"></textarea>
                    </div>
                    <div class="form-group m-form__group">
                       <button type="submit" class="btn btn-primary">ADD ASSIGN YEAR IN PROBIDHAN</button>
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