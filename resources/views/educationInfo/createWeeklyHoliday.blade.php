@extends('admin.masterSuperAdmin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    CREATE WEEKLY HOLIDAY
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
              {!! Form::open(['url' =>'createWeeklyHolidayInfo','method' => 'post']) !!}
             <div class="row">
              <div class="col-md-12">
                <span style="color:green">Click Below Button Then Will Be Created Auto Weekly Holiday Of This Year</span>
              </div>
                 <div class="col-md-2">
                    <label>Year</label>
                    <input type="text" class="form-control m-input" value="<?php echo date('Y') ; ?>" disabled>
                     <input type="hidden" class="form-control m-input" name="year" value="<?php echo date('Y') ; ?>">
                    
                </div>
              
                <br/><br/><br/>
                <div class="col-md-5">
                       <label for="phone_number"></label>
                       <button type="submit" id="send_button" class="form-control  btn btn-primary" style="margin-top:6px">Create Weekly Holiday Of <?php echo date('Y'); ?></button>             
                </div>
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


