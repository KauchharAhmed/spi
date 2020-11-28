@extends('web.masterWeb')
@section('content')
    <div class="col-md-9">
        <!-- Notice Section  -->
        <div class="notice p-md-4">
            <div class="row">

                <div class="col-md-12 notice_board">
                    <h4>Central Notice Board</h4>
                    <ul>
                        <?php
                            foreach ($last_10_notice as $last_10_value) {?>
                              <li><i class="fas fa-check" style="color: green;"></i> <?php echo $last_10_value->notice_title; ?><span style="float: right;"><?php echo date('d M Y', strtotime($last_10_value->notice_date)); ?></span>
                                <span><?php if ($last_10_value->image != '') {?>
                                <a  style="color:red" href="{{URL::to('notice_doc/'.$last_10_value->image)}}">DOWNLOAD</a>
                                <?php }?></span>
                            </li>
                        <?php }?>
                    </ul>
                    <a href="{{URL::to('notice')}}" title="View All" class="btn btn-success btn-sm float-right">View All <i class="fas fa-angle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- Notice Section  -->


        <!-- Latest News And Event Section -->
        <div class="latest_new mg-10">
            <div class="content_header bg-success">
                <h4>About of Sirajganj Polytechnic Institute</h4>
            </div>
            <div>
                <p class="text-justify" style="font-size:15px;color:#000000c9">Sirajgonj polytechnic institute is one of the  new Polytechnic Institute in Bangladesh.Its foundation stone  was established in 2000 by <strong>Mohammad&nbsp;Nasim. ,M P</strong> and Honorable &nbsp;Minister Ministry of Home,Postal and Telecommunication and Public works affairs.It started class in 2004 with only 40 students in the first year classes of Diploma-In-Engineering in one technology, named,Computer with the growing demands of mid-level technical manpower at home and abroad the Institute has since greatly expanded. The Institute now offers courses in five technologies Computer,Civil,Electronics ,RAC.and Electrical.</p>
            </div>

            <div class="row">
                <?php foreach ($get_section as $sectionValue) { ?>
                    <div class="box-content" style="margin-left: 18px;margin-top: 10px;">
                        <h5 style="color: #181818;font-weight: normal"><?php echo $sectionValue->w_section_name ; ?></h5>
                        <div class="row">
                            <div class="" style="float: left;">
                                <img src="{{URL::to('/'.$sectionValue->image)}}" alt="" style="width: 110px!important;height: 100px!important;float: left;">
                            </div>
                            <div class="" style="padding-left: 0px;margin-left: -34px;float: right;">
                                <ul class="non_style">
                                    <?php $sectionSubmenu = DB::table('w_section_submenu')->where('w_section_id',$sectionValue->id)->get(); foreach ($sectionSubmenu as $sectionSubmenuValue) {?>
                                        <li><a href="{{URL::to('sectionPageInfo/'.$sectionValue->id.'/'.$sectionSubmenuValue->id)}}" title="<?php echo $sectionSubmenuValue->submenu_name ; ?>"><?php echo $sectionSubmenuValue->submenu_name ; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
        <!-- End Latest News And Event -->

    </div>
    <!-- End Main Content  -->
@endsection
