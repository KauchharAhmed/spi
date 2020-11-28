@extends('admin.masterSuperAdmin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    EDIT STAFF ATTENDENT TIME
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
                {!! Form::open(['url' =>'editStaffManualEditAttendentTimeInfo','method' => 'post','files' => true]) !!}
                <center><span><img style="border-radius: 50%" width="80" height="80" src="{{URL::to($result->image)}}"></span></center>
                    <div class="form-group m-form__group">
                    <label for="full_name">Staff Type </label>
                      <?php if($result->type == '2'){
                        $staff_type_is = "Admin";
                      }elseif($result->type == '3'){
                        $staff_type_is = "Teacher";
                      }elseif($result->type == '4'){
                        $staff_type_is = "Craft";
                      }elseif($result->type == '5'){
                        $staff_type_is = "Other Staff";
                      }
                      ?>
                      <input type="text" class="form-control m-input m-input--square" name="staff_type" value="<?php echo $staff_type_is;?>" readonly>
                    </div>
                     <div class="form-group m-form__group">
                        <label for="full_name">Staff Name -> DEPT -> Mobile
                        </label>
                        <?php
                        $staff_details = $result->name.' -> '.$result->departmentName.' -> '.$result->mobile;
                        ?>
                       <input type="text" class="form-control m-input m-input--square" name="staff_name" value="<?php echo $staff_details;?>" readonly>
                    </div>
                        <div class="form-group m-form__group">
                        <label for="full_name">Attendent Date
                        </label>
                       <input type="text" class="form-control m-input m-input--square" name="attendent_date" value="<?php echo date('d-m-Y',strtotime($attendent_date));?>" readonly>
                    </div>
                     <div class="form-group m-form__group">
                        <label for="full_name">Today First Enter Time
                        </label>

                       <input type="text" class="form-control m-input m-input--square" name="card_enter_time" value="<?php echo date('h:i:s a',strtotime($first_enter_time->enter_time));?>" readonly>
                    </div>
                       <div class="form-group m-form__group">
                        <label for="full_name">Change Enter Time </label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="text" class="form-control m-input m-input--square" name="enter_time" id="m_timepicker_1" required="">  
                    </div>
                    <input type="hidden" name="door_log_id" value="<?php echo $first_enter_time->id;?>" required="">
                    <input type="hidden" name="staff_id_is" value="<?php echo $result->id;?>" required="">
                    <input type="hidden" name="staff_attendent_date_is" value="<?php echo $attendent_date;?>" required="">
                    <input type="hidden" name="staff_type_is" value="<?php echo $result->type ; ?>" required>
                    <button type="submit" class="btn btn-primary">EDIT MANUAL STAFF ATTENDENT TIME</button>
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