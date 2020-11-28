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
                        {!! Form::open(['url' =>'printHolidayReport','method' => 'post']) !!}
                            <input type="hidden" name="from" value="<?php echo $from;?>">
                            <input type="hidden" name="to" value="<?php echo $to;?>">
                            
                        <button class="btn btn-primary m-r-5 m-b-5" > <i class="fa fa-print" style="padding-right:10px"></i>PRINT</button>
                         {!! Form::close() !!}
                      </div>  
                    </div>
                      <div class="col-md-4"></div>
                            <div class="col-md-6"><strong style="font-size:20px;color: black;font-weight: bold">SENT SMS REPORT </strong></div>
                            <div class="col-md-2"></div> 
                    <table>
                        <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">TYPE</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px;">
                          <?php
                          if($type == ''){
                            echo "ALL";
                          }elseif($type == '1'){
                            echo "EMPLOYEE";
                          }elseif($type == '2'){
                            echo "STUDENT";
                          }
                          ?>
                        </td>
                      </tr>
                        <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">DATE RANGE</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo date('d M Y',strtotime($from)).' To '.date('d M Y',strtotime($to)) ;?></td>
                      </tr>
                        
                    </table> 
                      <!--begin: Search Form -->
                    <div class="container">
                    <table class="table table-bordered table-hover table-responsive" id="html_table">
                  <thead>
                    <tr>    
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SL</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>DATE</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>NAME</strong></th>
                     <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>DESIGNATION</strong></th>
                      <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>YEAR</strong></th>
                      <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>DEPT</strong></th>
                        <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SHIFT</strong></th>
                      <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SEMESTER</strong></th>
                      <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SECTION</strong></th>
                        <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ROLL</strong></th>
                       <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>MOBILE</strong></th>
                      <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SMS NUMBER</strong></th>
                        <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SMS</strong></th>
                  
                  
                   </tr>
                  </thead>
                               <?php 
                               $i = 1 ; 
                               $total_sms_number = 0 ;
                               foreach ($result as $value) { $total_sms_number = $total_sms_number + $value->sms_count ; ?>
                               <tbody>
                                 <tr>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $i++ ; ?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo date('d-M-Y',strtotime($value->created_at)) ; ?></td>  
                                     <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php if($value->type== '1'){
                                        // get user info
                                        $user_information = DB::table('users')->where('id',$value->user_id)->first();
                                        echo $user_information->name ;

                                      }elseif($value->type == '2'){
                                        if($value->student_id == '0'){
                                          echo "";
                                        }else{  
                                          $student_information = DB::table('students')->where('id',$value->student_id)->first();
                                          echo $student_information->studentName ;
                                        }

                                      }
                                      ?>
                                        
                                      </td> 
                                       <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php if($value->type== '1'){
                                        // get user info
                                        echo $user_information->degi ;

                                      }elseif($value->type == '2'){

                                      }
                                      ?>
                                        
                                      </td> 

                                      <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php echo $value->year;?>
                                      </td>

                                      <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php if($value->type== '2'){
                                        // get department info
                                        $dept_info = DB::table('department')->where('id',$value->dep_id)->first();
                                        echo  $dept_info->departmentName ;
                                      }
                                      ?>
                                        
                                      </td>
                                         <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php if($value->type== '2'){
                                        // get shift info
                                      $shift_info = DB::table('shift')->where('id',$value->shift_id)->first();
                                        echo  $shift_info->shiftName ;
                                      }
                                      ?>
                                        
                                      </td>
                                      <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php if($value->type== '2'){
                                        // get shift info
                                    $semister_info = DB::table('semister')->where('id',$value->semister_id)->first();
                                    echo $semister_info->semisterName ;
                                  }
                                      ?>
                                        
                                      </td>
                                         <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php if($value->type== '2'){
                                        // get shift info
                                   
                                    $section_info = DB::table('section')->where('id',$value->section_id)->first();
                                    echo $section_info->section_name;
                                  }
                                      ?>
                                        
                                      </td>
                                         <td style="font-size: 20px;color: black;text-align: center;">
                                    <?php echo $value->roll;?>
                             
                                      </td>
                                          <td style="font-size: 20px;color: black;text-align: center;">
                                    <?php echo $value->mobile_number;?>
                             
                                      </td>

                                         <td style="font-size: 20px;color: black;text-align: center;">
                          
                                          <?php echo $value->sms_count;?>
                                      </td>
                                         <td style="font-size: 20px;color: black;text-align: center;">
                          
                                          <?php 
                                          // sms detail
                                          $sms_details = DB::table('sending_sms')->where('id',$value->sms_id)->first();
                                          echo $sms_details->sms;
                                          ?>
                                      </td>
                                           
                                </tr>
                            <?php } ?>           
                    </tbody>
                    <tr>
                        <td colspan="12" style="background:#12141d;font-size: 20px;color: orange;text-align: center;">TOTAL</td>
                                      
                          <td style="background:#12141d;font-size: 20px;color: orange;text-align: center;"><?php echo $total_sms_number ; ?></td> 
                        </tr>
                    </table>
                  </div>
                    </div>
                </div>
                <!--end::Section-->
            </div>
            <!--end::Form-->
        </div>
    </div>