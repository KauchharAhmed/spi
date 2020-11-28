@extends('admin.masterSuperAdmin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                 SENT SMS REPORT
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
                <span style="color:green">Sent SMS Report</span>
              </div>
                    <div class="col-md-2">
                    <div class="form-group m-form__group">
                    <label for="full_name">From <span style="color:red">*</span> </label>
                        <input type="text" class="form-control" id="m_datepicker_1" placeholder="Select From" name="from" data-date-format="dd-mm-yyyy">
                    </div>
                </div>
                       <div class="col-md-2">
                    <div class="form-group m-form__group">
                    <label for="full_name">To <span style="color:red">*</span> </label>
                        <input type="text" class="form-control" id="m_datepicker_1" placeholder="Select To" name="to" data-date-format="dd-mm-yyyy">
                    </div>
                </div>
                 <div class="col-md-2">
                    <div class="form-group m-form__group">
                    <label for="full_name">Select Type <span style="color:red">*</span> </label>
                        <select class="form-control" id="type">
                          <option value="">ALL</option>
                          <option value="1">EMPLOYEE</option>
                          <option value="2">STUDENT</option>
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
<span id="error_text" style="color:red; font-weight: bold;font-size: 31px;"></span>
<span id="get_content" style="display: none;"></span>            
</div>
</div>
</div>
</div>
@endsection
@section('js')
<script>
    $('#send_button').click(function(e){
    e.preventDefault();
    var from               = $('[name="from"]').val();
    var to                 = $('[name="to"]').val();
    var type               = $('#type').val();
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
        'url':"{{url('/sentSmsReportView') }}",
        'type':'post',
        'dataType':'text',
        data:{  
        from:from,
        to:to,
        type:type
        },
         success:function(data)
         {
             if(data == 'f1'){
            $('#error_text').text('No Data Found');
             $('#get_content').attr("style", "display: none;");
            return false;
          }
           else{
             $('#error_text').text('');
             $('#get_content').removeAttr( 'style' );
              $('#get_content').html(data);

           
         }
        }
        });
       });
</script>
@endsection