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
                        {!! Form::open(['url' =>'printStaffTrainingReport','method' => 'post']) !!}
                            <input type="hidden" name="from" value="<?php echo $from;?>">
                            <input type="hidden" name="to" value="<?php echo $to;?>">
                            <input type="hidden" name="staff" value="<?php echo $staff;?>">
                        <button class="btn btn-primary m-r-5 m-b-5" > <i class="fa fa-print" style="padding-right:10px"></i>PRINT</button>
                         {!! Form::close() !!}
                      </div>  
                    </div>
                      <div class="col-md-4"></div>
                            <div class="col-md-6"><strong style="font-size:20px;color: black;font-weight: bold">STAFF TRAINING REPORT </strong></div>
                            <div class="col-md-2"></div> 
                    <table>
                        <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">DATE RANGE</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo date('d M Y',strtotime($from)).' To '.date('d M Y',strtotime($to)) ;?></td>
                      </tr>
                             <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;"> STAFF</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; ">
                          <?php
                          if($staff == '0'){
                            echo 'ALL';
                          }else{
                            foreach ($result as $value1) {
                            
                            }
                         echo $value1->name.' - '.$value1->departmentName.' - '.$value1->degi ;
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
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>STAFF</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>DEPT</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>DEGI</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TRAINING DATE</strong></th>
                    
                   </tr>
                  </thead>
                               <?php 
                               $i = 1 ; foreach ($result as $value) { ?>
                               <tbody>
                                 <tr>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $i++ ; ?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $value->name ; ?></td>   
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $value->departmentName ; ?></td> 
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $value->degi ; ?></td>   
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php 
                                    echo date('d M Y',strtotime($value->final_request_from)) ;
                                    ?></td> 
                                    
                                </tr>
                            <?php } ?>           
                    </tbody>
                    <tr>
                        <td colspan="4" style="background:#12141d;font-size: 20px;color: orange;text-align: center;">TOTAL DAYS</td>
                                      
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