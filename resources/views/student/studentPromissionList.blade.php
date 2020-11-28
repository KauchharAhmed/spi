<div class="m-portlet__body">
    <div class="m-portlet">
            <div class="m-portlet__body">
                <!--begin::Section-->
                <!--begin: Search Form -->
                <!--end: Search Form -->
                <table class="table table-bordered table-hover table-responsive" id="html_table">
                  <thead>
                    <tr>    
                    <th><strong>SL NO</strong></th>
                    <th><strong>SHIFT</strong></th>
                    <th><strong>OLD YEAR</strong></th>
                    <th><strong>OLD SEMISTER</strong></th>
                    <th><strong>SECTION</strong></th>
                    <th><strong>OLD STUDENTS</strong></th>
                    <th><strong>NEW YEAR</strong></th>
                    <th><strong>NEW SEMISTER</strong></th>
                    <th><strong>NEW STUDENTS</strong></th>
                    <th><strong>STATUS</strong></th>
    
            </tr>
            </thead>
                               <?php $i = 1 ; foreach ($result as $value) { ?>
                               <tbody>
                                 <tr>
                                    <?php
                                    $old_year_count             = $value->old_year ;
                                    $new_year_count             = $value->new_year ; 
                                    $new_semister_id_count      = $value->new_semister_id ; 
                                    $old_semister_id_count      = $value->old_semister_id ;
                                    $shift_id_count             = $value->shift_id ;
                                    $dept_id_count              = $value->dept_id ;
                                    $section_id_count           = $value->section_id ;
                                    // total students of old semister
                                    $old_student_total_students_count = 
                                     DB::table('student')
                                    ->where('year',$old_year_count)
                                    ->where('shift_id',$shift_id_count)
                                    ->where('dept_id',$dept_id_count)
                                    ->where('semister_id',$old_semister_id_count)
                                    ->where('section_id',$section_id_count)
                                    ->count();
                                    // total students of new semister
                                    $new_student_total_students_count = 
                                    DB::table('student')
                                    ->where('year',$new_year_count)
                                    ->where('shift_id',$shift_id_count)
                                    ->where('dept_id',$dept_id_count)
                                    ->where('semister_id',$new_semister_id_count)
                                    ->where('section_id',$section_id_count)
                                    ->count();
                                    ?>

                                    <td><?php echo $i++ ; ?></td>
                                    <td><?php echo $value->shiftName;?></td>
                                    <td><?php echo $value->old_year;?></td>
                                    <td>
                                    <?php 
                                     $old_semister_query = DB::table('semister')->where('id',$value->old_semister_id)->first();
                                     echo $old_semister_query->semisterName;
                                    ?>
                                    </td>
                                    <td><?php echo $value->section_name;?></td>
                                    <td><?php echo $old_student_total_students_count ;?></td>
                                    <td><?php echo $value->new_year;?></td>
                                    <td><?php echo $value->semisterName;?></td>
                                    <td><?php echo $new_student_total_students_count;?></td>
                                    <td style="color:green;"><b>COMPLETED</b></td>
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