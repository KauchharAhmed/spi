@extends('admin.masterSuperAdmin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                   MONTHLY STAFF DOOR ATTENDENT REPORT
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
              <div class="col-md-12">
                <span style="color:green">Search To See Monthly Staff Door Attendent Report</span>
              </div>
                <div class="col-md-2">
                   <label>Year</label>
                    <select class="form-control m-input" name="year" id="year">
                        <option value="" >Select Year</option> 
                        <?php foreach ($year as $years) { ?>
                            <option value="<?php echo $years->year ; ?>" ><?php echo $years->year;?></option>
                        <?php } ?> 
                    </select>
                </div>

                  <div class="col-md-2">
                    <label>Month</label>
                    <select class="form-control m-input" name="month" id="month">
                                        <option value="">Select Month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
 
                    </select>
                </div>
                 <div class="col-md-2">
                    <div class="form-group m-form__group">
                    <label for="full_name">Select Staff Type </label>
                       <select class="form-control" id="staff_type">
                         <option value="0">ALL</option>
                         <option value="2">Admin</option>
                         <option value="3">Teachers</option>
                         <option value="4">Craft</option>
                         <option value="5">Other Staff</option>
                       </select>
                    </div>
                </div>
                <br/><br/><br/>
                <div class="col-md-2">
                       <label for="phone_number"></label>
                       <button type="submit" id="send_button" class="form-control  btn btn-primary" style="margin-top:6px">GET REPORT</button>             
                </div>
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
<script>
   $('#send_button').click(function(e){
    e.preventDefault();
    var year        = $('#year').val();
    var month       = $('#month').val();
    var staff_type  = $('#staff_type').val();
    if(year == ''){
      alert('Please Select Year');
      return false;
    }
     if(month == ''){
      alert('Please Select month');
      return false;
    }
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
    $.ajax({
        'url':"{{url('/reportMonthlyStaffDoorAttendentView') }}",
        'type':'post',
        'dataType':'text',
        data:{  
        year:year,
        month:month,
        staff_type:staff_type
        },
         success:function(data)
         {
          $('#get_content').html(data);
        }
        });
       });
</script>
@endsection

