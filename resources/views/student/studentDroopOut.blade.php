@extends('admin.masterSuperAdmin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    INSERT DROOP OUT INFO
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
              <div class="m-portlet__body" style="background: aliceblue;">
  <div class="row">
 <div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Id Card Created :</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"><?php if($data->print_id_status == '1'): ;?>
  <span style="color:green;font-weight: bold">YES</span>
<?php else:?>
  <span style="color:red;font-weight: bold">NO</span>
<?php endif;?>

</div>
<div class="col-md-4"></div>

<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">RFID :</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"><?php if($data->rfIdNumber != ''): ;?>
  <span style="color:green;font-weight: bold">COMPLETED (<?php echo $data->rfIdNumber;?>)</span>
<?php else:?>
  <span style="color:red;font-weight: bold">NOT COMPLETED</span>
<?php endif;?>

</div>
<div class="col-md-4"></div>
<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">ID No</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"><?php echo 'S-'.$data->studentID ;?></div>
<div class="col-md-4"></div>
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
<div class="col-md-2" style="font-weight: bold;">Wrong Semister</div>
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
<div class="col-md-2" style="font-weight: bold;"> <?php echo $data->roll ;?></div>
<div class="col-md-4"></div>

<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Student Registration</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"><?php echo $data->registration ;?></div>
<div class="col-md-4"></div>

<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Student Photo</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"> <?php if(!empty($data->studentImage)):?>
<img src="{{URL::to($data->studentImage) }}" width="150" height="100">
               <?php else:?>
                <span style="color:red">GET BLANK ID CARD</span>
                <?php endif; ?>
               </div>
<div class="col-md-4"></div>
<div class="col-md-3"></div>
{!! Form::open(['url' =>'studentDroopOutInfo','method' => 'post','files' => true]) !!}
                <div class="row" style="background: #6cbfc3">
                <div class="col-md-12">
                    <div class="form-group m-form__group">
                        <label for="full_name">Right Semister Name </label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" name="right_semister" required="">
                            <option value="">Select Semister</option>
                            <?php foreach ($result as  $value) { ?>
                                <option value="<?php echo $value->id ; ?>"><?php echo $value->semisterName;?></option>
                            <?php } ?>
                        </select> 
                    </div>
                     <div class="form-group m-form__group">
                        <label for="full_name">Confirm Right Semister Name </label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" name="confirm_right_semister" required="">
                            <option value="">Select Semister</option>
                            <?php foreach ($result as  $value) { ?>
                                <option value="<?php echo $value->id ; ?>"><?php echo $value->semisterName;?></option>
                            <?php } ?>
                        </select> 
                    </div>
                    
                    <input type="hidden" name="student_id" value="<?php echo $data->studentID;?>" required="">
                    <input type="hidden" name="wrong_semister_id" value="<?php echo $data->semister_id;?>" required="">
                     <div class="form-group m-form__group">
                       <input type="submit" class="btn btn-primary" style="margin-top: 25px;" value="DROOP OUT"/>
                    </div>
                </div>
              {!! Form::close() !!}


</div>
</div>
<!--end: Search Form -->
<!--begin: Datatable -->
<!-- </div>-->
</div>
</div>


                </div>

            </div>
         
        <!--end: Search Form -->
        <!--begin: Datatable -->
   <!-- </div>-->
</div> 
<span id="wrong" style="color: red; font-weight: bold; font-size: 20px;"></span>   
<span id="get_content" style="display: none;"></span>             
</div>
</div>
</div>
</div>
@endsection
