@extends('admin.masterDepartmentHead')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    MANUAL TEACHER ATTENDENT
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
                <span style="color:green">Search To See Attendent Routine Of This Teacher</span>
              </div>
                <div class="col-md-4">
                    <label>Teacher</label>
                    <select class="form-control m-input m-input--square" id="teacher_id" name="teacher">
                        <option value="" >Select Teacher</option> 
                        <?php foreach ($teacher as $teachers) { ?>
                            <option value="<?php echo $teachers->id ; ?>" ><?php echo $teachers->name.' -> '.$teachers->short_name;?></option>
                        <?php } ?> 
                    </select>
                </div>
                 <div class="col-md-4">
                    <div class="form-group m-form__group">
                    <label for="full_name">Select Date</label>
                        <input type="text" class="form-control" id="m_datepicker_1" value="<?php echo date('d-m-Y');?>" name="from" data-date-format="dd-mm-yyyy">
                    </div>
                </div>
                <br/><br/><br/>
                <div class="col-md-2">
                       <label for="phone_number"></label>
                       <button type="submit" id="send_button"  class="form-control  btn btn-primary" style="margin-top:6px;width: 173px;">SEARCH ROUTINE</button>             
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
     $('#teacher_id').select2({

    });
    $('#send_button').click(function(e){
    e.preventDefault();
    var teacher_id            = $('#teacher_id').val();
    var attendent_date        = $('#m_datepicker_1').val();
    if(teacher_id == ''){
      alert('Please Select Teacher');
      return false;
    }
    if(attendent_date == ''){
      alert('Please Select Attendent Date');
      return false;
    }
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
    $.ajax({
        'url':"{{url('/manualTeacherAttendentByDeptHeadInfo') }}",
        'type':'post',
        'dataType':'text',
        data:{  
        teacher_id:teacher_id,
        attendent_date:attendent_date
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