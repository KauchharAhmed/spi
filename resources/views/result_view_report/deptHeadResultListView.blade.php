<div class="m-portlet__body">
    <div class="m-portlet">
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section">
                    <div class="m-section__content">
                      <div class="row">
                      <div class="row table-responsive">
                      <div class="col-md-8">
                      </div> 
                      <div class="col-md-2">
                            {!! Form::open(['url' =>'printTodayAttendentReport','method' => 'post']) !!}
                            <input type="hidden" name="dept" value="<?php //echo $dept_id; ?>">
                            <input type="hidden" name="shift" value="<?php //echo $shift_id; ?>">
                            <button class="btn btn-primary m-r-5 m-b-5" > <i class="fa fa-print" style="padding-right:10px"></i>PRINT</button>
                         {!! Form::close() !!}
                      </div>  
                    </div>
                        <div class="col-md-4"></div>
                            <div class="col-md-8"><strong style="font-size:20px;color: black;font-weight: bold">VIEW SEMESTER RESULT</strong></div>
                        <table>
                        <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">PROBIDHAN </td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "> <?php echo $porbidhan_details->probidhan_name ;  ?></td>
                      </tr>
                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">YEAR </td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "> <?php echo $year ;  ?></td>
                      </tr>
                       <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">SHIFT</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo $shift_name->shiftName ;  ?></td>
                      </tr>
                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">DEPARTMENT</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo $dept_name->departmentName ; ?></td>
                      </tr>
                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">SEMESTER</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "> <?php echo $semister_name->semisterName ;  ?></td>
                      </tr>
                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">SECTION</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "> <?php echo $section_name->section_name ; ?></td>
                      </tr>
                    </table>
                      <!--begin: Search Form -->
                      <!--end: Search Form -->
                 <table class="table table-bordered table-hover table-responsive" id="html_table">
               </table>
                  <table class="table table-bordered table-hover table-responsive" id="html_table">
                  <thead>
                    <tr>    
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>MERIT POSITION</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SESSION</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>PHOTO</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>NAME</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ROLL</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL MARKS </strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>STATUS </strong></th>
                     <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SUBJECT PASS/ FAIL STATUS </strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>VIEW MARKSHIT</strong></th>
     
            </tr>
            </thead>
                               <?php $i = 1 ; foreach ($pass_result as $pass_result_value) { ?>
                               <tbody>
                                 <tr>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $i++ ; ?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                     <?php
                                     // get student session
                                     $session_query = DB::table('student')
                                     ->where('year',$year)
                                     ->where('shift_id',$shift)
                                     ->where('dept_id',$dept)
                                     ->where('semister_id',$semister)
                                     ->where('section_id',$section)
                                     ->where('studentID',$pass_result_value->student_id)
                                     ->first();
                                     $session_info = DB::table('session')->where('id',$session_query->session)->first();
                                     echo $session_info->sessionName ;
                                     ?>
                                    </td>   
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php
                                      $student_info = DB::table('students')->where('id',$pass_result_value->student_id)->first();
                                      ?>
                                      <img height="50" width="50" style="border-radius: 50%;" src="{{(URL::to($student_info->studentImage))}}">  
                                    </td>    
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php // get student info
                                      echo $student_info->studentName; 
                                      ?>
                                    </td> 
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php echo $pass_result_value->roll ;?>
                                    </td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php echo $pass_result_value->total_marks ;?>
                                    </td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                      <span style="color: green;">PASS</span>
                                    </td>
                                       <td style="font-size: 20px;color: black;text-align: center;">
                                      <span style="color: green;">All Sub Pass</span>
                                    </td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                       <a target="_blank" href="{{URL::to('printSemesteResultMarksheet/'.$probidhan_id.'/'.$year.'/'.$shift.'/'.$dept.'/'.$semister.'/'.$section.'/'.$pass_result_value->roll.'/'.$i.'/'.'1')}}"><button type="button"  class="btn btn-info btn-sm" title="Print Marksheet">Print Marksheet</button></a>
                                    </td>
                                </tr>
                            <?php } ?>        
                    </tbody>
                    <?php foreach ($failed_result as $fail_result_value) { ?>
                               <tbody>
                                 <tr>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $i++ ; ?></td>

                                    <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php $fail_session_query = DB::table('student')
                                     ->where('year',$year)
                                     ->where('shift_id',$shift)
                                     ->where('dept_id',$dept)
                                     ->where('semister_id',$semister)
                                     ->where('section_id',$section)
                                     ->where('studentID',$fail_result_value->student_id)
                                     ->first();
                                     $fail_session_info = DB::table('session')->where('id',$fail_session_query->session)->first();
                                     echo $fail_session_info->sessionName ;
                                     ?>   
                                    </td>   
                                    <td style="font-size: 20px;color: black;text-align: center;">  
                                      <?php 
                                         $fail_student_info = DB::table('students')->where('id',$fail_result_value->student_id)->first();
                                      ?>
                                       <img height="50" width="50" style="border-radius: 50%;" src="{{(URL::to($fail_student_info->studentImage))}}">  
                                    </td>    
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                          <?php // get student info
                                    
                                      echo $fail_student_info->studentName; 
                                      ?>
                                    </td> 
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php echo $fail_result_value->roll ;?>
                                    </td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php echo $fail_result_value->total_marks ;?>
                                    </td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                      <span style="color: red;">
                                        FAIL
                                      </span>
                                     
                                    </td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                      <span style="color: red;">
                                            <?php 
                                  $failed_sub_count = DB::table('tbl_result_marks')
                                                 ->join('subject','tbl_result_marks.subject_id','=','subject.id')
                                                 ->select('subject.*')
                                                ->where('year',$year)
                                               ->where('tbl_result_marks.shift_id',$shift)
                                               ->where('tbl_result_marks.dept_id',$dept)
                                               ->where('tbl_result_marks.semister_id',$semister)
                                               ->where('tbl_result_marks.section_id',$section)
                                                ->where('tbl_result_marks.roll',$fail_result_value->roll)
                                                 ->where(function ($query) {
                                                $query->orWhere('tbl_result_marks.theory_pass_fail_status',2)
                                                ->orWhere('tbl_result_marks.practical_pass_fail_status',2);

                                                })->count();

                                  echo $failed_sub_count ;
                                if($failed_sub_count == '1')
                                  {echo ' Subject';}else{echo ' Subjects';} ?> <br/>
                                     
                                  <?php
                                $failed_subject =  DB::table('tbl_result_marks')
                                                 ->join('subject','tbl_result_marks.subject_id','=','subject.id')
                                                 ->select('subject.*','tbl_result_marks.theory_pass_fail_status','tbl_result_marks.practical_pass_fail_status')
                                                ->where('year',$year)
                                               ->where('tbl_result_marks.shift_id',$shift)
                                               ->where('tbl_result_marks.dept_id',$dept)
                                               ->where('tbl_result_marks.semister_id',$semister)
                                               ->where('tbl_result_marks.section_id',$section)
                                                ->where('tbl_result_marks.roll',$fail_result_value->roll)
                                                 ->where(function ($query) {
                                                $query->orWhere('tbl_result_marks.theory_pass_fail_status',2)
                                                ->orWhere('tbl_result_marks.practical_pass_fail_status',2);
                                                })->get();
                                foreach ($failed_subject as $value_fail_sub) {
                                  echo $value_fail_sub->subject_code.' , ';
                                }

                                ?>
                                 </span>
                                    </td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                         <a target="_blank" href="{{URL::to('printSemesteResultMarksheet/'.$probidhan_id.'/'.$year.'/'.$shift.'/'.$dept.'/'.$semister.'/'.$section.'/'.$fail_result_value->roll.'/'.$i.'/'.'2')}}"><button type="button"  class="btn btn-info btn-sm" title="Print Marksheet">Print Marksheet</button></a>
                                    </td>
                                </tr>
                            <?php } ?>        
                    </tbody>
                    </table>
                    </div>
                </div>
                <!--end::Section-->
            </div>
            <!--end::Form-->
        </div>
    </div>