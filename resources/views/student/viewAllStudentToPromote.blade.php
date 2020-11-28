<?php 
foreach ($data as $value1) { }?>
<div class="m-portlet__body">
    <div class="m-portlet">
           
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section">
                    <div class="m-section__content">
                      <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4"><strong style="font-size:20px;font-weight: bolder">PROMOTE TO STUDENT IN NEW SEMISTER</strong></div>
                            <div class="col-md-4"></div>
                              <div class="col-md-4"></div>
                        <div class="col-md-4" style="font-size:20px;font-weight: bolder">   
                        <strong>YEAR <span style="margin-left: 43px;">:</span> 
                          <?php echo $year ;  ?></strong></div>
                        <div class="col-md-4"></div>
                
                        <div class="col-md-4"></div>
                        <div class="col-md-4" style="font-size:20px;font-weight: bolder">   
                        <strong>SHIFT <span style="margin-left: 43px;">:</span> 
                          <?php echo $value1->shiftName ;  ?></strong></div>
                        <div class="col-md-4"></div>

               

                          <?php if($semister !=''){?>
                        <div class="col-md-4"></div>
                        <div class="col-md-4" style="font-size:20px;font-weight: bolder"><strong>SEMISTER : <?php echo $value1->semisterName ; ?></strong></div>
                        <div class="col-md-4"></div>
                        <?php } ?>
                        <div class="col-md-4"></div>
                            <div class="col-md-4" style="font-size:20px;font-weight: bolder"><strong>SECTION : <?php echo $value1->section_name ; ?></strong></div>
                            <div class="col-md-4"></div>
                        
                      </div>
                      <div class="row">

            <!--begin: Search Form -->
        <!--end: Search Form -->
           {!! Form::open(['url' =>'autoPromossionInNewSemister','method' => 'post']) !!}
                    <table class="table table-bordered table-hover table-responsive" id="html_table">
                 
                  <thead>
                    <tr>    
                    <th><strong>SL NO</strong></th>
                    <th><strong>SESSION</strong></th>
                    <th><strong>NAME</strong></th>
                    <th><strong>ROLL</strong></th>
                    <th><strong>REG</strong></th>
                       <th><strong>id</strong></th>
                       <th><strong>status</strong></th>
            </tr>
            </thead>
                               <?php $i = 1 ; foreach ($data as $value) { ?>
                               <tbody>
                                 <tr>
                                    <td><?php echo $i++ ; ?></td>
                                    <td><?php echo $value->sessionName;?></td>
                                    <td><?php echo $value->studentName;?></td>
                                    <td><?php echo $value->roll;?></td>
                                    <td><?php echo $value->registration;?></td>
                                    <td><?php echo $value->studentID;?></td>
                                     <td><?php echo $value->semister_status;?></td>

                                </tr>
                                <input type="hidden" name="roll[]" value="<?php echo $value->roll;?>">
                            <?php } ?>
                                         
                    </tbody>
                        </table>
                    
                            <input type="hidden" name="year" value="<?php echo $year;?>">
                            <input type="hidden" name="shift" value="<?php echo $shift;?>">
                             <input type="hidden" name="semister" value="<?php echo $semister;?>">
                             <input type="hidden" name="section" value="<?php echo $section;?>">
                             <input type="hidden" name="session" value="<?php echo $value1->sessionId;?>">
                        <button class="btn btn-primary m-r-5 m-b-5" >Promote In New Semister</button>
                         {!! Form::close() !!}
                    </div>
                </div>
                <!--end::Section-->
            </div>
            <!--end::Form-->
        </div>
    </div>