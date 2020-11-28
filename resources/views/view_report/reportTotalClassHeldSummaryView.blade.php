<div class="m-portlet__body">
    <div class="m-portlet">
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section">
                    <div class="m-section__content">
                      <div  class="row">
                      <div class="row table-responsive">
                      <div class="col-md-8">
                      </div> 
                      <div class="col-md-2">
                            {!! Form::open(['url' =>'printTotalClassHeldSummaryReportReport','method' => 'post']) !!}
                            <input type="hidden" name="from" value="<?php echo $from; ?>">
                            <button class="btn btn-primary m-r-5 m-b-5" > <i class="fa fa-print" style="padding-right:10px"></i>PRINT</button>
                         {!! Form::close() !!}
                      </div>  
                    </div>
                        <div class="col-md-3"></div>
                            <div class="col-md-8"><strong style="font-size:20px;color: black;font-weight: bold">TOTAL CLASS HELD ATTENDENT SUMMARY REPORT</strong></div>
                            <div class="col-md-1"></div> 

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
                    </table>
                      <!--begin: Search Form -->
                  <!--end: Search Form -->
                  <div class="container">
                    <table class="table table-bordered table-hover table-responsive" id="html_table" 
                    >
                    <thead>
                    <tr>    
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SL</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SHIFT</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL CLASSES</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL HELD CLASSES</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TOTAL NOT HELD CLASSES</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>CLASS HELD  % </strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>CLASS NOT HELD %</strong></th>
            </tr>
            </thead>
                              
                               <tbody>
                                 <?php 
                                 $i = 1 ;
                                 foreach ($result as $value) { ?>
                                 <tr>
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $i++;?></td>
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->shiftName ; ?></td>
                                    <td style="font-size: 15px;color: black;text-align: center;">
                                      <?php
                                 $total_class_count = DB::table('routine')
                                ->join('semister', 'routine.semister_id', '=', 'semister.id')
                                ->select('routine.*')
                                ->where('routine.year', $from_year)
                                ->where('routine.shift_id', $value->id)
                                ->where('routine.day', $current_day)
                                ->where('semister.status',1)
                                ->count();
                                echo $total_class_count ;
                               ?>
                                    </td>
                                    <td style="font-size: 15px;color: black;text-align: center;">
                                      <?php
                                      $total_class_held = DB::table('teacher_attendent')->where('created_at',$from)->where('shift_id',$value->id)->where('status',1)->where('type',3)->count();
                                      echo $total_class_held ; 
                                      ?>
                                    </td>
                                    <td style="font-size: 15px;color: black;text-align: center;">
                                      <?php $not_held = $total_class_count - $total_class_held ; echo $not_held ;  ?> 
                                    </td>
                                    <td style="font-size: 15px;color: black;text-align: center;">
                                      <?php $class_held_perchatage   = ($total_class_held*100)/$total_class_count;
                                      echo number_format($class_held_perchatage,2).'%';
                                      ?>
                                      
                                    </td>
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php $class_not_held_perchatage   = ($not_held*100)/$total_class_count;
                                      echo number_format ($class_not_held_perchatage,2).'%';
                                      ?></td>
                                    
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