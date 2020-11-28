<div class="m-portlet__body">
    <div class="m-portlet">
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section">
                    <div class="m-section__content">
                      <div class="row">
                        {!! Form::open(['url' =>'printStaffNormalAttendentViewReport','method' => 'post']) !!}
                        <input type="hidden" name="from_date" value="<?php echo $from;?>">
                        <input type="hidden" name="staff_type" value="<?php echo $staff_type;?>">
                        <button class="btn btn-primary m-r-5 m-b-5" > <i class="fa fa-print" style="padding-right:10px"></i>PRINT</button>
                         {!! Form::close() !!}
                         &nbsp;&nbsp;&nbsp;
                          {!! Form::open(['url' =>'printStaffDgAttendentViewReport','method' => 'post']) !!}
                        <input type="hidden" name="from_date" value="<?php echo $from;?>">
                        <input type="hidden" name="staff_type" value="<?php echo $staff_type;?>">
                        <button class="btn btn-info m-r-5 m-b-5" > <i class="fa fa-print" style="padding-right:10px"></i>PRINT FOR DG OFFICE</button>
                         {!! Form::close() !!}
                        &nbsp;&nbsp;&nbsp;
                        {!! Form::open(['url' =>'csvStaffNormalAttendentViewReport','method' => 'post']) !!}
                        <input type="hidden" name="from_date" value="<?php echo $from;?>">
                        <input type="hidden" name="staff_type" value="<?php echo $staff_type;?>">
                        <button class="btn btn-success m-r-5 m-b-5" > <i class="fa fa-file-excel-o" style="padding-right:10px"></i>EXCEL (CSV)</button>
                         {!! Form::close() !!}
                          &nbsp;&nbsp;&nbsp;
                          {!! Form::open(['url' =>'csvStaffDgAttendentViewReport','method' => 'post']) !!}
                        <input type="hidden" name="from_date" value="<?php echo $from;?>">
                        <input type="hidden" name="staff_type" value="<?php echo $staff_type;?>">
                        <button class="btn btn-warning m-r-5 m-b-5" > <i class="fa fa-file-excel-o" style="padding-right:10px"></i>EXCEL (CSV) FOR DG OFFICE</button>
                         {!! Form::close() !!}
                      <div class="row table-responsive">
                      <div class="col-md-8">
                      </div> 
                    </div>
                  </div>
                        <p style="font-size:20px;color: black;font-weight: bold;text-align: center;">DOOR LOG ATTENDENT REPORT - EMPLOYEE</p>

                    <table>
                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">DATE</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo date('d M Y',strtotime($from));?></td>
                      </tr>
                       <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">DAY</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo date('l',strtotime($from));?></td>
                      </tr>
                        <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">Type </td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; ">
                               <?php if($staff_type == '0'){
                                echo "ALL";
                               }elseif($staff_type == '2'){
                                echo "ADMIN";
                               }elseif($staff_type == '3'){
                                echo "TEACHER";
                               }elseif($staff_type == "4"){
                                echo "CRAFT";
                               }elseif($staff_type == "5"){
                                echo "OTHER STAFF";
                               }
                               ?>
                        </td>
                      </tr>
                        <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">Total</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo count($result); ?></td>
                      </tr>

                        <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">Time Status Indicator</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><span style="color:red">L : Late Time</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> A : Actual Time</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:blue;"> B : Before Office Time</span></td>
                      </tr>


                    </table>
                    <!--begin: Search Form -->
                  <div class="container">
                  <table class="table table-bordered table-hover table-responsive" id="html_table">
                  <thead>
                    <tr>    
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SL</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>NAME</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>DEPT</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>DESIGNATION</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>STATUS</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>OFFICE START</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>FIRST ENTER TIME</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TIME STATUS</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ENTER NUMBERS</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ENTER TIMES</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ADD ATTENDENT</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>EDIT TIME</strong></th>
                   </tr>
                  </thead>
                               <?php $i = 1 ; foreach ($result as $value) { ?>
                               <tbody>
                                 <tr>
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $i++ ; ?></td>
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->name ; ?></td>   
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->departmentName ; ?></td> 
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->degi ; ?></td>  
                                    <td>
                                      <?php
                                       // check leave status
                                      $leave = DB::table('tbl_leave')
                                      ->where('user_id',$value->id)
                                      ->where('final_request_from', '<=', $from)
                                      ->where('final_request_to', '>=', $from)
                                      ->where('type_status', 0)
                                      ->count();
                                        $training = DB::table('tbl_leave')
                                      ->where('user_id',$value->id)
                                      ->where('final_request_from', '<=', $from)
                                      ->where('final_request_to', '>=', $from)
                                      ->where('type_status', 1)
                                      ->count();
                                      // check present or absent
                                      $present        = DB::table('tbl_door_log')
                                      ->where('user_id',$value->id)
                                      ->where('enter_date',$from)
                                      ->orderBy('enter_time','asc')
                                      ->get();
                                      $prsent_status =  count($present) ;
                                      if($leave > 0):?>
                                       <span style="color:orange"> <?php echo "LEAVE";?>
                                       </span>
                                        <?php elseif($training > 0):?>
                                        <span style="color:blue"> <?php echo "TRAINING";?>
                                       </span>

                                       <?php elseif($prsent_status > 0):?>
                                         <span style="color:green"> <?php echo "PRESENT";?>
                                         <?php else:?>
                                          <span style="color:red"> <?php echo "ABSENT";?>
                                     <?php endif;?>
                                      
                                    </td>


                                    <td style="font-size: 15px;color: black;text-align: center;">
                                      <?php if($prsent_status > 0){ ?>
                                       <span style="color:green">   <?php $office_time_query = DB::table('tbl_door_log')
                                      ->where('user_id',$value->id)
                                      ->where('enter_date',$from)
                                      ->orderBy('enter_time','asc')
                                      ->first();
                                      echo date('h:i:s a',strtotime($office_time_query->office_start));
                                      ?>
                                      <?php } ?>
                                    </td> 
                                   
                                    <td style="font-size: 15px;color: black;text-align: center;">
                                      <?php if($prsent_status > 0){ ?>
                                       <span style="color:green">   <?php $present_time = DB::table('tbl_door_log')
                                      ->where('user_id',$value->id)
                                      ->where('enter_date',$from)
                                      ->orderBy('enter_time','asc')
                                      ->first();
                                      echo date('h:i:s a',strtotime($present_time->enter_time));
                                      ?>
                                      <?php } ?>
                                    </td> 
                                      <td style="font-size: 15px;color: black;text-align: center;">
                                      <?php if($prsent_status > 0){ ?>
                                      <?php
                                      $diff_enter_time_in_sec =  strtotime($office_time_query->enter_time);
                                      $diff_offce_time_in_sec =  strtotime($office_time_query->office_start);
                                      $now_calculation_time   = $diff_enter_time_in_sec - $diff_offce_time_in_sec ;
                                      $different_time_is_now  = abs($now_calculation_time); 
                                       if($now_calculation_time > 0):?>
                                       <span style="color:red">L :  <?php echo gmdate("H:i:s", $different_time_is_now);?> </span>

                                       <?php elseif($now_calculation_time == 0) : ?>
                                        <span > A :  <?php echo gmdate("H:i:s", $different_time_is_now);?> </span>
                                       <?php else:?>
                                        <span style="color:blue"> B :  <?php echo gmdate("H:i:s", $different_time_is_now);?> </span>
                                       <?php endif;?>

                                      <?php } ?>
                                    </td>

                                    <td style="font-size: 15px;color: black;text-align: center;">
                                      <span style="color:green"><?php  if($prsent_status > 0){echo $prsent_status;}?></span>
                                    </td> 
                                    <td style="font-size: 15px;color: black;text-align: center;">
                                      <?php if($prsent_status > 0){ ?>
                                      <?php foreach ($present as $present_time_value) { ?>
                                      <span style="color:green">
                                        <?php echo date('h:i:s a',strtotime($present_time_value->enter_time)).' , '; ?>
                                      </span> 
                                      <?php } ?>
                                      <?php } ?>
                                    </td> 
                                    <td style="font-size: 15px;color: black;text-align: center;">
                                      <?php if($leave == 0){ ?>
                                      <?php if($training == 0){ ?>
                                      <?php if($prsent_status == 0){ ?>
                                        <span><a target="_blank" class="btn btn-danger"  href="{{URL::to('manualStaffAttendent/'.$value->id.'/'.$from)}}">ADD</a></span>
                                      <?php } ?>
                                      <?php } ?>
                                       <?php } ?>
                                    </td>
                                     <td style="font-size: 15px;color: black;text-align: center;">
                                      <?php if($leave == 0){ ?>
                                      <?php if($training == 0){ ?>
                                       <?php if($prsent_status > 0){ ?>
                                         <span><a target="_blank" class="btn btn-success"  href="{{URL::to('manualEditStaffAttendentTime/'.$value->id.'/'.$from)}}">EDIT TIME</a></span>
                                       <?php } ?>
                                        <?php } ?>
                                          <?php } ?>
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