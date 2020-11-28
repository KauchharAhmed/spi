<?php foreach ($data as $value1) { }?>
<div class="m-portlet__body">
    <div class="m-portlet">
           
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section">
                    <div class="m-section__content">
                      <div class="row">
                        <?php foreach ($data as $value) { ?>
                        
                            <div class="col-md-4">
                            <strong><span style="font-size:8px;">SIRAJGANJ POLYTECHNIC INSTITUTE,SIRAJGANJ</span></strong>
                            <br/>
                            <span style="font-size:8px;">E-mail: Principal.spi@gmail.com, Phone : 0761-64286</span>
                            <span>
                                <?php if($value->studentImage != ''):?>
                               <img style="padding-left: 36px;" src="<?php echo $value->studentImage; ?>" width="100" height="100"> 
                           <?php else: ?>

                           <?php endif;?>
                            </span>
                           <div class="row" style="font-size:6px;">
                            <div class="col-md-4">Name</div>
                            <div class="col-md-4">:</div>
                             <div class="col-md-2"><?php echo $value->studentName;?></div>  
                             <div class="col-md-2"></div>    
                            </div>

                           <div class="row" style="font-size:6px;">
                            <div class="col-md-4">Father's Name</div>
                            <div class="col-md-4">:</div>
                             <div class="col-md-2"> <?php echo $value->fatherName;?>   </div>  
                             <div class="col-md-2"></div>    
                            </div>
                            <div class="row" style="font-size:6px;">
                            <div class="col-md-4">Mobile</div>
                            <div class="col-md-4">:</div>
                             <div class="col-md-2"> <?php echo $value->studentMobile;?>   </div>  
                             <div class="col-md-2"></div>    
                            </div>

                              <div class="row" style="font-size:6px;">
                            <div class="col-md-4">Shift</div>
                            <div class="col-md-4">:</div>
                             <div class="col-md-2"> <?php echo $value->shiftName;?>   </div>  
                             <div class="col-md-2"></div>    
                            </div>

                              <div class="row" style="font-size:6px;">
                            <div class="col-md-4">Technology</div>
                            <div class="col-md-4">:</div>
                             <div class="col-md-2"> <?php echo $value->departmentName;?>   </div>  
                             <div class="col-md-2"></div>    
                            </div>
                              <div class="row" style="font-size:6px;">
                            <div class="col-md-4">Section</div>
                            <div class="col-md-4">:</div>
                             <div class="col-md-2"> <?php echo $value->section_name;?>   </div>  
                             <div class="col-md-2"></div>    
                            </div>
                              <div class="row" style="font-size:6px;">
                            <div class="col-md-4">Roll</div>
                            <div class="col-md-4">:</div>
                             <div class="col-md-2"> <?php echo $value->roll;?>   </div>  
                             <div class="col-md-2"></div>    
                            </div>
                              <div class="row" style="font-size:6px;">
                            <div class="col-md-4">Session</div>
                            <div class="col-md-4">:</div>
                             <div class="col-md-2"> <?php echo $value->sessionName;?>   </div>  
                             <div class="col-md-2"></div>    
                            </div>
                            <br/>


                             <div class="row" style="font-size:6px;">

                           <div class="col-md-4"></div>
                            
                           <div class="col-md-4"> <img style="padding-left: 36px;" src="<?php echo $dep_signature->signature; ?>" width="50" height="30"></div>
                           <div class="col-md-4"></div>
                         </div>
                         
                         <div class="row" style="font-size:6px;">

                           <div class="col-md-4">Register</div>
                            
                           <div class="col-md-4">Head Of Dept</div>
                           <div class="col-md-4">Principal</div>
                         </div>

                        






                            </div>
                            <?php } ?>

                             

                        
                      </div>
                  
                      <!--begin: Search Form -->
        <!--end: Search Form -->
              
                    </div>
                </div>
                <!--end::Section-->
            </div>
            <!--end::Form-->
        </div>
    </div>