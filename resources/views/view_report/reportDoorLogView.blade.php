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
                            {!! Form::open(['url' =>'printDailyDoorLog','method' => 'post']) !!}
                            <input type="hidden" name="from" value="<?php echo $from;?>">
                            <input type="hidden" name="type_of_person" value="<?php echo $type_of_person;?>">
                             <input type="hidden" name="order_is" value="<?php echo $order_is;?>">
                             <input type="hidden" name="see_how_many_person" value="<?php echo $see_how_many_person;?>">
                        <button class="btn btn-primary m-r-5 m-b-5" > <i class="fa fa-print" style="padding-right:10px"></i>PRINT</button>
                         {!! Form::close() !!}
                      </div>  
                    </div>
                        <div class="col-md-4"></div>
                            <div class="col-md-6"><strong style="font-size:20px;color: black;font-weight: bold">DAILY DOOR LOG REPORT </strong></div>
                            <div class="col-md-2"></div> 

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

                         <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">TYPE</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php
                         if($type_of_person == '0'){
                          echo "ALL";
                         }elseif($type_of_person == 'staff'){
                          echo "ALL STAFFS";
                         }elseif($type_of_person == 'stu'){
                          echo "ALL STUDENTS";
                         }elseif($type_of_person == '2'){
                          echo "ADMINS";
                         }elseif($type_of_person == '3'){
                          echo "TEACHERS";
                         }elseif($type_of_person == '5'){
                          echo "CRAFTS";
                         }elseif($type_of_person == '6'){
                          echo "OTHER STAFFS";
                         }elseif($type_of_person == '10'){
                          echo "GUEST";
                         }

                         ?></td>
                      </tr>
                       <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">Order </td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php if($order_is=='1'){echo "FIRST";}else{echo "LAST";}?></td>
                      </tr>
                       <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">Search </td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "> 1 To <?php echo $see_how_many_person ; ?></td>
                      </tr> 
                    </table>
                      <!--begin: Search Form -->
                      <div class="container">
                    <table class="table table-bordered table-hover table-responsive" id="html_table">
                  <thead>
                    <tr>    
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SL</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TYPE</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>DEPT</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>NAME</strong></th>
                          <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ROLL(For Student)</strong></th>
                      <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>MOBILE</strong></th>
                       <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>PICTURE</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>ENTER TIME</strong></th>
                   </tr>
                  </thead>
                               <?php $i = 1 ; 
                               foreach ($result as $value) { ?>
                               <tbody>
                                 <tr>
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $i++ ; ?></td>
                                    <td style="font-size: 15px;color: black;text-align: center;">
                                      <?php
                                      if($value->type == '1'){
                                        // staff
                                        if($value->user_type == '2'){
                                          echo "ADMIN";
                                        }elseif($value->user_type == '3'){
                                          echo "TEACHER";
                                        }elseif($value->user_type == '4'){
                                          echo "CRAFT";
                                        }elseif($value->user_type == '5'){
                                          echo "OTHER STAFF";
                                        }elseif($value->user_type == '10'){
                                          echo "Visitor";
                                        }
                                      }else{
                                        // student
                                        echo "STUDENT";
                                      }
                                      ?>
                                      
                                    </td>   
                                    <td style="font-size: 15px;color: black;text-align: center;">
                                      <?php
                                      if($value->dep_id != '0'){
                                          $dept_info = DB::table('department')->where('id',$value->dep_id)->first();
                                        echo $dept_info->departmentName;
                                        }
                                      ?> 
                                    </td> 
                                    <td style="font-size: 15px;color: black;text-align: center;">
                                      <?php
                                      if($value->type == '1'){
                                        // staff
                                        $staff_name_query = DB::table('users')->where('id',$value->user_id)->first();
                                        echo $staff_name_query->name ;
                                      }else{
                                        // student
                                          $student_name_query = DB::table('students')->where('id',$value->student_id)->first();
                                          echo $student_name_query->studentName;
                                      }
                                      ?>
                                    </td> 
                                    <td style="font-size: 15px;color: black;text-align: center;">
                                      <?php if($value->roll > 0){
                                        echo $value->roll;
                                      }
                                      ?>
                                    </td>   
                                    <td style="font-size: 15px;color: black;text-align: center;">
                                       <?php
                                      if($value->type == '1'){
                                        // staff
                                        $staff_mobile_query = DB::table('users')->where('id',$value->user_id)->first();
                                        echo $staff_mobile_query->mobile ;
                                      }else{
                                        // student
                                          $student_mobile_query = DB::table('students')->where('id',$value->student_id)->first();
                                          echo $student_mobile_query->studentMobile;
                                      }

                                      ?>
                                    </td> 
                                    <td style="font-size: 15px;color: black;text-align: center;">
                                      <?php if($value->type == '1'){ 
                                        $staff_image_query = DB::table('users')->where('id',$value->user_id)->first();?>
                                        <img width='80' height="80" style="border-radius: 50px" src=<?php echo $staff_image_query->image;?>>
                                       <?php  } ?>
                                       <?php if($value->type == '2'){  ?>

                                        <?php $student_image_query = DB::table('students')->where('id',$value->student_id)->first();
                                        ?>

                                       <img width='80' height="80" style="border-radius: 50px" src=<?php echo $student_image_query->studentImage;?>>

                                       <?php } ?>
                                    </td>
                                      <td style="font-size: 15px;color: black;text-align: center;">
                                      <?php echo date('h:i:s a',strtotime($value->enter_time));?>
                                    </td>
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