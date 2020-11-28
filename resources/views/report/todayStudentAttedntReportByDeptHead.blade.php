@extends('admin.masterDepartmentHead')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    GET TODAY REPORT
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
                <span style="color:green">Search To See Today Attendent Report</span>
              </div>
   
                <div class="col-md-4">
                    <label>Shift</label>
                    <select class="form-control m-input" name="shift" id="shift">
                        <option value="" >Select Shift</option> 
                        <?php foreach ($shift as $shifts) { ?>
                            <option value="<?php echo $shifts->id ; ?>" ><?php echo $shifts->shiftName;?></option>
                        <?php } ?> 
                    </select>
                </div>
                <input type="hidden" id="dept" value="<?php echo Session::get('dept_id'); ?>">
                  
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
    var shift       = $('#shift').val();
    var dept        = $('#dept').val();
    if(shift == ''){
      alert('Please Select Shift');
      return false;
    }
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
    $.ajax({
        'url':"{{url('/reportTodayAttendentView') }}",
        'type':'post',
        'dataType':'text',
        data:{  
        shift:shift,
        dept:dept
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