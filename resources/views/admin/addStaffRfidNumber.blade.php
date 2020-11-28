@extends('admin.masterAdmin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                     ADD STAFF RFID CARD NUMBER
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
  <?php if($dept != '0'){?>

<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Department Name</div>
<div class="col-md-1"> : </div>
<div class="col-md-6"><?php echo $dept->departmentName ;?></div>
<?php } ?>
<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Name</div>
<div class="col-md-1"> : </div>
<div class="col-md-6"> <?php echo $data->name ;?></div>
<div class="col-md-3"></div>

<div class="col-md-2" style="font-weight: bold;">Type</div>
<div class="col-md-1"> : </div>
<div class="col-md-6"> <?php if($data->type =='3'){
echo "Teacher";
}elseif($data->type =='5'){
  echo "Staff";
}else{
    echo "Craft Instructor";
}?></div>


<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Photo</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"> <?php if(!empty($data->image)){?>
<img src="{{URL::to($data->image) }}" width="100" height="50">
               <?php }?></div>
<div class="col-md-4"></div>


</div>
            <div class="row" style="margin-left: 250px;">
             {!! Form::open(['url' =>'addStaffRfidNoInfo','method' => 'post']) !!}
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
                       <button type="submit" id="send_button" class="form-control  btn btn-primary">Add RfId Card Number</button>             
                </div>
                <input type="hidden" name="id" value="<?php echo $data->id ;?>">
               
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
@section('js')

@endsection