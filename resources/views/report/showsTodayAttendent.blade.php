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
                            <input type="hidden" name="dept" value="<?php echo $dept_id; ?>">
                            <input type="hidden" name="shift" value="<?php echo $shift_id; ?>">
                            <button class="btn btn-primary m-r-5 m-b-5" > <i class="fa fa-print" style="padding-right:10px"></i>PRINT</button>
                         {!! Form::close() !!}
                      </div>  
                    </div>
                        <div class="col-md-3"></div>
                            <div class="col-md-8"><strong style="font-size:20px;color: black;font-weight: bold">TODAY STUDENT CLASS ATTENDENT REPORT</strong></div>
                            <div class="col-md-1"></div> 

                    <table>
                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">SHIFT </td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "> <?php echo $shift_name->shiftName ;  ?></td>
                      </tr>
                       <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">DEPARTMENT</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo $dept_name->departmentName ;  ?></td>
                      </tr>
                    </table>
                      <!--begin: Search Form -->
                      <!--end: Search Form -->
                 <?php foreach ($section_name as $sections_name) { ?>
                 <table class="table table-bordered table-hover table-responsive" id="html_table">
                 <th style="background-color: #156d48;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SECTION  - <?php echo $sections_name->section_name ; ?></strong></th>
               </table>
                  <table class="table table-bordered table-hover table-responsive" id="html_table">
                  <thead>
                    <tr>    
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SL NO</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SEMISTER</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL STUDENTS</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>PRESENT</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ABSENT</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>PRESENT % </strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ABSENT %</strong></th>
     
            </tr>
            </thead>
                               <?php $i = 1 ; foreach ($result as $value) { ?>
                               <tbody>
                                 <tr>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $i++ ; ?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $value->semisterName;?></td>   
                                    <td style="font-size: 20px;color: black;text-align: center;">  
                                     <?php
                                     // get total student of this semister
                                      date_default_timezone_set('Asia/Dhaka');
                                      $current_year = date('Y');
                                      $student_count        = DB::table('student')
                                      ->where('year',$current_year)
                                      ->where('section_id',$sections_name->id)
                                      ->where('shift_id',$shift_id)
                                      ->where('dept_id',$dept_id)
                                      ->where('semister_id',$value->id)
                                      ->count();
                                       echo $student_count ;
                                     ?>
                                    </td>    
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php
                                      $current_date = date('Y/m/d'); 
                                      $count        = DB::table('student_attendent')
                                      ->where('section_id',$sections_name->id)
                                      ->where('shift_id',$shift_id)
                                      ->where('dept_id',$dept_id)
                                      ->where('semister_id',$value->id)
                                      ->where('created_at',$current_date)
                                      ->groupBy('roll')
                                      ->get();
                                       $total_present = count($count) ;
                                       echo $total_present;
                                       ?>
                                    </td> 
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php 
                                        $absent = $student_count - count($count) ; 
                                        echo $absent ;
                                      ?>
                                    </td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                    <?php 
                                   if($student_count == 0){
                                    }else{
                                       $present_perchatage   = ($total_present*100)/$student_count;
                                      echo number_format($present_perchatage,2).'%';
                                    }
                                    ?> 
                                    </td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                    <?php 
                                      if($student_count == 0){
                                    }else{
                                        $absent_perchatage    = ($absent*100)/$student_count;
                                        echo number_format($absent_perchatage,2).'%'; 
                                        } 
                                    ?>  
                                    </td>
                                </tr>
                            <?php } ?>        
                    </tbody>
                    </table>
                      <?php } ?>
                    </div>
                </div>
                <!--end::Section-->
            </div>
            <!--end::Form-->
        </div>
    </div>