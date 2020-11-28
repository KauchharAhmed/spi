@extends('admin.masterSuperAdmin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    ADD NEW ADMIN
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
                {!! Form::open(['url' =>'addAdminInfo','method' => 'post','files' => true]) !!}
                    <div class="form-group m-form__group">
                        <label for="full_name">Full Name </label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="text" class="form-control m-input m-input--square" name="full_name" placeholder="Full Name" required="">  
                    </div>
                    <div class="form-group m-form__group">
                        <label for="phone_number">Mobile No (Login Id) <span style="color:red ; padding-left:30px;" >*</span></label>
                        <input type="number" class="form-control m-input m-input--square" name="mobile_number" placeholder="Mobile Number" required="">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="phone_number">Email</label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="email" class="form-control m-input m-input--square" name="email_address" placeholder="Email Address" required="">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="phone_number">Address</label>
                        <textarea type="text" class="form-control m-input m-input--square" name="address" placeholder="Address"></textarea>
                    </div>
                     <div class="form-group m-form__group">
                        <label for="phone_number">Upload Image <span style="color:green">(Must Be jpg, jpeg , png type And Max Size 100 KB)</span></label>
                        <input type="file" class="form-control m-input m-input--square" name="image">
                    </div>
                    <div class="form-group m-form__group">
                       <button type="submit" class="btn btn-primary">ADD NEW ADMIN</button>
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