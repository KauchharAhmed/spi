<div class="m-portlet__body" style="background: aliceblue;">
  <div class="row">
 <div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Id Card Created :</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"><?php if($data->print_id_status == '1'): ;?>
  <span style="color:green;font-weight: bold">YES</span>
<?php else:?>
  <span style="color:red;font-weight: bold">NO</span>
<?php endif;?>

</div>
<div class="col-md-4"></div>

<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">RFID :</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"><?php if($data->rfIdNumber != ''): ;?>
  <span style="color:green;font-weight: bold">COMPLETED (<?php echo $data->rfIdNumber;?>)</span>
<?php else:?>
  <span style="color:red;font-weight: bold">NOT COMPLETED</span>
<?php endif;?>

</div>
<div class="col-md-4"></div>
<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">ID No</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"><?php echo 'S-'.$data->studentID ;?></div>
<div class="col-md-4"></div>
<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Department Name</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"><?php echo $data->departmentName ;?></div>
<div class="col-md-4"></div>
<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Shift Name</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"> <?php echo $data->shiftName ;?></div>
<div class="col-md-4"></div>
<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Semister Name</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"> <?php echo $data->semisterName ;?></div>
<div class="col-md-4"></div>
<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Section Name</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"><?php echo $data->section_name ;?></div>
<div class="col-md-4"></div>
<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Student Name</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"> <?php echo $data->studentName ;?></div>
<div class="col-md-4"></div>

<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Student Roll</div>
<div class="col-md-1"> : </div>
<div class="col-md-2" style="font-weight: bold;"> <?php echo $data->roll ;?></div>
<div class="col-md-4"></div>

<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Student Registration</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"><?php echo $data->registration ;?></div>
<div class="col-md-4"></div>
<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Student Mobile</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"><?php echo $data->studentMobile ;?></div>
<div class="col-md-4"></div>
<div class="col-md-3"></div>
<div class="col-md-2" style="font-weight: bold;">Student Photo</div>
<div class="col-md-1"> : </div>
<div class="col-md-2"> <?php if(!empty($data->studentImage)):?>
<img src="{{URL::to($data->studentImage) }}" width="150" height="100">
               <?php else:?>
                <span style="color:red">GET BLANK ID CARD</span>
                <?php endif; ?>
               </div>
<div class="col-md-4"></div>

<div class="col-md-3"></div>

<div class="col-md-3"> <label for="phone_number"></label>
                       <a href="{{URL::to('studentDroopOut/'.$data->studentID)}}"><button type="submit" id="send_button" class="form-control  btn btn-danger" style="margin-top:6px">DROPOUT</button></a>  </div>
<div class="col-md-3"></div>
<div class="col-md-3"><a target="_blank" href="{{URL::to('duplicateVerifyCheck/'.$data->roll)}}"><button type="submit" id="send_button" class="form-control  btn btn-info" style="margin-top:6px">DUPLICATE VERIFY CHECK</button></a></div>
</div>
</div>
<!--end: Search Form -->
<!--begin: Datatable -->
<!-- </div>-->
</div>
</div>

