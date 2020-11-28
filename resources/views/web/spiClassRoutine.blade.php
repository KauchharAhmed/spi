@extends('web.masterWeb')
@section('content')
<div class="col-md-12">
				<div class="header_section">
					<div class="row">
						<div class="col-md-6 page_headers">
							<h4>Class Routine</h4>
						</div>
						<div class="col-md-6 page_links">
							<a href="" title="">Home</a> <span> > Class Routine</span>
						</div>
					</div>
				</div>
			</div>
			<!-- Main Content Start Here -->
			<div class="col-md-9" style="margin-top: 20px;">
				<h4 style=" color: #17469e;text-align: left;font-family: Arimo;font-weight: 400;font-style: normal;text-transform: uppercase;">Get Class Routine</h4>
				<hr style="background: #17469e; ">
				<div class="row" >
       
            <div class="col-md-2">
                    <label>Year</label>
                    <input type="text" class="form-control m-input" name="year" id="year" value="<?php echo date('Y') ; ?>" disabled> 
                </div>
                  <div class="col-md-2">
                    <label>Dept</label>
                    <select class="form-control m-input" name="dept" id="dept">
                        <option value="" >Select Dept</option> 
                        <?php foreach ($dept as $dept_value) { ?>
                            <option value="<?php echo $dept_value->id ; ?>" ><?php echo $dept_value->departmentName;?></option>
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
                        <label for="phone_number">Semister</label>
                      <select class="form-control m-input" name="semister" id="semister" required="">
                          <option value="" >Select Semister</option>
                            <?php foreach ($semsiter as $semisters) { ?>
                            <option value="<?php echo $semisters->id ; ?>" ><?php echo $semisters->semisterName;?></option>
                        <?php } ?> 
                      </select>
                </div>
                  <div class="col-md-2">
                    <label>Section</label>
                    <select class="form-control m-input" name="section" id="section">
              
                    </select>
                </div>
                        <!--<div class="col-md-2">
                        <label for="phone_number">Section</label>
                      <select class="form-control m-input" name="section" id="section" required="">
                          <option value="" >Select Section</option>
                            <?php //foreach ($section as $sections) { ?>
                            <option value="<?php //echo $sections->id ; ?>" ><?php //echo $sections->section_name;?></option>
                        <?php //} ?> 
                      </select>
                </div>-->
                <br/><br/><br/>
                <div class="col-md-2">
                       <label for="phone_number"></label>
                       <button type="submit" id="send_button" class="form-control  btn btn-primary" style="margin-top:6px">View Routine</button>             
                </div>
				</div>
        <span id="get_content"></span>  
			</div>
			<!-- End Main Content  -->
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
    var dept        = $('#dept').val();
    var shift       = $('#shift').val();
    var semister    = $('#semister').val();
    var section     = $('#section').val();
      if(dept == ''){
        alert('Please Select Department');
        return false;
    }
    if(shift == ''){
        alert('Please Select Shift');
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
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
    $.ajax({
        'url':"{{ url('/getStudentSemisterWiseRoutine') }}",
        'type':'post',
        'dataType':'text',
        data:{  
        shift:shift,
        dept:dept,
        semister:semister,
        year :year,
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
