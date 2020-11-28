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
                        <input type="hidden" name="from" value="<?php echo $today;?>">
                        <button class="btn btn-primary m-r-5 m-b-5" > <i class="fa fa-print" style="padding-right:10px"></i>PRINT</button>
                         {!! Form::close() !!}
                      </div>  
                    </div>
                      <div class="col-md-4"></div>
                            <div class="col-md-6"><strong style="font-size:20px;color: black;font-weight: bold">CLASS WISE TEACHER ATTENDENT REPORT</strong></div>
                            <div class="col-md-2"></div> 
                    <table>
                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">DATE</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo date('d M Y',strtotime($today));?></td>
                      </tr>
                       <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">DAY</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo date('l',strtotime($today));?></td>
                      </tr>
                      <tr>
                         <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">FILTER SEMESTER </td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; ">CURRENT SEMESTER ( <?php 
                          $total_semester_is =  DB::table('semister')
                                ->where('semister.status',1)
                                ->get();
                          foreach ($total_semester_is as $value_semister) {
                            echo $value_semister->semisterName.' , ';
                          }

                        ?> )</td>
                      </tr>
                        
                    </table> 
                      <!--begin: Search Form -->
                    <div class="container">
                    <table class="table table-bordered table-hover table-responsive" id="html_table">
                  <thead>
                       <tr>    
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SL NO</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TEACHER NAME</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>DEPT</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>DEG</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL CLASS</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>PRESENT CLASS</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ABSENT CLASS</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>PRESENT CLASS % </strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ABSENT CLASS %</strong></th>
                    
            </tr>
                  </thead>
                                <?php $i = 1 ;
                                foreach ($result as $value) { ?>
                                 <tr>
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $i++ ; ?></td>
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->name ; ?></td>   
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->departmentName ; ?></td>   
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->degi ; ?></td> 
                                    <td style="font-size: 15px;color: black;text-align: center;">
                                      <?php
                                  //today total class of this teacher
                                  $from_year = date('Y');
                                 $total_class =  DB::table('routine')
                                ->join('semister', 'routine.semister_id', '=', 'semister.id')
                                ->select('routine.*')
                                ->where('teacher_id',$value->id)
                                ->where('routine.year', $from_year)
                                ->where('routine.day', $day)
                                ->where('semister.status',1)
                                ->count();
                                echo $total_class ;
                                  ?>
                                    </td> 
                                    <td style="font-size: 15px;color: black;text-align: center;">
                                      <?php
                                       // check leave status 
                                      $leave = DB::table('tbl_leave')
                                      ->where('user_id',$value->id)
                                      ->where('final_request_from', '<=', $today)
                                      ->where('final_request_to', '>=', $today)
                                      ->where('type_status', '0')
                                      ->count();
                                      $traning = DB::table('tbl_leave')
                                      ->where('user_id',$value->id)
                                      ->where('final_request_from', '<=', $today)
                                      ->where('final_request_to', '>=', $today)
                                      ->where('type_status', '1')
                                      ->count();
                                      ?>
                                     <?php if($leave > 0):?>
                                       <span style="color: orange;">LEAVE</span>
                                        <?php elseif($traning > 0):?>
                                       <span style="color: blue;">TRAINING</span>
                                      <?php else: ?>
                                        <?php
                                      // present class count
                                      $present = DB::table('teacher_attendent')
                                      ->where('teacherId',$value->id)
                                      ->where('created_at', $today)
                                      ->where('status',1)
                                      ->count();
                                       echo $present ;
                                      ?>
                                    <?php endif;?> 
                                    </td>
                                    <td style="font-size: 15px;color: black;text-align: center;"> <?php if($leave > 0):?>
                                       <span style="color: orange;">LEAVE</span>
                                          <?php elseif($traning > 0):?>
                                       <span style="color: blue;">TRAINING</span>
                                      <?php else: ?>
                                        <?php
                                        $absent = $total_class-$present ;
                                        echo $absent ;
                                        ?>
                                      <?php endif;?>  </td>
                                      <td style="font-size: 15px;color: black;text-align: center;">
                                        <?php if($leave > 0):?>
                                       <span style="color: orange;">LEAVE</span>
                                          <?php elseif($traning > 0):?>
                                       <span style="color: blue;">TRAINING</span>
                                      <?php else: ?>
                                        <?php if($total_class >0){
                                        $present_percentage = ($present*100)/$total_class;
                                        echo number_format($present_percentage,2).' %' ;
                                      }?>
                                    <?php endif;?>
                                  
                                      </td>
                                      <td style="font-size: 15px;color: black;text-align: center;">   
                                        <?php if($leave > 0):?>
                                       <span style="color: orange;">LEAVE</span>
                                          <?php elseif($traning > 0):?>
                                       <span style="color: blue;">TRAINING</span>
                                      <?php else: ?>
                                        <?php if($total_class >0){
                                        $absent_percentage = ($absent*100)/$total_class;
                                        echo number_format($absent_percentage,2).' %' ;
                                      }
                                      ?>
                                    <?php endif;?>
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