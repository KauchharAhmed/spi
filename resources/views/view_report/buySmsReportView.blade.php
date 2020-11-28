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
                            <div class="col-md-6"><strong style="font-size:20px;color: black;font-weight: bold">BUY SMS REPORT </strong></div>
                            <div class="col-md-2"></div> 
                    <table>
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
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>BUY DATE</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SMS NUMBER</strong></th>
                   </tr>
                  </thead>
                               <?php 
                               $i = 1 ; 
                               $total_sms_number = 0 ;
                               foreach ($result as $value) { $total_sms_number = $total_sms_number + $value->sms_number ; ?>
                               <tbody>
                                 <tr>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $i++ ; ?></td>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo date('d-M-Y',strtotime($value->created_at)) ; ?></td>  
                                     <td style="font-size: 20px;color: black;text-align: center;"><?php ; ?></td> 
  
                                </tr>
                            <?php } ?>           
                    </tbody>
                    <tr>
                        <td colspan="2" style="background:#12141d;font-size: 20px;color: orange;text-align: center;">TOTAL</td>
                                      
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