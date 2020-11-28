@extends('admin.masterSuperAdmin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    CHANGE OFFICE TIME
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
                {!! Form::open(['url' =>'editOfficeTimeStart','method' => 'post','files' => true]) !!}
                     <div class="form-group m-form__group">
                        <label for="full_name">Shift
                        </label>
                       <input type="text" class="form-control m-input m-input--square" name="staff_name" value="<?php echo $result->shiftName ;;?>" readonly>
                    </div>
                    
                     <div class="form-group m-form__group">
                        <label for="full_name">Current Office Time
                        </label>

                       <input type="text" class="form-control m-input m-input--square" name="card_enter_time" value="<?php echo date('h:i:s a',strtotime($result->office_start));?>" readonly>
                    </div>
                       <div class="form-group m-form__group">
                        <label for="full_name">Change Office Start Time </label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="text" class="form-control m-input m-input--square" name="change_office_time" id="m_timepicker_1" required="">  
                    </div>
                    <input type="hidden" name="shift_id" value="<?php echo $result->id;?>">
                    <button type="submit" class="btn btn-primary">CHANGE OFFICE TIME</button>
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
