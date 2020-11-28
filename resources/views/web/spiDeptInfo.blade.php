@extends('web.masterWeb')
@section('content')
<div class="col-md-12">
				<div class="header_section">
					<div class="row">
						<div class="col-md-6 page_headers">
							<h4>Department Information</h4>
						</div>
						<div class="col-md-6 page_links">
							<a href="" title="">Home</a> <span> > Department Information</span>
						</div>
					</div>
				</div>
			</div>
			<!-- Main Content Start Here -->
			<div class="col-md-9" style="margin-top: 20px;">
				<h4 style=" color: #17469e;text-align: left;font-family: Arimo;font-weight: 400;font-style: normal;text-transform: uppercase;"><?php echo $dept_status->departmentName ; ?> Department Information</h4>
				<hr style="background: #17469e; ">
				<div class="row" >
        <?php if($dept_status->status == '1'){?>
      <div class="col-md-4">	
      <strong>STUDENT INFO</strong><br/><br/>
    <?php foreach ($shift as $shift_value) { ?>
    <span style="background-color:blue; color:white;padding:5px;"><?php echo $shift_value->shiftName;?></span><br/>
    <table class="table table-hover table-responsive">
    <thead>
      <tr>
      	<th>Sl</th>
        <th>Semester</th>
        <th>Students</th>

      </tr>
    </thead>
    <tbody>
    	<?php $i = 1 ; foreach ($semester as $value) { ?>
      <tr>
        <td><?php echo $i++ ;?></td>
        <td><?php echo $value->semisterName;?></td>
        <td>
          <?php
          $current_year = date('Y');
          $current_student_count = DB::table('student')->where('year',$current_year)->where('dept_id',$dept_status->id)->where('shift_id',$shift_value->id)->where('semister_id',$value->id)->where('status',0)->count();
          echo $current_student_count ;
          ?> 
        </td>
      </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan='2'><strong>TOTAL</strong></td>
        <td>
          <?php 
      $current_total_student_count = DB::table('student')
                                ->join('semister', 'student.semister_id', '=', 'semister.id')
                                ->select('student.*')
                                ->where('student.year', $current_year)
                                ->where('student.dept_id',$dept_status->id)
                                ->where('student.shift_id',$shift_value->id)
                                ->where('student.status', 0)
                                ->where('semister.status',1)
                                ->count();
          ?>
   <strong> <?php echo $current_total_student_count ; ?></strong>     
        </td>
      </tr>
    </tfoot>
  </table>
   <?php } ?>

   <span> <strong>TOTAL : <?php $current_sub_total_student_count = DB::table('student')
                                ->join('semister', 'student.semister_id', '=', 'semister.id')
                                ->select('student.*')
                                ->where('student.year', $current_year)
                                ->where('student.dept_id',$dept_status->id)
                                ->where('student.status', 0)
                                ->where('semister.status',1)
                                ->count();
                                echo $current_sub_total_student_count ;?>
                              </span>
                              </strong>




</div>
<?php } ?>
      <div class="col-md-8">  
      <strong>STAFF INFO</strong>
    <table class="table table-hover table-responsive">
    <thead>
      <tr>
        <th>Sl</th>
        <th>Name</th>
        <th>Deg</th>
        <th>Mobile</th>
        <th>Image</th>

      </tr>
    </thead>
    <tbody>
      <?php $i = 1 ; foreach ($staff as $staff_value) {  ?>
      <tr>
        <td><?php echo $i++ ;?></td>
        <td><?php echo $staff_value->name;?></td>
        <td><?php echo $staff_value->degi;?></td>
        <td><?php echo $staff_value->mobile;?></td>
        <td>  <?php if($staff_value->image != ''){?>
            <img style="border-radius: 50%" height="80" width="80" src="{{URL::to('/')}}/{{ $staff_value->image  }}">
            <?php } ?></td>
      
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>



				</div>
			</div>
			<!-- End Main Content  -->
@endsection
