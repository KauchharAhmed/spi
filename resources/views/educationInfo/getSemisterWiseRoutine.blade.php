<div class="m-portlet__body">
    <div class="m-portlet">
           
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section">
                    <div class="m-section__content">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4" style="font-size:20px;font-weight: bolder"><strong>SHIFT <span style="margin-left: 43px;
}">:</span> <?php echo $shift->shiftName ; ?></strong></div>
                            <div class="col-md-4"></div>
                               <div class="col-md-4"></div>
                            <div class="col-md-4" style="font-size:20px;font-weight: bolder"><strong>SEMISTER : <?php echo $semister->semisterName ; ?></strong></div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4" style="font-size:20px;font-weight: bolder"><strong>SECTION: <?php echo $section->section_name ; ?></strong></div>
                            <div class="col-md-4"></div>
                            
                        </div>
                        <br/><br/>
                          <div class="row">

                        <div class="col-md-2"> 
                            {!! Form::open(['url' =>'printSemisterRoutine','method' => 'post']) !!}
                            <input type="hidden" name="year" value="<?php echo $year;?>">
                            <input type="hidden" name="shift" value="<?php echo $shift_id;?>">
                             <input type="hidden" name="semister" value="<?php echo $semister_id;?>">
                             <input type="hidden" name="section" value="<?php echo $section_id;?>">
                        <button class="btn btn-primary m-r-5 m-b-5" > <i class="fa fa-print" style="padding-right:10px"></i>PRINT</button>
                         {!! Form::close() !!}
                    </div>
                        <div class="col-md-10"></div>
                      <br/><br/>
                    <table class="table table-bordered table-hover table-responsive">
                    <tbody>
                
                                 <tr>
                                    <td><strong>SATURDAY</strong></td>
                                    <?php foreach ($day1 as $day1value) { ?>
                                        <td>
                                            <?php 
                                                echo date('h:i A', strtotime($day1value->from)).' - '.date('h:i A', strtotime($day1value->to)) ;
                                                ?>
                                                <br/>
                                                <?php echo 'Room '.$day1value->room_no ;?>
                                                <br/>
                                                <?php 
                                                echo $day1value->subject_name.'( '.$day1value->subject_code.' )' ;
                                                ?>
                                                <br/>
                                                <?php 
                                                echo $day1value->name ;
                                                ?>
                                                <br/>
                                                <a  href="{{URL::to('changeRoutine/'.$day1value->id)}}">Change Routine</a>

                                            </td>
                                   <?php } ?> 
                                </tr>
                                    <tr>
                                    <td><strong>SUNDAY</strong></td>
                                    <?php foreach ($day2 as $day2value) { ?>
                                        <td>
                                            <?php 
                                                echo date('h:i A', strtotime($day2value->from)).' - '.date('h:i A', strtotime($day2value->to)) ;
                                                ?>
                                                <br/>
                                                <?php echo 'Room '.$day2value->room_no ;?>
                                                <br/>
                                                <?php 
                                                echo $day2value->subject_name.'( '.$day2value->subject_code.' )' ;
                                                ?>
                                                <br/>
                                                <?php 
                                                echo $day2value->name ;
                                                ?>
                                                       <br/>
                                                <a  href="{{URL::to('changeRoutine/'.$day2value->id)}}">Change Routine</a>

                                            </td>
                                   <?php } ?> 
                                </tr>
                                    <tr>
                                    <td><strong>MONDAY</strong></td>
                                    <?php foreach ($day3 as $day3value) { ?>
                                        <td>
                                            <?php 
                                                echo date('h:i A', strtotime($day3value->from)).' - '.date('h:i A', strtotime($day3value->to)) ;
                                                ?>
                                                <br/>
                                                  <?php echo 'Room '.$day3value->room_no ;?>
                                                <br/>
                                                <?php 
                                                echo $day3value->subject_name.'( '.$day3value->subject_code.' )' ;
                                                ?>
                                                <br/>
                                                <?php 
                                                echo $day3value->name ;
                                                ?>
                                               <br/>
                                                <a  href="{{URL::to('changeRoutine/'.$day3value->id)}}">Change Routine</a>

                                            </td>
                                   <?php } ?> 
                                </tr>
                                    <tr>
                                    <td><strong>TUESDAY</strong></td>
                                    <?php foreach ($day4 as $day4value) { ?>
                                        <td>
                                            <?php 
                                                echo date('h:i A', strtotime($day4value->from)).' - '.date('h:i A', strtotime($day4value->to)) ;
                                                ?>
                                                <br/>
                                                     <?php echo 'Room '.$day4value->room_no ;?>
                                                <br/>
                                                <?php 
                                                echo $day4value->subject_name.'( '.$day4value->subject_code.' )' ;
                                                ?>
                                                <br/>
                                                <?php 
                                                echo $day4value->name ;
                                                ?>
                                                      <br/>
                                                <a  href="{{URL::to('changeRoutine/'.$day4value->id)}}">Change Routine</a>

                                            </td>
                                   <?php } ?> 
                                </tr>
                                     <tr>
                                    <td><strong>WEDENSDAY</strong></td>
                                    <?php foreach ($day5 as $day5value) { ?>
                                        <td>
                                            <?php 
                                                echo date('h:i A', strtotime($day5value->from)).' - '.date('h:i A', strtotime($day5value->to)) ;
                                                ?>
                                                <br/>
                                                <?php echo 'Room '.$day5value->room_no ;?>
                                                <br/>
                                                <?php 
                                                echo $day5value->subject_name.'( '.$day5value->subject_code.' )' ;
                                                ?>
                                                <br/>
                                                <?php 
                                                echo $day5value->name ;
                                                ?>
                                                <br/>
                                                <a  href="{{URL::to('changeRoutine/'.$day5value->id)}}">Change Routine</a>

                                            </td>
                                   <?php } ?> 
                                </tr>
                                     <tr>
                                    <td><strong>THURSDAY</strong></td>
                                    <?php foreach ($day6 as $day6value) { ?>
                                        <td>
                                            <?php 
                                                echo date('h:i A', strtotime($day6value->from)).' - '.date('h:i A', strtotime($day6value->to)) ;
                                                ?>
                                                <br/>
                                                <?php echo 'Room '.$day6value->room_no ;?>
                                                <br/>
                                                <?php 
                                                echo $day6value->subject_name.'( '.$day6value->subject_code.' )' ;
                                                ?>
                                                <br/>
                                                <?php 
                                                echo $day6value->name ;
                                                ?>
                                                <br/>
                                                   <a  href="{{URL::to('changeRoutine/'.$day6value->id)}}">Change Routine</a>

                                            </td>
                                   <?php } ?> 
                                </tr>
                                                                     <tr>
                                    <td><strong>FRIDAY</strong></td>
                                    <?php foreach ($day7 as $day7value) { ?>
                                        <td>
                                            <?php 
                                                echo date('h:i A', strtotime($day7value->from)).' - '.date('h:i A', strtotime($day7value->to)) ;
                                                ?>
                                                <br/>
                                                  <?php echo 'Room '.$day7value->room_no ;?>
                                                <br/>
                                                <?php 
                                                echo $day7value->subject_name.'( '.$day7value->subject_code.' )' ;
                                                ?>
                                                <br/>
                                                <?php 
                                                echo $day7value->name ;
                                                ?>
                                                <br/>
                                                 <a  href="{{URL::to('changeRoutine/'.$day7value->id)}}">Change Routine</a>
                                            </td>
                                   <?php } ?> 
                                </tr>
                    </tbody>
                        </table>
                    </div>
                </div>
                <!--end::Section-->
            </div>
            <!--end::Form-->
        </div>
    </div>