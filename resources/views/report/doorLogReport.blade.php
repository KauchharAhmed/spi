@extends('admin.masterSuperAdmin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                  DOOR LOG REPORT
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
                <span style="color:green">Door Log Report</span>
              </div>
                    <div class="col-md-2">
                    <div class="form-group m-form__group">
                    <label for="full_name">Select Date <span style="color:red;">*</span> </label>
                        <input type="text" class="form-control" id="m_datepicker_1" value="<?php echo date('d-m-Y');?>" name="from" data-date-format="dd-mm-yyyy">
                    </div>
                </div>
                  <div class="col-md-2">
                    <div class="form-group m-form__group">
                    <label for="full_name">Select Type <span style="color:red;">*</span> </label>
                       <select class="form-control" id="type_of_person">
                         <option value="0">ALL</option>
                         <option value="staff">All Staffs</option>
                         <option value="stu">All Students</option>
                         <option value="2">Admin</option>
                         <option value="3">Teachers</option>
                         <option value="4">Craft</option>
                         <option value="5">Other Staff</option>
                         <option value="10">Guest</option>
                       </select>
                    </div>
                </div>
                  <div class="col-md-2">
                    <div class="form-group m-form__group">
                    <label for="full_name">Order <span style="color:red;">*</span> </label>
                       <select class="form-control" id="order_is">
                         <option value="0">Select Order</option>
                         <option value="1">First</option>
                         <option value="2">Last</option>
                       </select>
                    </div>
                </div>
                  <div class="col-md-2">
                    <div class="form-group m-form__group">
                    <label for="full_name">How Many Person <span style="color:red;">*</span> </label>
                      <input type="number" id="see_how_many_person" class="form-control">
                    </div>
                </div>
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
    var from_date       = $('#m_datepicker_1').val();
    var type_of_person  = $('#type_of_person').val();
    var order_is        = $('#order_is').val();
    var see_how_many_person        = $('#see_how_many_person').val();
    if(from_date == ''){
      alert('Please Select Date');
      return false;
    }
    if(type_of_person == ''){
      alert('Please Select Person Type');
      return false;
    }
    if(order_is == '0'){
      alert('Please Select Order');
      return false;
    }
    if(see_how_many_person == ''){
      alert('Please Select How Many Perosn');
      return false;
    }
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
      $.ajax({
        'url':"{{url('/reportDoorLogView') }}",
        'type':'post',
        'dataType':'text',
        data:{  
        from_date:from_date,
        type_of_person:type_of_person,
        order_is:order_is,
        see_how_many_person:see_how_many_person,
        },
         success:function(data)
         {
          if(data == 'f1'){
            $('#error_text').text('No Data Found');
             $('#get_content').attr("style", "display: none;");
            return false;
          }
           else if(data == 'f2'){
            $('#error_text').text('This Day Was Holiday');
             $('#get_content').attr("style", "display: none;");
            return false;
          }else{
             $('#error_text').text('');
             $('#get_content').removeAttr( 'style' );
              $('#get_content').html(data);

           
         }
        }
        });
       });
</script>
@endsection