<div class="m-portlet__body">
    <div class="m-portlet">
           
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section">
                    <div class="m-section__content">
                      <div class="row">
                          {!! Form::open(['url' =>'printMonthlyAttendentReport','method' => 'post']) !!}
                            <input type="hidden" name="year" value="<?php echo $year; ?>">
                            <input type="hidden" name="shift" value="<?php echo $shift; ?>">
                             <input type="hidden" name="semister" value="<?php echo $semister; ?>">
                             <input type="hidden" name="section" value="<?php echo $section; ?>">
                             <input type="hidden" name="month" value="<?php echo $month; ?>">
                             <input type="hidden" name="dept" value="<?php echo $dept; ?>">
                        <button class="btn btn-primary m-r-5 m-b-5" > <i class="fa fa-print" style="padding-right:10px"></i>PRINT</button>
                        {!! Form::close() !!}
                        &nbsp;&nbsp;&nbsp;
                        {!! Form::open(['url' =>'csvMonthlyAttendentReport','method' => 'post']) !!}
                            <input type="hidden" name="year" value="<?php echo $year; ?>">
                            <input type="hidden" name="shift" value="<?php echo $shift; ?>">
                             <input type="hidden" name="semister" value="<?php echo $semister; ?>">
                             <input type="hidden" name="section" value="<?php echo $section; ?>">
                             <input type="hidden" name="month" value="<?php echo $month; ?>">
                             <input type="hidden" name="dept" value="<?php echo $dept; ?>">
                        <button class="btn btn-success m-r-5 m-b-5" > <i class="fa fa-file-excel-o" style="padding-right:10px"></i>EXCEL (CSV)</button>
                         {!! Form::close() !!}


                      <div class="row table-responsive">
                      <div class="col-md-8">
                      </div> 
                      <div class="col-md-2">
                         
                      </div>  
                    </div>
                        <div class="col-md-3"></div>
                            <div class="col-md-8"><strong style="font-size:20px;color: black;font-weight: bold">MONTHLY STUDENT CLASS ATTENDENT REPORT</strong></div>
                            <div class="col-md-1"></div> 
                    <table>
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

                             <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">MONTH</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "> <?php 
                         if($month == '01'){
                          echo "January";
                         }elseif($month == '02'){
                          echo "February";
                         }elseif($month == '03'){
                           echo "March";
                         }elseif($month == '04'){
                           echo "April";
                         }elseif($month == '05'){
                           echo "May";
                         }elseif($month == '06'){
                           echo "June";
                         }elseif($month == '07'){
                           echo "July";
                         }elseif($month == '08'){
                           echo "August";
                         }elseif($month == '09'){
                           echo "September";
                         }elseif($month == '10'){
                           echo "October";
                         }elseif($month == '11'){
                           echo "November";
                         }else{
                          echo "December";
                         }
                         ?></td>
                      </tr>

                        <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">MONTH TOTAL DAYS</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "> <?php echo $month_total_day.' Days' ; ?></td>
                      </tr>

                        <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;"> HOLIDAYS</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "> <?php echo $count_holiday.' DAYS' ; ?></td>
                      </tr>

                    </table>
                      <!--begin: Search Form -->
                      <div class="container">
                    <table class="table table-bordered table-hover table-responsive" id="html_table">
                  <thead>
                    <tr>    
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SL NO</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ROLL</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>REGISTRATION</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL CLASS (DAYS)</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>PRESENT (DAYS)</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ABSENT (DAYS)  </strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>PRESENT (DAYS)%</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ABSENT (DAYS)% </strong></th>
                   </tr>
                  </thead>
                               <?php $i = 1 ; foreach ($result as $value) { ?>
                               <tbody>
                                 <tr>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $i++ ; ?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $value->roll ; ?></td>   
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $value->registration ; ?></td>    
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php 
                                     $total_class_day = $month_total_day - $count_holiday ;
                                     echo $total_class_day ; 
                                    ?></td> 
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                       <?php 
                                      $count        = DB::table('student_attendent')
                                      ->distinct()
                                      ->where('year',$value->year)
                                      ->where('section_id',$value->section_id)
                                      ->where('shift_id',$value->shift_id)
                                      ->where('dept_id',$value->dept_id)
                                      ->where('semister_id',$value->semister_id)
                                      ->where('roll',$value->roll)
                                      ->whereBetween('created_at', [$from, $to])
                                      ->get(array('created_at'));
                                       $present = count($count) ;
                                       echo $present ;
                                      ?>
                                     </td>
                                    <td style="font-size: 20px;color: black;text-align: center;"> <?php 
                                    $absent =  $total_class_day - $present ; 
                                    echo $absent ;
                                    ?>  </td>
                                    <td style="font-size: 20px;color: black;text-align: center;"> 
                                      <?php
                                      $present_perchatage   = ($present*100)/$total_class_day;
                                      echo number_format($present_perchatage,2).'%';
                                      ?>
                                      </td>
                                     <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php
                                      $absent_perchatage   = ($absent*100)/$total_class_day;
                                      echo number_format($absent_perchatage,2).'%';
                                      ?>
                                     </td>
                                </tr>
                              </tbody>
                            <?php } ?>
                        </table>
                      </div>
                    </div>
                </div>
                <!--end::Section-->
            </div>
            <!--end::Form-->
        </div>
    </div>