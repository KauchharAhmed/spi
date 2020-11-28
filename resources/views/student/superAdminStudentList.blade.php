@extends('admin.masterSuperAdmin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    SEARCH STUDENT
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
              </div>
                 <div class="col-md-2">
                    <label>Year</label>
                    <input type="text" class="form-control m-input" name="year" id="year" value="<?php echo date('Y') ; ?>" disabled>
                    
                </div>
                <div class="col-md-2">
                    <label>Dept</label>
                    <select class="form-control m-input" name="dept" id="dept">
                        <option value="" >All</option> 
                        <?php foreach ($dept as $dept_value) { ?>
                            <option value="<?php echo $dept_value->id ; ?>" ><?php echo $dept_value->departmentName;?></option>
                        <?php } ?> 
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Shift</label>
                    <select class="form-control m-input" name="shift" id="shift">
                        <option value="" >All</option> 
                        <?php foreach ($shift as $shifts) { ?>
                            <option value="<?php echo $shifts->id ; ?>" ><?php echo $shifts->shiftName;?></option>
                        <?php } ?> 
                    </select>
                </div>
                <div class="col-md-2">
                        <label for="phone_number">Semester</label>
                      <select class="form-control m-input" name="semister" id="semister" required="">
                          <option value="" >All</option>
                            <?php foreach ($semsiter as $semisters) { ?>
                            <option value="<?php echo $semisters->id ; ?>" ><?php echo $semisters->semisterName;?></option>
                        <?php } ?> 
                      </select>
                </div>

                  <div class="col-md-2">
                  <label for="phone_number">Section</label>
                        <select class="form-control m-input" name="section" id="section">
                          <option value="">All</option>
                          
                    </select>
                      </div>

                    
                <br/><br/><br/>
                <div class="col-md-2">
                       <label></label>
                       <button type="submit" id="send_button" class="form-control  btn btn-primary" style="margin-top:6px">Get Student List</button>             
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
        'url':"{{url('/getSectionByDepartmentForSuperadmin') }}",
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
    var dept        = $('#dept').val();
    var shift       = $('#shift').val();
    var semister    = $('#semister').val();
    var section     = $('#section').val();

       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
    $.ajax({
        'url':"{{ url('/getStudentListForSuperAdmin') }}",
        'type':'post',
        'dataType':'text',
        data:{  
        year:year,
        dept:dept,
        shift:shift,
        semister:semister,
        section:section
        },
         success:function(data)
         {
          $('#get_content').html(data);
        }
        });
       });
</script>
@endsection