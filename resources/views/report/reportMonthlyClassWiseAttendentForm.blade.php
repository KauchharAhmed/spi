@extends('admin.masterSuperAdmin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                   MONTHLY CLASS WISE STUDENT ATTENDENT REPORT
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
                <span style="color:green">Search To See Monthly Class Wise Attendent Report</span>
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
                    <label>Shift</label>
                    <select class="form-control m-input" name="shift" id="shift">
                        <option value="" >Select Shift</option> 
                        <?php foreach ($shift as $shifts) { ?>
                            <option value="<?php echo $shifts->id ; ?>" ><?php echo $shifts->shiftName;?></option>
                        <?php } ?> 
                    </select>
                </div>

                   <div class="col-md-2">
                    <label>Department</label>
                    <select class="form-control m-input" name="dept" id="dept">
                        <option value="" >Select Department</option> 
                        <?php foreach ($dept as $depts) { ?>
                            <option value="<?php echo $depts->id ; ?>" ><?php echo $depts->departmentName;?></option>
                        <?php } ?> 
                    </select>
                </div>
                   <div class="col-md-2">
                    <label>Semister</label>
                    <select class="form-control m-input" name="semister" id="semister">
                        <option value="" >Select Semister</option> 
                        <?php foreach ($semister as $semisters) { ?>
                            <option value="<?php echo $semisters->id ; ?>" ><?php echo $semisters->semisterName;?></option>
                        <?php } ?> 
                    </select>
                </div>

                  <div class="col-md-2">
                    <label>Section</label>
                    <select class="form-control m-input" name="section" id="section">
                          
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


    $('#dept').change(function(e){
    e.preventDefault();
    var dept        = $(this).val();
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
    $.ajax({
        'url':"{{url('/getSectionByDepartment') }}",
        'type':'post',
        'dataType':'text',
        data:{  
        dept:dept
        },
         success:function(data)
         {
          //console.log(data);
          $('#section').html(data);
        }
        });
       });

    $('#send_button').click(function(e){
    e.preventDefault();
    var year        = $('#year').val();
    var shift       = $('#shift').val();
    var dept        = $('#dept').val();
    var semister    = $('#semister').val();
    var section     = $('#section').val();
    var month       = $('#month').val();
    if(year == ''){
      alert('Please Select Year');
      return false;
    }
    if(shift == ''){
      alert('Please Select Shift');
      return false;
    }
    if(dept == ''){
      alert('Please Select Department');
      return false;
    }
    if(semister == ''){
      alert('Please Select Semister');
      return false;
    }
    if(section == ''){
      alert('Please Select Section');
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
        'url':"{{url('/reportMonthlyClassWiseAttendentView') }}",
        'type':'post',
        'dataType':'text',
        data:{  
        year:year,
        shift:shift,
        dept:dept,
        semister:semister,
        section:section,
        month:month
        },
         success:function(data)
         {
          //console.log(data);
          $('#get_content').html(data);
        }
        });
       });
</script>
@endsection