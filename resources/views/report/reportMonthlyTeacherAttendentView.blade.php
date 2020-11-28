<div class="m-portlet__body">
    <div class="m-portlet">
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section">
                    <div class="m-section__content">
                      <div class="row">
                          {!! Form::open(['url' =>'printReportTeacherMonthlyAttendent','method' => 'post']) !!}
                            <input type="hidden" name="year" value="<?php echo $year;?>">
                            <input type="hidden" name="month" value="<?php echo $month;?>">
                        <button class="btn btn-primary m-r-5 m-b-5" > <i class="fa fa-print" style="padding-right:10px"></i>PRINT</button>
                         {!! Form::close() !!}

                           &nbsp; &nbsp; &nbsp;
                          {!! Form::open(['url' =>'csvReportTeacherMonthlyAttendent','method' => 'post']) !!}
                           <input type="hidden" name="year" value="<?php echo $year;?>">
                          <input type="hidden" name="month" value="<?php echo $month;?>">

                        <button class="btn btn-success m-r-5 m-b-5" > <i class="fa fa-file-excel-o" style="padding-right:10px"></i>EXCEL(CSV)</button>
                         {!! Form::close() !!}


                    <div class="row table-responsive">
                      <div class="col-md-8">
                      </div> 
                      <div class="col-md-2">

                      </div>  
                    </div>
                        <div class="col-md-3"></div>
                            <div class="col-md-8"><strong style="font-size:20px;color: black;font-weight: bold">MONTHLY TEACHER CLASS ATTENDENT REPORT</strong></div>
                            <div class="col-md-1"></div> 

                    <table>
                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">YEAR</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo $year ;  ?></td>
                      </tr>
                       <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">Month</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php 
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
                          <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">MONTH TOTAL DAYS</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo $month_total_day.' Days' ;?></td>
                      </tr>
                       <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;"> HOLIDAYS </td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "> <?php echo $count_holiday.' Days' ; ?></td>
                      </tr>
                
                    </table>
                      <!--begin: Search Form -->
                      <div class="container">
                    <table class="table table-bordered table-hover table-responsive" id="html_table">
                  <thead>
                    <tr>    
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SL NO</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TEACHER</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>DEPT</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>DEGI</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL CLASS (DAYS)</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL LEAVE & TRAINING (DAYS)</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL CLSS (DAYS)<sub>without leave & training</sub></strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>PRESENT (DAYS)</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ABSENT (DAYS)  </strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>PRESENT (DAYS)%</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ABSENT (DAYS)% </strong></th>
                   </tr>
                  </thead>
                               <?php $i = 1 ; 
                               foreach ($result as $value) { ?>
                               <tbody>
                                 <tr>
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $i++ ; ?></td>
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->name ; ?></td>   
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->departmentName ; ?></td> 
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->degi ; ?></td>   
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php 
                                      $total_class_day = $month_total_day - $count_holiday ;
                                      echo $total_class_day ; 
                                    ?></td> 

                                    <td style="font-size: 15px;color: black;text-align: center;"><?php 

                                      $like = $year.'-'.$month;
                                      $withoutlike = $year.'-'.$month.'-'.$month_total_day;
                                       // status 1 = only approved leave
                                      // total leave 
                                       $total_leave = DB::table('tbl_leave')
                                       ->where('user_id',$value->id)
                                       ->where('final_request_from','LIKE',"%{$like}%")
                                       ->where('final_request_to','LIKE',"%{$like}%")
                                       ->where('status',1)
                                       ->sum('final_day');
                                        // if cross that month then this day
                                        $total_from_leave_count = DB::table('tbl_leave')
                                       ->where('user_id',$value->id)
                                       ->where('final_request_from','LIKE',"%{$like}%")
                                       ->where('final_request_to','>',$withoutlike)
                                       ->where('status',1)
                                       ->count();

                                     if($total_from_leave_count > 0){
                                      // if cross that month then this day
                                       $total_from_leave = DB::table('tbl_leave')
                                       ->where('user_id',$value->id)
                                       ->where('final_request_from','LIKE',"%{$like}%")
                                       ->where('final_request_to','>',$withoutlike)
                                       ->where('status',1)
                                       ->get();
                                         foreach ($total_from_leave as $total_from_leavee) {
                                       $total_from_leave_get =  $total_from_leavee->final_request_from;

                                       $explode = explode('-', $total_from_leave_get);
                                       $last_date = $explode[2];
                                       $single_leave_day = $month_total_day - $last_date ;

                                       $total_leave_sum  = $total_leave + $single_leave_day + 1;
                                      echo $total_leave_sum ; 
                                     }
                                   }else{
                                       $total_leave_sum = $total_from_leave_count+$total_leave;
                                       echo $total_leave_sum ;
                                     }

                                    ?> 
                                    </td>
                                    <td style="font-size: 15px;color: black;text-align: center;">
                                       <?php 
                                       $teache_class = $total_class_day-$total_leave_sum;
                                       echo $teache_class;

                                       ?>

                                    </td>

                                    <td style="font-size: 15px;color: black;text-align: center;">
                                       <?php 
                                      $count        = DB::table('teacher_attendent')
                                      ->distinct()
                                      ->where('year',$year)
                                      ->where('teacherId',$value->id)
                                      ->whereBetween('created_at', [$from, $to])
                                      ->get(array('created_at'));
                                       $present = count($count) ;
                                       echo $present ;
                                      ?>
                                     </td>
                                    <td style="font-size: 15px;color: black;text-align: center;"> <?php 
                                    
                                     $absent =  $total_class_day - $total_leave_sum -$present;  ;
                                        echo $absent ;

                                    ?>  </td>
                                    <td style="font-size: 15px;color: black;text-align: center;"> 
                                      <?php
                                      //echo $teache_class ;
                                       $present_perchatage   = ($present*100)/$teache_class;
                                       echo number_format($present_perchatage,2).'%';
                                      ?>
                                      </td>
                                     <td style="font-size: 15px;color: black;text-align: center;">
                                      <?php
                                      $absent_perchatage   = ($absent*100)/$teache_class;
                                      echo number_format($absent_perchatage,2).'%';
                                      ?>
                                     </td>
                                </tr>
                            <?php } ?>         
                    </tbody>
                    </table>
                    </div>
                      </div>
                </div>
                <!--end::Section-->
            </div>
            <!--end::Form-->
        </div>
    </div>