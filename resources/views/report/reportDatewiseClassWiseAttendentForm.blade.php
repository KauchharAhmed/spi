@extends('admin.masterSuperAdmin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                   DATEWISE CLASS WISE STUDENT ATTENDENT REPORT
      
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
                <span style="color:green">Search To See Datewise Class Wise Attendent Report</span>
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
                <div class="col-md-2"></div>
                    <div class="col-md-2">
                    <div class="form-group m-form__group">
                    <label for="full_name">From </label>
                        <input type="text" class="form-control" id="m_datepicker_1" placeholder="Select From" name="from" data-date-format="dd-mm-yyyy">
                    </div>
                </div>
                       <div class="col-md-2">
                    <div class="form-group m-form__group">
                    <label for="full_name">To </label>
                        <input type="text" class="form-control" id="m_datepicker_1" placeholder="Select To" name="to" data-date-format="dd-mm-yyyy">
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
    var from        = $('[name="from"]').val();
    var to          = $('[name="to"]').val();
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
     if(from == ''){
      alert('Please Select From Date');
      return false;
    }
     if(to == ''){
      alert('Please Select To Date');
      return false;
    }
  
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
    $.ajax({
        'url':"{{url('/reportDatewiseClassWiseAttendentView') }}",
        'type':'post',
        'dataType':'text',
        data:{  
        year:year,
        shift:shift,
        dept:dept,
        semister:semister,
        section:section,
        from:from,
        to:to
        },
         success:function(data)
         {
          $('#get_content').html(data);
        }
        });
       });
</script>
@endsection