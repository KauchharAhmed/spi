@extends('admin.masterSuperAdmin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    ADD STAFF LEAVE
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
                {!! Form::open(['url' =>'addStaffLeaveInfo','method' => 'post','files' => true]) !!}
                   <div class="form-group m-form__group">
                        <label for="full_name">Staff Type </label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" name="staff_type" id="staff_type" required="">
                            <option value="">Select Staff Type</option>
                            <option value="2">Admin</option>
                            <option value="3">Teacher</option>
                            <option value="4">Craft</option>
                            <option value="5">Other Staff</option>
                        </select>
                    </div>
                     <div class="form-group m-form__group">
                        <label for="full_name">Staff Name -> Dept -> Mobile </label><span style="color:red ; padding-left:30px;" >*</span>
                      <select class="form-control m-input m-input--square" name="staff_id" id="staff_id" required="">
                    </select> 
                    </div>
                    <div class="form-group m-form__group">
                    <label for="full_name">Leave Date</label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="text" class="form-control" id="m_datepicker_1" placeholder="Select Leave Date" name="from" data-date-format="dd-mm-yyyy" required="">
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
                <label for="full_name"> Staff Application (Not Mendatory)</label>
               <textarea id="summernote" name="editordata"></textarea>
           </div>
               <br/><br/>
                    <div class="form-group m-form__group">
                       <button type="submit" class="btn btn-primary">ADD STAFF LEAVE</button>
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
    $('#staff_type').change(function(e){
    e.preventDefault();
    var staff_type        = $('#staff_type').val();
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
    $.ajax({
        'url':"{{ url('/getAllStaffForAddLeave') }}",
        'type':'post',
        'dataType':'text',
        data:{  
        staff_type:staff_type 
        },
         success:function(data)
         {
          $('#staff_id').html(data);
        }
        });
       });
    </script>
    @endsection