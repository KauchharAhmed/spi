<div class="m-portlet__body">
    <div class="m-portlet">
           
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section">
                    <div class="m-section__content">
                      <div class="row">
                               {!! Form::open(['url' =>'printPeriodicStudentAbsentList','method' => 'post']) !!}
                            <input type="hidden" name="year" value="<?php echo $year;?>">
                            <input type="hidden" name="shift" value="<?php echo $shift;?>">
                            <input type="hidden" name="dept" value="<?php echo $dept;?>">
                            <input type="hidden" name="semister" value="<?php echo $semister;?>">
                            <input type="hidden" name="section" value="<?php echo $section; ?>">
                            <input type="hidden" name="from" value="<?php echo $date_form;?>">
                            <input type="hidden" name="to" value="<?php echo $date_to;?>">
                            <input type="hidden" name="sorting_type" value="<?php echo $sorting_type;?>">
                            <input type="hidden" name="attendent_days" value="<?php echo $attendent_days;?>">
                        <button class="btn btn-primary m-r-5 m-b-5" > <i class="fa fa-print" style="padding-right:10px"></i>PRINT</button>
                         {!! Form::close() !!}
                           &nbsp;&nbsp;&nbsp;
                            {!! Form::open(['url' =>'csvPeriodicStudentAbsentList','method' => 'post']) !!}
                            <input type="hidden" name="year" value="<?php echo $year;?>">
                            <input type="hidden" name="shift" value="<?php echo $shift;?>">
                            <input type="hidden" name="dept" value="<?php echo $dept;?>">
                            <input type="hidden" name="semister" value="<?php echo $semister;?>">
                            <input type="hidden" name="section" value="<?php echo $section; ?>">
                            <input type="hidden" name="from" value="<?php echo $date_form;?>">
                            <input type="hidden" name="to" value="<?php echo $date_to;?>">
                            <input type="hidden" name="sorting_type" value="<?php echo $sorting_type;?>">
                            <input type="hidden" name="attendent_days" value="<?php echo $attendent_days;?>">
                        <button class="btn btn-success m-r-5 m-b-5" > <i class="fa fa-file-excel-o" style="padding-right:10px"></i>EXCEL (CSV)</button>
                         {!! Form::close() !!}
                      <div class="row table-responsive">
                      <div class="col-md-8">
                      </div> 
                      <div class="col-md-2">
                      </div>  
                    </div>
                        <div class="col-md-3"></div>
                          <div class="col-md-8"><strong style="font-size:20px;color: black;font-weight: bold"> PERIODIC STUDENT ABSENT ATTENDENT REPORT</strong></div>
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
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">DATE RANGE</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "> <?php echo date ("d M Y", strtotime($from)).' To '.date("d M Y", strtotime($to));?></td>
                      </tr>
                        <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">TOTAL DAYS </td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "> <?php echo $total_day." DAYS " ; ?></td>
                      </tr>
                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">HOLIDAYS</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "> <?php echo $count_holiday." DAYS " ; ?></td>
                      </tr>
                           <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">SORTING TYPE</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "> <?php
                        if($sorting_type == '1'){
                          echo "Equal";
                        }elseif($sorting_type == '2'){
                          echo "Morethan";
                        }elseif($sorting_type == '3'){
                          echo "Lessthan";
                        }
                         ?></td>
                      </tr>
                        <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">SORTING DAYS</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "> <?php
                        echo $attendent_days ;
                        ?></td>
                      </tr>
                      <!--begin: Search Form -->
                      <div class="container">
                    <table class="table table-bordered table-hover table-responsive" id="html_table">
                  <thead>
                    <tr>    
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SL NO</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOP RANK</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ROLL</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>REGISTRATION</strong></th>
                      <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL CLASS (DAYS)</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ABSENT (DAYS)</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ABSENT (DAYS) %</strong></th>

                   </tr>
                  </thead>
                               <?php $i = 1 ; 
                                     $j = 1 ;

                                $total_class_days_is = $total_day - $count_holiday ;

                               foreach ($result as $value) { ?>
                               <tbody>
                                <?php if($sorting_type == '1' AND $attendent_days == $total_class_days_is - $value->count):?>
                                 <tr>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $i++ ; ?></td>
                                      <td style="font-size: 20px;color: red; font-weight:bold;text-align: center;"><?php echo $j++ ; ?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $value->roll ; ?></td>   
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $value->registration ; ?></td> 
                                     <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php 
                                       $total_class_day = $total_day - $count_holiday ;
                                       echo  $total_class_day ;

                                       ?>
                                     </td>   
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                       <?php 
                                        $absent = $total_class_day - $value->count ;
                                         echo $absent ;
                                      ?>
                                     </td>
                                    <td style="font-size: 20px;color: black;text-align: center;"> 
                                      <?php
                                      
                                        $absent_perchatage   = ($absent*100)/$total_class_day;
                                       echo number_format($absent_perchatage,2).'%';
                           
                                      ?>
                                    
                                </tr>
                              <?php elseif($sorting_type == '2' AND $attendent_days < $total_class_days_is - $value->count):?>
                                 <tr>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $i++ ; ?></td>
                                      <td style="font-size: 20px;color: red; font-weight:bold;text-align: center;"><?php echo $j++ ; ?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $value->roll ; ?></td>   
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $value->registration ; ?></td>   
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                         <?php $total_class_day = $total_day - $count_holiday ;
                                       echo  $total_class_day ;?>
                                    </td> 
                                   
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                       <?php 
                                        $absent = $total_class_day - $value->count ;
                                        echo $absent ;
                                      ?>
                                     </td>
                                    <td style="font-size: 20px;color: black;text-align: center;"> 
                                       <?php
                                      
                                        $absent_perchatage   = ($absent*100)/$total_class_day;
                                       echo number_format($absent_perchatage,2).'%';
                           
                                      ?>
                                    
                                </tr>
                                  <?php elseif($sorting_type == '3' AND $attendent_days > $total_class_days_is - $value->count):?>
                                 <tr>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $i++ ; ?></td>
                                      <td style="font-size: 20px;color: red; font-weight:bold;text-align: center;"><?php echo $j++ ; ?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $value->roll ; ?></td>   
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $value->registration ; ?></td> 
                                    <td style="font-size: 20px;color: black;text-align: center;">  <?php $total_class_day = $total_day - $count_holiday ;
                                       echo  $total_class_day ;?></td>   
                                   
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                       <?php 
                                        $absent = $total_class_day - $value->count ;
                                         echo $absent ;
                      
                                      ?>
                                     </td>
                                    <td style="font-size: 20px;color: black;text-align: center;"> 
                                      <?php
                                      $absent_perchatage   = ($absent*100)/$total_class_day;
                                       echo number_format($absent_perchatage,2).'%';
                                      ?>
                                    
                                </tr>
                              <?php endif;?>
                                  <?php } ?>    


                              <?php if($sorting_type == '1' AND $attendent_days == $total_class_day) :?>
                                 <?php foreach ($absent_result as $absent_value) { ?>
                                     <tr>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $i++ ; ?></td>
                                      <td style="font-size: 20px;color: red; font-weight:bold;text-align: center;"><?php echo $j++ ; ?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $absent_value->roll ; ?></td>   
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $absent_value->registration ; ?></td>   
                                          <td style="font-size: 20px;color: black;text-align: center;"><?php $total_class_day = $total_day - $count_holiday ;
                                       echo  $total_class_day ;?></td>  
                                   
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                    <?php echo $total_class_day ;?>
                                     </td>
                                    <td style="font-size: 20px;color: black;text-align: center;"> 
                                     100.00 % 
                                    
                                </tr>
                              <?php }?>
                              <?php elseif($sorting_type == '2'):?>
                              <?php foreach ($absent_result as $absent_value) { ?>
                                     <tr>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $i++ ; ?></td>
                                      <td style="font-size: 20px;color: red; font-weight:bold;text-align: center;"><?php echo $j++ ; ?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $absent_value->roll ; ?></td>   
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $absent_value->registration ; ?></td>  
                                       <td style="font-size: 20px;color: black;text-align: center;"><?php $total_class_day = $total_day - $count_holiday ;
                                       echo  $total_class_day ;?></td>   
                                   
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                     <?php echo $total_class_day;?>
                                     </td>
                                    <td style="font-size: 20px;color: black;text-align: center;"> 
                                    100.00 % 
                                    
                                </tr>
                              <?php }?>
                              <?php endif;?>
                              
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