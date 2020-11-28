@extends('admin.masterSuperAdmin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    REPORT TEACHER TODAY ATTENDENT REPORT
                </h3>
            </div>
        </div>
    </div>
    <!--<div class="m-portlet__body">-->
       <!--begin::Form--> 
    <div class="m-portlet__body">
        <!-- START SESSION MESSAGE -->
    <?php if(Session::get('succes') != null) { ?>
   <div class="alert alert-info alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    </button>
  <strong><?php echo Session::get('succes') ;  ?></strong>
  <?php Session::put('succes',null) ;  ?>
</div>
<?php } ?>
<?php
if(Session::get('failed') != null) { ?>
 <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    </button>
 <strong><?php echo Session::get('failed') ; ?></strong>
 <?php echo Session::put('failed',null) ; ?>
</div>
<?php } ?>

  @if (count($errors) > 0)
    @foreach ($errors->all() as $error)      
 <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    </button>
  <strong>{{ $error }}</strong>
</div>
@endforeach
@endif

             <div class="row">
              <div class="col-md-12">
                <span style="color:green">Teacher Today Attendent Report</span>
              </div>
 
                </div>
            </div>
         
        <!--end: Search Form -->
        <!--begin: Datatable -->
   <!-- </div>-->
</div> 
<div class="m-portlet__body">
    <div class="m-portlet">
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section">
                    <div class="m-section__content">
                      <div class="row">

                          <a href="{{URL::to('printTeacherTodayAttendentReport')}}">
                            <button class="btn btn-primary m-r-5 m-b-5" > <i class="fa fa-print" style="padding-right:10px"></i>PRINT</button>
                          </a>
                          &nbsp; &nbsp; &nbsp;
                            <a href="{{URL::to('csvTeacherTodayAttendentReport')}}">
                            <button class="btn btn-success m-r-5 m-b-5" > <i class="fa fa-file-excel-o" style="padding-right:10px"></i>EXCEL(CSV)</button>
                          </a>

                          <div class="row table-responsive">
                      <div class="col-md-8">
                      </div> 
                      <div class="col-md-2">

                      </div>  
                    </div>
                        <div class="col-md-3"></div>
                            <div class="col-md-8"><strong style="font-size:20px;color: black;font-weight: bold">TEACHER TODAY CLASS ATTENDENT REPORT</strong></div>
                            <div class="col-md-1"></div> 

                    <table>
                      <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">DATE</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo date('d M Y',strtotime($today));?></td>
                      </tr>
                       <tr>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">DAY</td>
                        <td style="font-family: tahoma;font-size: 16px;color: black;padding: 5px 0px;">:</td>
                        <td style="font-family: tahoma;font-weight:bold;font-size: 16px;color: black;padding: 5px 5px 0px; "><?php echo date('l',strtotime($today));?></td>
                      </tr>
                    </table>


                      <!--begin: Search Form -->
                   <!--end: Search Form -->
                   <div class="container">
                    <table class="table table-bordered table-hover table-responsive" id="html_table">
                  <thead>
                    <tr>    
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SL NO</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>TEACHER NAME</strong></th>
                    <th style="font-size: 17px; background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>DEPT</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>DEG</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>MOBILE</strong></th>
                    <th style="font-size: 17px;background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>STATUS</strong></th>
                    
            </tr>
            </thead>
                               <tbody>
                                <?php $i = 1 ;
                                foreach ($result as $value) { ?>
                                 <tr>
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $i++ ; ?></td>
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->name ; ?></td>   
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->departmentName ; ?></td>    
                                    <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->degi ; ?></td> 
                                     <td style="font-size: 15px;color: black;text-align: center;"><?php echo $value->mobile ; ?></td>
                                    <td style="font-size: 15px;color: black;text-align: center;">
                                      <?php
                                       // check leave status
                                      $leave = DB::table('tbl_leave')
                                      ->where('user_id',$value->id)
                                      ->where('final_request_from', '<=', $today)
                                      ->where('final_request_to', '>=', $today)
                                      ->where('type_status', '0')
                                      ->count();
                                      $traning = DB::table('tbl_leave')
                                      ->where('user_id',$value->id)
                                      ->where('final_request_from', '<=', $today)
                                      ->where('final_request_to', '>=', $today)
                                      ->where('type_status', '1')
                                      ->count();
                                      // check present or absent
                                      $present        = DB::table('teacher_attendent')
                                      ->where('teacherId',$value->id)
                                      ->where('created_at',$today)
                                      ->groupBy('teacherId')
                                      ->get();
                                      $prsent_status =  count($present) ;

    //   $explode     = explode('-',$today);
    //   $from_year   = $explode[0];
    //   $get_current_day     = date("l",strtotime($today));
    //   $current_year = date('Y');
    //   $current_year = date('Y');
    //   if($get_current_day =='Saturday'){
    //   $current_day = 1 ;
    //   }
    // if($get_current_day =='Sunday'){
    //   $current_day = 2 ;
    // }
    // if($get_current_day =='Monday'){
    //   $current_day = 3 ;
    // }
    // if($get_current_day =='Tuesday'){
    //   $current_day = 4 ;
    // }
    // if($get_current_day =='Wednesday'){
    //   $current_day = 5 ;
    // }
    // if($get_current_day =='Thursday'){
    //   $current_day = 6 ;
    // }
    // if($get_current_day =='Friday'){
    //   $current_day = 7 ;
    // }
                                // $not_taken_class = DB::table('routine')
                                // ->join('semister', 'routine.semister_id', '=', 'semister.id')
                                // ->select('routine.*')
                                // ->where('routine.teacher_id',$value->id)
                                // ->where('routine.year', $from_year)
                                // ->where('semister.status',1)
                                // ->count();
                                // echo $not_taken_class ;
                               // $class_not_in_routine =  DB::table('routine')
                               //  ->join('semister', 'routine.semister_id', '=', 'semister.id')
                               //  ->select('routine.*')
                               //  ->where('routine.teacher_id',$value->id)
                               //  ->where('routine.year', $from_year)
                               //  ->where('routine.day', $current_day)
                               //  ->where('semister.status',1)
                               //  ->count();
                                    if($leave > 0):?>
                                       <span style="color:orange"> <?php echo "LEAVE";?>
                                       </span>
                                        <?php elseif($traning > 0):?>
                                            <span style="color:blue"> <?php echo "TRAINING";?>
                                       </span>
                                       
                                       <?php elseif($prsent_status > 0):?>
                                         <span style="color:green"> <?php echo "PRESENT";?>
                                         <?php else:?>
                                          <span style="color:red"> <?php echo "ABSENT";?>
                                     <?php endif;?>
                                   
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
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
