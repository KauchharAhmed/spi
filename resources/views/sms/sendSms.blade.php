@extends('admin.masterDepartmentHead')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                   SEND SMS TO STUDENT
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
{!! Form::open(['url' =>'sendingSms','method' => 'post']) !!}
             <div class="row">
              <div class="col-md-12">
                <span style="color:green">You Can Search Individualy or Both</span>
              </div>
              
                 <div class="col-md-2">
                    <label>Year</label>
                    <input type="text" class="form-control m-input" name="year" id="year" value="<?php echo date('Y') ; ?>" readonly>
                    
                </div>
                <div class="col-md-2">
                    <label>Shift</label>
                    <select class="form-control m-input" name="shift" id="shift" required="">
                        <option value="" >Select Shift</option> 
                        <?php foreach ($shift as $shifts) { ?>
                            <option value="<?php echo $shifts->id ; ?>" ><?php echo $shifts->shiftName;?></option>
                        <?php } ?> 
                    </select>
                </div>
                <div class="col-md-2">
                        <label for="phone_number">Semister</label>
                      <select class="form-control m-input" name="semister" id="semister" required="">
                          <option value="" >Select Semister</option>
                            <?php foreach ($semsiter as $semisters) { ?>
                            <option value="<?php echo $semisters->id ; ?>" ><?php echo $semisters->semisterName;?></option>
                        <?php } ?> 
                      </select>
                </div>

                  <div class="col-md-2">
                  <label for="phone_number">Section</label>
                      <select class="form-control m-input" name="section" id="section" required="">
                          <option value="" >Select Section</option>
                            <?php foreach ($section as $sections) { ?>
                            <option value="<?php echo $sections->id ; ?>" ><?php echo $sections->section_name;?></option>
                        <?php } ?> 
                      </select>
                      </div>

                      <div class="col-md-6">
                  <label for="phone_number">SMS</label>
                       <textarea  class="form-control m-input" name="sms_message" required=""></textarea>
                      </div>

                <br/><br/><br/>
                <div class="col-md-2">
                       <label for="phone_number"></label>
                       <button type="submit" id="send_button" class="form-control  btn btn-primary" style="margin-top:6px">Send Notify SMS</button>             
                </div>
                </div>
            </div>
                 {!! Form::close() !!}
         
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
