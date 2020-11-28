@extends('admin.masterTeacher')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    APPLICATION REQUEST FOR LEAVE
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
                {!! Form::open(['url' =>'requestLeaveInfo','method' => 'post','files' => true]) !!}
                        <div class="row">
                        <div class="col-md-6">
                    <div class="form-group m-form__group">
                    <label for="full_name">From &nbsp; (dd-mm-yyyy)</label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="text" class="form-control" id="m_datepicker_1" placeholder="Select From" name="from" data-date-format="dd-mm-yyyy" required="">
                    </div>
                </div>
                       <div class="col-md-6">
                    <div class="form-group m-form__group">
                    <label for="full_name">To &nbsp; (dd-mm-yyyy)</label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="text" class="form-control" id="m_datepicker_1" placeholder="Select To" name="to" data-date-format="dd-mm-yyyy" required="">
                    </div>
                </div>
            </div>
                        <div class="form-group m-form__group">
                        <label for="full_name">Leave  Type </label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" name="leve_type" required="">
                            <option value="">Select Leave Type</option>
                            <option value="1">ৈনমিত্তিক->CL</option>
                            <option value="2">অবকাশকালীন -> VL</option>
                             <option value="3">মেডিক্যাল / অসুস্হতা -> ML</option>
                              <option value="4">মাতৃত্বজনিত -> Mat L</option>
                               <option value="5">অর্জিত -> EL</option>
                                <option value="6">শ্রান্তি বিনোদনে -> RL</option>
                                <option value="7">অনন্য -> OT</option>
                        </select>
                    </div>
                        <div class="form-group m-form__group">
                        <label for="full_name"> Application Type</label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" name="application_type" required="">
                            <option value="">Select Application Type</option>
                            <option value="1">Before Leave</option>
                            <option value="2">After Leave</option>
                             
                        </select>
                    </div>
              <br/><br/><br/>
                <div class="form-group m-form__group">
                <label for="full_name"> Write Application</label><span style="color:red ; padding-left:30px;" >*</span>
               <textarea id="summernote" name="editordata" required=""></textarea>
           </div>
               <br/><br/>
                    <div class="form-group m-form__group">
                       <button type="submit" class="btn btn-primary">SENT APPLICATION FOR LEAVE</button>
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
@section('js')
  <script>
    $(document).ready(function() {
     $('#summernote').summernote({
        placeholder: 'Write Your Full Application Here',
        tabsize: 2,
        height: 500
      });
});
    </script>
    @endsection