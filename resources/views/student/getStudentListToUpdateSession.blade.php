<?php foreach ($data as $value1) { }?>
 {!! Form::open(['url' =>'updateStudentSessionInfo','method' => 'post']) !!}
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
                    <th><strong>SHIFT</strong></th>
                    <th><strong>SEMISTER</strong></th>
                    <th><strong>SECTION</strong></th>
                    <th><strong>ROLL</strong></th>
                    <th><strong>REG</strong></th>
                    <th><strong>status</strong></th>
                    <th><strong>MOBILE</strong></th>
                    <th><strong>SESSION</strong></th>
                    
            </tr>
            </thead>
             
                               <?php $i = 1 ; foreach ($data as $value) { ?>
                               <tbody>
                                 <tr>
                                    <td><?php echo $i++ ; ?></td>
                                    <td><?php echo $value->sessionName;?></td>
                                    <td><?php echo $value->studentName;?></td>
                                    <td><?php echo $value->shiftName;?></td>
                                    <td><?php echo $value->semisterName;?></td>
                                    <td><?php echo $value->section_name;?></td>
                                    <td><?php echo $value->roll;?></td>
                                    <td><?php echo $value->registration;?></td>
                                    <td><?php echo $value->semister_status;?></td>
                                    <td><?php echo $value->studentMobile;?></td>
                                     <input type="hidden" name="id[]" value="<?php echo $value->new_semister_student_id;?>"> 
                                    <td> 
                                <select class="form-control m-input m-input--square"  name="session_id[]" required="">
                            <option value="">Select Session</option>
                            <?php foreach ($session as  $session_value) { ?>
                                <option value="<?php echo $session_value->id ; ?>"><?php echo $session_value->sessionName;?></option>
                            <?php } ?>
                        </select> 
                         </td>
                        </tr>
                        <?php } ?>         
                    </tbody> 
                    </table>
                    <button class="btn btn-primary m-r-5 m-b-5" type="submit" >UPDATE</button>
                     {!! Form::close() !!}  
                    </div>
                </div>
                <!--end::Section-->
            </div>
            <!--end::Form-->
        </div>
    </div>