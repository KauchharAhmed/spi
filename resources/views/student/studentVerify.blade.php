@extends('admin.masterSuperAdmin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    SEARCH STUDENT ROLL TO VERIFY
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
                  <div class="col-md-6">
                  <label for="phone_number">Roll</label>
                  <input type="number" name="roll" class="form-control m-input" id="roll">
                      </div>
                      
                <br/><br/><br/>
                <div class="col-md-2">
                       <label for="phone_number"></label>
                       <button type="submit" id="send_button" class="form-control  btn btn-primary" style="margin-top:6px">REFRESS</button>             
                </div>
                </div>

            </div>
         
        <!--end: Search Form -->
        <!--begin: Datatable -->
   <!-- </div>-->
</div> 
<span id="wrong" style="color: red; font-weight: bold; font-size: 20px;"></span>   
<span id="get_content" style="display: none;"></span>             
</div>
</div>
</div>
</div>
@endsection
@section('js')
<script>
    $('#roll').keyup(function(e){
    e.preventDefault();
    var roll        = $('#roll').val();
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
    $.ajax({
        'url':"{{ url('/studentVerifyCheck') }}",
        'type':'post',
        'dataType':'text',
        data:{  
        roll:roll 
        },
         success:function(data)
         {
          if(data =='f1'){
          $('#wrong').text('No Data Found');
          $('#get_content').attr("style", "display: none;");
          }else{
          $('#wrong').text('');
          $('#get_content').removeAttr( 'style' );
          $('#get_content').html(data);
        }
        }
        });
       });

    $('#send_button').click(function(e){
    e.preventDefault();
     location.reload();
       });
</script>
@endsection