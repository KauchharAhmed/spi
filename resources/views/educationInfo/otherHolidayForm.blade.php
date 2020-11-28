@extends('admin.masterSuperAdmin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    ADD NEW HOLIDAY
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
                {!! Form::open(['url' =>'addOtherHolidayInfo','method' => 'post']) !!}
                    <div class="form-group m-form__group">
                    <label for="full_name">Holiday Type </label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" name="holiday_type" required="">
                        	<option value="">Select Holiday Type</option>
                        	<option value="2/0">Public</option>
                        	<option value="3/0">Optional</option>
                        	<option value="4/0">National</option>
                        	<option value="5/1">Exam Break</option>
                        	<option value="6/1">Semister Break</option>
                        	<option value="7/0">Observance</option>
                        	<option value="8/1">Sports Break</option>
                        </select>
                    </div>
                    <div class="form-group m-form__group">
                    <label for="full_name">Holiday Date &nbsp; (yyyy-mm-dd)</label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="text" class="form-control" id="m_datepicker_1" placeholder="Select Holiday Date"  name="holiday_date" data-date-format="yyyy-mm-dd" required="">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="phone_number">Remarks</label>
                        <textarea type="text" class="form-control m-input m-input--square" name="remarks" placeholder="Remarks"></textarea>
                    </div>
                    <div class="form-group m-form__group">
                       <button type="submit" class="btn btn-primary">ADD NEW OTHER HOLIDAY</button>
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