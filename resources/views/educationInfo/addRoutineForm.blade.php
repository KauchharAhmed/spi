@extends('admin.masterDepartmentHead')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    ADD NEW ROUTINE
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
                {!! Form::open(['url' =>'addRoutineInfo','method' => 'post']) !!}
                <div class="row">
                <div class="col-md-6">
                <div class="form-group m-form__group">
                        <label for="full_name">Department Name </label>
                        <input type="text" class="form-control m-input m-input--square" value="<?php echo $row->departmentName ?>" disabled> 
                        <input type="hidden" class="form-control m-input m-input--square" name="department" id="dept_id" value="<?php echo $row->id ?>"> 
                    </div>
                        <div class="form-group m-form__group">
                        <label for="full_name">Year </label>
                        <input type="text" class="form-control m-input m-input--square" value="<?php echo date('Y');?>" disabled> 
                         <input type="hidden" class="form-control m-input m-input--square" name="year" value="<?php echo date('Y');?>">  
                    </div>

                        <div class="form-group m-form__group">
                        <label for="full_name">Shift Name </label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" id="shift_id" name="shift" required="">
                            <option value="">Select Shift</option>
                            <?php foreach ($shift as  $shifts) { ?>
                                <option value="<?php echo $shifts->id ; ?>"><?php echo $shifts->shiftName;?></option>
                            <?php } ?>
                            
                        </select> 
                    </div>

                    <div class="form-group m-form__group">
                        <label for="full_name">Semister Name </label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" id="semister_id" name="semister" required="">
                            <option value="">Select Semister</option>
                            <?php foreach ($result as  $value) { ?>
                                <option value="<?php echo $value->id ; ?>"><?php echo $value->semisterName;?></option>
                            <?php } ?>
                            
                        </select> 
                    </div>
                      <div class="form-group m-form__group">
                        <label for="full_name">Section Name </label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" id="section_id" name="section" required="">
                            <option value="">Select Section</option>
                            <?php foreach ($section as  $sections) { ?>
                                <option value="<?php echo $sections->id ; ?>"><?php echo $sections->section_name;?></sections>
                            <?php } ?>
    
                        </select> 
                    </div>

                     <div class="form-group m-form__group">
                        <label for="full_name">Subject Name </label><span style="color:red ; padding-left:30px;" >*</span> 
                        <select class="form-control m-input m-input--square" id="subject_id" name="subject" required="">    
                        </select>
                    </div>


                </div>
             
                <div class="col-md-6">

                       <div class="form-group m-form__group">
                        <label for="full_name">Teacher Name </label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" id="teacher_id" name="teacher" required="">
                            <option value="">Select Teacher</option>
                            <?php foreach ($teacher as  $teachers) { ?>
                                <option value="<?php echo $teachers->id ; ?>"><?php echo $teachers->name;?></option>
                            <?php } ?>
                            
                        </select> 
                    </div>

                       <div class="form-group m-form__group">
                        <label for="full_name">Craft Instructor Name </label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" id="craft_id" name="craft" required="">
                            <option value="">Select Craft Instructor</option>
                            <option value="0">None Of Class</option>
                            <?php foreach ($craft_instructor as  $craft_instructors) { ?>
                                <option value="<?php echo $craft_instructors->id ; ?>"><?php echo $craft_instructors->name;?></option>
                            <?php } ?>
                            
                        </select> 
                    </div>
                      <div class="form-group m-form__group">
                        <label for="full_name">Room No  </label><span style="color:red ; padding-left:30px;" >*</span> 
                        <input type="text" class="form-control m-input m-input--square" name="room_no" required="">
                    </div>
                      <div class="form-group m-form__group">
                        <label for="full_name">Day </label><span style="color:red ; padding-left:30px;" >*</span> 
                        <select class="form-control m-input m-input--square" id="day" name="day" required=""> 
                        <option value="">Select Day</option>  
                        <option value="1">Saturday</option>
                        <option value="2">Sunday</option>
                        <option value="3">Monday</option>
                        <option value="4">Tuesday</option>
                        <option value="5">Wednesday</option>
                        <option value="6">Thursday</option>
                        <option value="7">Friday</option>
                        </select>
                    </div>
                      <div class="row">
                        <!-- first col 6 -->
                        <div class="col-md-6">
                      <div class="form-group m-form__group">
                        <label for="full_name">From </label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="text" class="form-control m-input m-input--square" name="from" id="m_timepicker_1" placeholder="From" required="">  
                    </div>
                </div>
                <!-- end first col-6----->
                  <!-- second col 6 -->
                  <div class="col-md-6">
                      <div class="form-group m-form__group">
                        <label for="full_name">To </label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="text" class="form-control m-input m-input--square" name="to" id="m_timepicker_1" placeholder="To" required="">  
                    </div>
                </div>
                <!-- end second col-6----->
                   </div>
                   
                    <div class="form-group m-form__group">
                        <label for="phone_number">Remarks</label>
                        <textarea type="text" class="form-control m-input m-input--square" name="remarks" placeholder="Remarks"></textarea>
                    </div>
                </div>
            </div>
                    <div class="form-group m-form__group">
                       <button type="submit" class="btn btn-primary">ADD NEW SUBJECT INTO ROUTINE</button>
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
    $('#teacher_id').select2({

    });
     $('#craft_id').select2({

    });
    $('#semister_id').change(function(e){
    e.preventDefault();
    var dept_id     = $('#dept_id').val();
    var semister_id = $(this).val();
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
    $.ajax({
        'url':"{{ url('/getSubjectByDepAndSemister') }}",
        'type':'post',
        'dataType':'text',
        data:{  
        dept_id:dept_id,
        semister_id:semister_id
        },
         success:function(data)
         {
          $('#subject_id').html(data);
        }
        });
       });
</script>
@endsection