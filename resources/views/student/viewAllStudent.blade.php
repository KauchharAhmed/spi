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
                              <?php if($shift !=''){?>
                        <div class="col-md-4"></div>
                        <div class="col-md-4" style="font-size:20px;font-weight: bolder">   
                        <strong>SHIFT <span style="margin-left: 43px;">:</span> 
                          <?php echo $value1->shiftName ;  ?></strong></div>
                        <div class="col-md-4"></div>
                        <?php }?>

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

                        <div class="col-md-2"> 
                            {!! Form::open(['url' =>'printStudentList','method' => 'post']) !!}
                            <input type="hidden" name="year" value="<?php echo $year;?>">
                            <input type="hidden" name="shift" value="<?php echo $shift;?>">
                             <input type="hidden" name="semister" value="<?php echo $semister;?>">
                             <input type="hidden" name="section" value="<?php echo $section;?>">
                             <input type="hidden" name="roll" value="<?php echo $roll;?>">

                        <button class="btn btn-primary m-r-5 m-b-5" > <i class="fa fa-print" style="padding-right:10px"></i>PRINT</button>
                         {!! Form::close() !!}
                    </div>
                        <div class="col-md-10"></div>
                      <br/><br/>
                      <!--begin: Search Form -->
        <!--end: Search Form -->
                    <table class="table table-bordered table-hover table-responsive" id="html_table">
                  
                  <thead>
                    <tr>    
                    <th><strong>SL NO</strong></th>
                    <th><strong>R</strong></th>
                    <th><strong>SESSION</strong></th>
                    <th><strong>NAME</strong></th>
                    <th><strong>SHIFT</strong></th>
                    <th><strong>SEMISTER</strong></th>
                    <th><strong>SECTION</strong></th>
                    <th><strong>ROLL</strong></th>
                    <th><strong>REG</strong></th>
                    <th><strong>status</strong></th>
                    <th><strong>MOBILE</strong></th>
                    <th><strong>GENERATE ID CARD</strong></th>
                    <th><strong>ADD RFID NO</strong></th>
                    <th><strong>EDIT</strong></th>
                    <!--<th><strong>DETAILS</strong></th>
                    <th><strong>DELETE</strong></th> -->     
            </tr>
            </thead>
                               <?php $i = 1 ; foreach ($data as $value) { ?>
                               <tbody>
                                 <tr>
                                    <td><?php echo $i++ ; ?></td>
                                    <td><?php echo $value->rfIdNumber;?></td>
                                    <td><?php echo $value->sessionName;?></td>
                                    <td><?php echo $value->studentName;?></td>
                                    <td><?php echo $value->shiftName;?></td>
                                    <td><?php echo $value->semisterName;?></td>
                                    <td><?php echo $value->section_name;?></td>
                                    <td><?php echo $value->roll;?></td>
                                    <td><?php echo $value->registration;?></td>
                                    <td><?php echo $value->semister_status;?></td>
                                    <td><?php echo $value->studentMobile;?></td>

                                    <td> 
                                      <?php if($value->print_id_status == '0'):?>
                                      <a class="btn btn-success" href="{{URL::to('generateIdCard/'.$value->id. '/' .$shift. '/' .$semister)}}" target="_blank">GENERATE ID CARD</a>
                                    <?php else:?>
                                       <a class="btn btn-warning" href="{{URL::to('generateIdCard/'.$value->id. '/' .$shift. '/' .$semister)}}" target="_blank">AGAIN GENERATE</a>
                                    <?php endif;?>
                                    </td>
                                    <td>
                                        <?php if($value->rfIdNumber == ''):?>
                                         <a class="btn btn-warning" href="{{URL::to('addStudentRfidNumber/'.$value->id. '/' .$shift. '/' .$semister)}}" target="_blank">ADD RFID NO</a>
                                         <?php else: ?>
                                            <span style="color: green;"><strong>COMPLETED</strong></span>
                                         <?php endif;?>
                                    </td>
                                      <td><a class="btn btn-primary" href="{{URL::to('editStudentInfo/'.$value->id)}}">EDIT</a></td>  
                                    
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