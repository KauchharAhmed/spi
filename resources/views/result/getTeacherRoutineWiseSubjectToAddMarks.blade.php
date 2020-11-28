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
                    </div>
                        <div class="col-md-3"></div>
                          <div class="col-md-8"><strong style="font-size:20px;color: black;font-weight: bold">ADD RESULT MARKS</strong></div>
                      <div class="col-md-1"></div> 
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
                      <div class="container">
                    <table class="table table-bordered table-hover table-responsive" id="html_table">
                  <thead>
                    <tr>    
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SL</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SUBJECT</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>CODE</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TYPE</strong></th>
                      <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>CREDIT</strong></th>
                       <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>MARKS TYPE</strong></th>
                  </thead>
                               <?php $i = 1 ; foreach ($result as $value) { ?>
                               <tbody>
                                 <tr>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $i++ ;?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php // get subject info
                                      $subject_info = DB::table('subject')->where('id',$value->subject_id)->first();
                                      echo $subject_info->subject_name ;
                                      ?> 
                                    </td>   
                                    <td style="font-size: 20px;color: black;text-align: center;"> <?php echo $subject_info->subject_code ;?></td>    
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                      <?php 
                                    if($subject_info->subject_type == '1'):?>
                                    <span>THEORETICAL</span>
                                  <?php elseif($subject_info->subject_type == '2'):?>
                                     <span>PRACTICAL</span>
                                  <?php else:?>
                                    <span>THEORETICAL & PRACTICAL</span>
                                    <?php endif;?></td> 
                                  <td style="font-size: 20px;color: black;text-align: center;"> <?php echo $subject_info->cradit ;?></td> 
                                    <td style="font-size: 20px;color: black;text-align: center;"> 
                                      <table class="table table-bordered table-hover table-responsive">
                                        <tr>
                                          <td>MARKS TYPE</td>
                                          <td>TOTAL MARKS</td>
                                          <td>ADD MARKS</td>
                                        </tr>
                                      <?php 
                                      $count_theroy_marks_of_this_sub = DB::table('subject_marks_type')->where('subject_id',$value->subject_id)->where('marks','>',0)->where('type',1)->count();
                                      $subject_marks_type_query = DB::table('subject_marks_type')->where('subject_id',$value->subject_id)->where('marks','>',0)->get();
                                      if($count_theroy_marks_of_this_sub > 0):?>
                                      <?php
                                     $mid_percentage = $porbidhan_details->mid_tearm_percentage ;
                                    $therory_continius_total_marks = DB::table('subject_marks_type')->where('subject_id',$value->subject_id)->where('type',1)->first();
                                    $_mid_term_marks_is = ($therory_continius_total_marks->marks * $mid_percentage)/100 ;
                                      ?>
                                          <tr>
                                          <td>Mid Term</td>
                                          <td><?php echo $_mid_term_marks_is ; ?></td>
                                          <td>
                                            <a target="_blank" class="btn btn-primary" href="{{URL::to('teacherAddMarks/'.$probidhan_id.'/'.$year.'/'.$shift.'/'.$dept.'/'.$semister.'/'.$section.'/'.$value->subject_id.'/'.'0'.'/'.$_mid_term_marks_is)}}">Add Marks</a></td>
                                        </tr>
                                        <?php foreach ($subject_marks_type_query as $subject_marks_value) { ?>
                                          <tr>
                                          <td><?php echo $subject_marks_value->type_name;?></td>
                                          <td><?php
                                          if($subject_marks_value->type == '1'){ 
                                          $subject_actual_marks_is = $subject_marks_value->marks - $_mid_term_marks_is;
                                          echo $subject_actual_marks_is ;
                                        }
                                          else{
                                            $subject_actual_marks_is = $subject_marks_value->marks ;
                                             echo $subject_actual_marks_is ;
                                          }
                                          ?></td>
                                          <td>  <a target="_blank" class="btn btn-primary" href="{{URL::to('teacherAddMarks/'.$probidhan_id.'/'.$year.'/'.$shift.'/'.$dept.'/'.$semister.'/'.$section.'/'.$value->subject_id.'/'.$subject_marks_value->type.'/'.$subject_actual_marks_is)}}">Add Marks</a></td>
                                        </tr>
                                    <?php }  ?>
                                    <?php else:?>
                                        <?php foreach ($subject_marks_type_query as $subject_marks_value) { ?>
                                          <tr>
                                          <td><?php echo $subject_marks_value->type_name;?></td>
                                          <td><?php  $subject_actual_marks_is = $subject_marks_value->marks ;
                                             echo $subject_actual_marks_is ;?></td>
                                          <td>
                                            <a target="_blank" class="btn btn-primary" href="{{URL::to('teacherAddMarks/'.$probidhan_id.'/'.$year.'/'.$shift.'/'.$dept.'/'.$semister.'/'.$section.'/'.$value->subject_id.'/'.$subject_marks_value->type.'/'.$subject_actual_marks_is)}}">Add Marks</a>
                                            
                                          </td>
                                        </tr>
                                     
                                      <?php }  ?>
                                    <?php endif;?>
                                    </table>
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