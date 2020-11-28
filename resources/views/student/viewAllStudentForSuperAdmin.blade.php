<?php foreach ($data as $value1) { }?>
<div class="m-portlet__body">
    <div class="m-portlet">
           
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section">
                    <div class="m-section__content">
                      <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4"><strong style="font-size:20px;font-weight: bolder">STUDENT LIST</strong></div>
                            <div class="col-md-4"></div>


                        <div class="col-md-4"></div>
                        <div class="col-md-4" style="font-size:20px;font-weight: bolder">   
                        <strong>YEAR <span style="margin-left: 52px;">:</span> 
                          <?php echo $year ;  ?></strong></div>
                        <div class="col-md-4"></div>
                           <?php if($dept != ''):?>
                        <div class="col-md-4"></div>
                        <div class="col-md-4" style="font-size:20px;font-weight: bolder">   
                        <strong>DEPT  <span style="margin-left: 56px;">:</span> 
                          <?php echo $value1->departmentName ;  ?></strong></div>
                        <div class="col-md-4"></div>
                        <?php else:?>
                          <div class="col-md-4"></div>
                        <div class="col-md-4" style="font-size:20px;font-weight: bolder">   
                        <strong>DEPT  <span style="margin-left: 56px;">:</span> 
                          ALL</strong></div>
                        <div class="col-md-4"></div>
                      <?php endif;?>


               
                        <?php if($shift !=''):?>
                        <div class="col-md-4"></div>
                        <div class="col-md-4" style="font-size:20px;font-weight: bolder">   
                        <strong>SHIFT  <span style="margin-left: 52px;">:</span> 
                          <?php echo $value1->shiftName ;  ?></strong></div>
                        <div class="col-md-4"></div>
                       <?php else:?>
                            <div class="col-md-4"></div>
                        <div class="col-md-4" style="font-size:20px;font-weight: bolder">   
                        <strong>SHIFT  <span style="margin-left: 52px;">:</span> 
                          ALL</strong></div>
                        <div class="col-md-4"></div>
                        <?php endif;?>

                          <?php if($semister !=''):?>
                        <div class="col-md-4"></div>
                        <div class="col-md-4" style="font-size:20px;font-weight: bolder">

                          <strong>SEMESTER  <span style="margin-left: 2px;">:</span> 
                          <?php echo $value1->semisterName ;  ?></strong>

                        </div>
                        <div class="col-md-4"></div>
                        <?php else:?>
                            <div class="col-md-4"></div>
                        <div class="col-md-4" style="font-size:20px;font-weight: bolder">
                          <strong>SEMESTER  <span style="margin-left: 2px;">:</span> 
                          ALL</strong>
                        </div>
                        <div class="col-md-4"></div>
                        <?php endif;?>
                           <?php if($section !=''):?>
                        <div class="col-md-4"></div>
                        <div class="col-md-4" style="font-size:20px;font-weight: bolder"><strong>SECTION <span style="margin-left: 21px;">:</span> <?php echo $value1->section_name ; ?></strong></div>
                        <div class="col-md-4"></div>
                      <?php else:?>
                           <div class="col-md-4"></div>
                        <div class="col-md-4" style="font-size:20px;font-weight: bolder"><strong>SECTION <span style="margin-left: 21px;">:</span>  ALL</strong></div>
                        <div class="col-md-4"></div>
                      <?php endif;?>
                
                      </div>
                      <div class="row">
                        {!! Form::open(['url' =>'printStudentListforSuperAdmin','method' => 'post']) !!}
                            <input type="hidden" name="year" value="<?php echo $year;?>">
                            <input type="hidden" name="dept" value="<?php echo $dept;?>">
                            <input type="hidden" name="shift" value="<?php echo $shift;?>">
                            <input type="hidden" name="semister" value="<?php echo $semister;?>">
                            <input type="hidden" name="section" value="<?php echo $section;?>">

                        <button class="btn btn-primary m-r-5 m-b-5" > <i class="fa fa-print" style="padding-right:10px"></i>PRINT</button>
                         {!! Form::close() !!}
                         &nbsp;&nbsp;&nbsp;
                         {!! Form::open(['url' =>'csvStudentListforSuperAdmin','method' => 'post']) !!}
                            <input type="hidden" name="year" value="<?php echo $year;?>">
                            <input type="hidden" name="dept" value="<?php echo $dept;?>">
                            <input type="hidden" name="shift" value="<?php echo $shift;?>">
                            <input type="hidden" name="semister" value="<?php echo $semister;?>">
                            <input type="hidden" name="section" value="<?php echo $section;?>">

                        <button class="btn btn-success m-r-5 m-b-5" > <i class="fa fa-file-excel-o" style="padding-right:10px"></i>EXCEL (CSV)</button>
                         {!! Form::close() !!}

                        <div class="col-md-2"> 
                            
                    </div>
                        <div class="col-md-10"></div>
                      <br/><br/>
                      <!--begin: Search Form -->
        <!--end: Search Form -->
                    <table class="table table-bordered table-hover table-responsive" id="html_table">
                  
                  <thead>
                    <tr>    
                    <th><strong>SL NO</strong></th>
                    <th><strong>SESSION</strong></th>
                    <th><strong>NAME</strong></th>
                    <th><strong>DEPT</strong></th>
                    <th><strong>SHIFT</strong></th>
                    <th><strong>SEMISTER</strong></th>
                    <th><strong>SECTION</strong></th>
                    <th><strong>ROLL</strong></th>
                    <th><strong>REG</strong></th>
                    <th><strong>MOBILE</strong></th>

                    <!--<th><strong>DETAILS</strong></th>
                    <th><strong>DELETE</strong></th> -->     
            </tr>
            </thead>
                               <?php $i = 1 ; foreach ($data as $value) { ?>
                               <tbody>
                                 <tr>
                                    <td><?php echo $i++ ; ?></td>
                                    <td><?php echo $value->sessionName;?></td>
                                    <td><?php echo $value->studentName;?></td>
                                     <td><?php echo $value->departmentName;?></td>
                                    <td><?php echo $value->shiftName;?></td>
                                    <td><?php echo $value->semisterName;?></td>
                                    <td><?php echo $value->section_name;?></td>
                                    <td><?php echo $value->roll;?></td>
                                    <td><?php echo $value->registration;?></td>
                                    <td><?php echo $value->studentMobile;?></td>  
                                    
                                </tr>
                            <?php } ?>       
                    </tbody>

                        </table>
                    </div>
                </div>
                <!--end::Section-->
            </div>
            <!--end::Form-->
        </div>
    </div>