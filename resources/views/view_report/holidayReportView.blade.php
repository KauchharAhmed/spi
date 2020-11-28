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
                            <input type="hidden" name="holiday_type" value="<?php echo $holiday_type_is;?>">
                        <button class="btn btn-primary m-r-5 m-b-5" > <i class="fa fa-print" style="padding-right:10px"></i>PRINT</button>
                         {!! Form::close() !!}
                      </div>  
                    </div>
                      <div class="col-md-4"></div>
                            <div class="col-md-6"><strong style="font-size:20px;color: black;font-weight: bold">HOLIDAY REPORT </strong></div>
                            <div class="col-md-2"></div> 
                    <table>
                        <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">DATE RANGE</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo date('d M Y',strtotime($from)).' To '.date('d M Y',strtotime($to)) ;?></td>
                      </tr>
                             <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;"> HOLIDAY TYPE</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; ">
                          <?php
                          if($holiday_type_is == ''){
                            echo 'ALL';
                          }else{
                            if($holiday_type_is == '1'){
                              echo "Weekly";

                            }elseif($holiday_type_is == '2'){
                             echo "Public";
                            }elseif($holiday_type_is == '3'){
                              echo "Optional";
                            }elseif($holiday_type_is == '4'){
                              echo "National";
                            }elseif($holiday_type_is == '5'){
                              echo "Exam Break";
                            }elseif($holiday_type_is == '6'){
                              echo "Semester Break";
                            }elseif($holiday_type_is == '7'){
                              echo "Observance";
                            }elseif($holiday_type_is == '8'){
                              echo "Sports Break";
                            }
 
                          }

                          ?>
                        </td>
                      </tr>
                    </table> 
                      <!--begin: Search Form -->
                    <div class="container">
                    <table class="table table-bordered table-hover table-responsive" id="html_table">
                  <thead>
                    <tr>    
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SL</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>HOLIDAY DATE</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>HOLYDAY TYPE</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>KEY NOTE</strong></th>
                   
                    
                   </tr>
                  </thead>
                               <?php 
                               $i = 1 ; foreach ($result as $value) { ?>
                               <tbody>
                                 <tr>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $i++ ; ?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo date('d-M-Y',strtotime($value->holiday_date)) ; ?></td>   
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php 
                                    if($value->type == '1'){
                                    echo "Weekly";

                            }elseif($value->type == '2'){
                             echo "Public";
                            }elseif($value->type == '3'){
                              echo "Optional";
                            }elseif($value->type == '4'){
                              echo "National";
                            }elseif($value->type == '5'){
                              echo "Exam Break";
                            }elseif($value->type == '6'){
                              echo "Semester Break";
                            }elseif($value->type == '7'){
                              echo "Observance";
                            }elseif($value->type == '8'){
                              echo "Sports Break";
                            } 

                                     ?></td> 
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php 
                                    if($value->type == '1'){
                                   echo "Campus Off";

                            }elseif($value->type == '2'){
                          echo "Campus Off";
                            }elseif($value->type == '3'){
                            echo "Campus Off";
                            }elseif($value->type == '4'){
                              echo "Campus Off";
                            }elseif($value->type == '5'){
                              echo "Campus Open But Class Off";
                            }elseif($value->type == '6'){
                               echo "Campus Open But Class Off";
                            }elseif($value->type == '7'){
                              echo "Campus Open";
                            }elseif($value->type == '8'){
                               echo "Campus Open But Class Off";
                            } 

                                     ?></td>   
                                    
                                    
                                </tr>
                            <?php } ?>           
                    </tbody>
                    <tr>
                        <td colspan="3" style="background:#12141d;font-size: 20px;color: orange;text-align: center;">TOTAL HOLIDAYS</td>
                                      
                          <td style="background:#12141d;font-size: 20px;color: orange;text-align: center;"><?php echo count($result);?></td> 
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