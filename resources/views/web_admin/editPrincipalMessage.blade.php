@extends('web_admin.webMasterAdmin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    EDIT PRINCIPAL MESSAGE
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
                {!! Form::open(['url' =>'updatePrincipalMessage','method' => 'post','files' => true]) !!}
                    <div style="display: none;" class="form-group m-form__group">
                        <label for="principal_name">Principal Name</label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="text" class="form-control m-input m-input--square" name="principal_name" value="<?php echo $value->principal_name; ?>" required="">  
                    </div>
                    <div class="form-group m-form__group">
                        <label for="phone_number">Message</label> <span style="color:red ; padding-left:30px;" >*</span>
                        <textarea type="text" class="form-control m-input m-input--square" name="principal_message"><?php echo $value->principal_message; ?></textarea>
                    </div>

                    <div style="display: none;" class="form-group m-form__group">
                        <label for="full_name">Joining Date &nbsp; (yyyy-mm-dd)</label>
                        <input type="text" class="form-control" id="m_datepicker_1" name="join_date" data-date-format="yyyy-mm-dd" value="<?php echo date('Y-m-d',strtotime($value->join_date)) ?>">
                    </div>

                    <div style="display: none;" class="form-group m-form__group">
                        <label for="full_name">Resignation / Transfer Date &nbsp; (yyyy-mm-dd)</label>
                        <input type="text" class="form-control" id="m_datepicker_1" name="regine_date" data-date-format="yyyy-mm-dd" >
                    </div>

                    <div style="display: none;" class="form-group m-form__group">
                        <label for="full_name">Current Image</label>
                        <br>
                        <img src="{{URL::to('web_images/'.$value->image)}}" alt="<?php echo $value->principal_name; ?>" width="100" height="100">
                    </div>

                    <div style="display: none;" class="form-group m-form__group">
                        <label for="phone_number">Upload Image <span style="color:green">(Must Be jpg, jpeg , png type And Max Size 100 KB)</span></label>
                        <input type="file" class="form-control m-input m-input--square" name="image">
                    </div>
                    <input type="hidden" name="primary_id" value="<?php echo $value->id; ?>">
                    <div class="form-group m-form__group">
                       <button type="submit" class="btn btn-primary">UPDATE</button>
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