@extends('admin.masterDepartmentHead')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                     ADD STUDENT RFID CARD NUMBER
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
<div class="row">

<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Department Name</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"><?php echo $data->departmentName ;?></div>
<div class="col-md-4"></div>
<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Shift Name</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"> <?php echo $data->shiftName ;?></div>
<div class="col-md-4"></div>

<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Semister Name</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"> <?php echo $data->semisterName ;?></div>
<div class="col-md-4"></div>

<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Section Name</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"><?php echo $data->section_name ;?></div>
<div class="col-md-4"></div>

<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Student Name</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"> <?php echo $data->studentName ;?></div>
<div class="col-md-4"></div>

<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Student Roll</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"> <?php echo $data->roll ;?></div>
<div class="col-md-4"></div>

<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Student Registration</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"><?php echo $data->registration ;?></div>
<div class="col-md-4"></div>

<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Student Photo</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"> <?php if(!empty($data->studentImage)){?>
                <img src="{{URL::to($data->studentImage) }}" width="100" height="50">
               <?php }?></div>
<div class="col-md-4"></div>
</div>
              <div class="row" style="margin-left: 250px;" style="background:#cabbb">
             {!! Form::open(['url' =>'addStudentRfidNo','method' => 'post']) !!}
            <div class="form-group m-form__group">
                        <label for="full_name">Enter RfId Number</label> 
                        <input type="number" class="form-control m-input m-input--square" name="rfid" required="" style="border: 1px solid green;">
                    </div>
             <div class="form-group m-form__group">
                        <label for="full_name">Confirm Enter RfId Number</label> 
                        <input type="number" class="form-control m-input m-input--square" name="confirm_rfid" required="" style="border: 1px solid green;">
                    </div>
                <div class="form-group m-form__group">
                       <label for="phone_number"></label>
                       <button type="submit" id="send_button" class="form-control  btn btn-primary" style="margin-top:6px;">Add RfId Card Number</button>             
                </div>
                <input type="hidden" name="id" value="<?php echo $data->id;?>">
                <input type="hidden" name="shift" value="<?php echo $shiftID;?>">
                <input type="hidden" name="semister" value="<?php echo $semisterID;?>">
              
                  {!! Form::close() !!}
                    </div>
            </div>
         
        <!--end: Search Form -->
        <!--begin: Datatable -->
   <!-- </div>-->
</div> 
<span id="get_content"></span>             
</div>
</div>
</div>
</div>
@endsection
