<?php
// $admin_id       = Session::get('admin_id');
// $type           = Session::get('type');
//        if($admin_id == null && $type == null){
//        return Redirect::to('/admin')->send();
//        exit();
//         }

//        if($admin_id == null && $type != '1'){
//        return Redirect::to('/admin')->send();
//        exit();
//         }
        
//         if($type != '1'){
//        return Redirect::to('/admin')->send();
//        exit();
//         }
        ?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Print Result</title>
	<style type="text/css">
		table.nila {
			border-collapse: collapse;
		}

		table.nila, td.nila, th.nila {
			border: 1px solid black;
			padding:3px;
		}

    .watermark{
      position: relative;
    }

    .watermark_content{
      position: absolute;
      top: 0;
    }

    .logo{
      width: 120px;
      float: left;
    }

    .address{
      padding-left: 30px;
      width: 400px;
      float: left;
      line-height: 4px;
    }

    .bd_logo{
      width: 120px;
      float: right;
    }
	</style>
</head>
<body style="font-family:arial;border: 3px solid black;height: 1000px;padding: 5px;">

     <div class="watermark">
      <img src="images/05cfe16f2a.jpg" style=" width: 100%;
    opacity: .1;padding-top: 400px;left: 50px;height: 350px;">
        <div class="watermark_content">

      <div class="compnayInfo" style="margin-bottom: 60px;">
        <div class="logo">
         <img src="{{URL::to('')}}/<?php echo $setting->image ; ?>" style="width: 100px;height: 100px">
        </div>
        <div class="address">
          <h3><?php echo $setting->full_name;?></h3>
          <strong><p><center><i>Diploma in Engineering</i></center></p></strong>
        </div>
        <div class="bd_logo">
          <?php if($student_info->studentImage != ''){?>
        <img style="border-radius: 80%" width="100" height="100" src="{{URL::to('')}}/<?php echo $student_info->studentImage; ?>">
        <?php } ?>
        </div>   
      </div>
      <br>
      <br>
      <center>

        <h4>  <span style="float: left; font-style: italic;">SL.<?php 
        // year-probidhan-dept-shift-semester-serial_no
        echo $row->markhist_no.'-'.$year.$probidhan_id.$dept.$shift.$semister.$row->serial_no ; ?></span><span style="margin-right:200px;font-family:arial;border:1px solid #000;padding-top:4px;padding-bottom:4px;padding-left:27px;padding-right:27px;">ACADEMIC TRANSCRIPT</span></h4></center>

      <div>
        <div style="float: left;">
          <table>
            <tr>
              <td style="padding: 3px;font-style: italic;">Exam Type</td>
              <td style="padding: 3px;font-style: italic;">:</td>
              <td style="padding: 3px;font-style: italic;font-weight: bold;" ><?php  
                //echo $exam_info->examination_name; ?> </td>
            </tr>
            <tr>
              <td style="padding: 3px;font-style: italic;">Academic Year</td>
              <td style="padding: 3px;font-style: italic;">:</td>
              <td style="padding: 3px;font-style: italic;" ><?php //echo $year;?></td>
            </tr>

            <tr>
              <td style="padding: 3px;font-style: italic;">Student Name</td>
              <td style="padding: 3px;font-style: italic;">:</td>
              <td style="font-weight: bold;padding: 3px;font-style: italic;"><?php //echo $data->studentName;?></td>
            </tr>

            <tr>
              <td style="padding: 3px;font-style: italic;">Class Name</td>
              <td style="padding: 3px;font-style: italic;">:</td>
              <td style="padding: 3px;font-style: italic;"><?php 
                //echo $class_name->className;?></td>
            </tr>

            <tr>
              <td style="padding: 3px;font-style: italic;">Section Name</td>
              <td style="padding: 3px;font-style: italic;">:</td>
              <td style="padding: 3px;font-style: italic;"><?php              
                     //echo $section_name->sectionName;?></td>
            </tr>

            <tr>
              <td style="padding: 3px;font-style: italic;">Roll No</td>
              <td style="padding: 3px;font-style: italic;">:</td>
              <td style="padding: 3px;font-style: italic;font-weight: bold;"><?php //echo $roll;?></td>
            </tr>
          </table>
        </div>
        <div style="float: right;margin-bottom: 20px!important;">
          <table class="col-xs-12 nila" style="font-size: 14px;width: 200px">
            <thead>
              <tr>
                <th class="nila" style="text-align: center;">Class Interval %</th>
                <th class="nila" style="text-align: center;">Letter Grade</th>
                <th class="nila" style="text-align: center;">Grade Point</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="nila" style="text-align: center;">80–100</td>
                <td class="nila" style="text-align: center;">A+</td>
                <td class="nila" style="text-align: center;">4.00</td>
              </tr>
              <tr>
                <td class="nila" style="text-align: center;">75–80</td>
                <td class="nila" style="text-align: center;">A</td>
                <td class="nila" style="text-align: center;">3.75</td>
              </tr>
              <tr>
                <td class="nila" style="text-align: center;">70-75</td>
                <td class="nila" style="text-align: center;">A-</td>
                <td class="nila" style="text-align: center;">3.50</td>
              </tr>
              <tr>
                <td class="nila" style="text-align: center;">65–70</td>
                <td class="nila" style="text-align: center;">B+</td>
                <td class="nila" style="text-align: center;">3.25</td>
              </tr>
              <tr>
                <td class="nila" style="text-align: center;">60–65</td>
                <td class="nila" style="text-align: center;">B</td>
                <td class="nila" style="text-align: center;">3.00</td>
              </tr>
              <tr>
                <td class="nila" style="text-align: center;">55–60</td>
                <td class="nila" style="text-align: center;">B-</td>
                <td class="nila" style="text-align: center;">2.75</td>
              </tr>
              <tr>
                <td class="nila" style="text-align: center;">50–55</td>
                <td class="nila" style="text-align: center;">C+</td>
                <td class="nila" style="text-align: center;">2.50</td>
              </tr>
                   <tr>
                <td class="nila" style="text-align: center;">45–50</td>
                <td class="nila" style="text-align: center;">C</td>
                <td class="nila" style="text-align: center;">2.25</td>
              </tr>
                <tr>
                <td class="nila" style="text-align: center;">40–45</td>
                <td class="nila" style="text-align: center;">D</td>
                <td class="nila" style="text-align: center;">2.00</td>
              </tr>
                <tr>
                <td class="nila" style="text-align: center;">Under 40.00</td>
                <td class="nila" style="text-align: center;">F</td>
                <td class="nila" style="text-align: center;">0.00</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>


 <div class="row">
<table width="100%" class="nila" style="font-size:14px;">
  <thead>
  <tr>
<td class="nila" style="text-align: center;text-transform: uppercase;font-weight: bold;">Sl</td>
<td class="nila" style="text-align: center;text-transform: uppercase;font-weight: bold;">Subject </td>
<td class="nila" style="text-align: center;text-transform: uppercase;font-weight: bold;">Code</td>
<td class="nila" style="text-align: center;text-transform: uppercase;font-weight: bold;">Credit</td>
<td class="nila" style="text-align: center;text-transform: uppercase;font-weight: bold;">Marks</td>
<td class="nila" style="text-align: center;text-transform: uppercase;font-weight: bold;">T.Marks</td>
<td class="nila" style="text-align: center;text-transform: uppercase;font-weight: bold;">P.Marks</td>
<td class="nila" style="text-align: center;text-transform: uppercase;font-weight: bold;">G.Marks</td>
<td class="nila" style="text-align: center;text-transform: uppercase;font-weight: bold;">G.T Marks</td>
<td class="nila" style="text-align: center;text-transform: uppercase;font-weight: bold;">G.P Marks</td>
<td class="nila" style="text-align: center;text-transform: uppercase;font-weight: bold;">G %</td>
<td class="nila" style="text-align: center;text-transform: uppercase;font-weight: bold;">G.T %</td>
<td class="nila" style="text-align: center;text-transform: uppercase;font-weight: bold;">G.P %</td>

<td class="nila" style="text-align: center;text-transform: uppercase;font-weight: bold;">GP</td>
<td class="nila" style="text-align: center;text-transform: uppercase;font-weight: bold;">GRADE</td>
<td class="nila" style="text-align: center;text-transform: uppercase;font-weight: bold;">GPA</td>
<td class="nila" style="text-align: center;text-transform: uppercase;font-weight: bold;">GRADE</td>
</tr>
</thead>
<tbody>

                           <?php

                           // grade calcularion
                           $total_GPA             = 0 ;
                           $total_creadit_of_exam = 0 ;

                           foreach ($result as $grade_calculation_value) {
                                    
                                     $total_creadit_of_exam  = $total_creadit_of_exam + $grade_calculation_value->cradit ;


                                      if($grade_calculation_value->subject_pass_fail_status == '2')
                                      {
                                        $gain_gpa_with_creadit = 0.00 * $grade_calculation_value->cradit ; 

                                      }else{
                                   if($grade_calculation_value->total_mark_percentage>=80.00 AND $grade_calculation_value->total_mark_percentage<=100.00 ){
                                        $gain_gpa_with_creadit= 4.00 * $grade_calculation_value->cradit ;
                                    }elseif($grade_calculation_value->total_mark_percentage>=75.00 AND $grade_calculation_value->total_mark_percentage<80.00){
                                         $gain_gpa_with_creadit= 3.75 * $grade_calculation_value->cradit;
                                    }elseif($grade_calculation_value->total_mark_percentage>=70.00 AND $grade_calculation_value->total_mark_percentage<75.00){
                                         $gain_gpa_with_creadit= 3.50 * $grade_calculation_value->cradit ;

                                    }elseif($grade_calculation_value->total_mark_percentage>=65.00 AND $grade_calculation_value->total_mark_percentage<70.00){
                                        $gain_gpa_with_creadit= 3.25 * $grade_calculation_value->cradit ;

                                    }elseif($grade_calculation_value->total_mark_percentage>=60.00 AND $grade_calculation_value->total_mark_percentage<65.00){
                                       $gain_gpa_with_creadit= 3.00 * $grade_calculation_value->cradit ;

                                    }elseif($grade_calculation_value->total_mark_percentage>=55.00 AND $grade_calculation_value->total_mark_percentage<60.00){
                                       $gain_gpa_with_creadit = 2.75 * $grade_calculation_value->cradit ;

                                    }elseif($grade_calculation_value->total_mark_percentage>=50.00 AND $grade_calculation_value->total_mark_percentage<55.00){
                                       $gain_gpa_with_creadit = 2.50 * $grade_calculation_value->cradit ;

                                    }elseif($grade_calculation_value->total_mark_percentage>=45.00 AND $grade_calculation_value->total_mark_percentage<50.00){
                                       $gain_gpa_with_creadit= 2.25 * $grade_calculation_value->cradit ;

                                    }elseif($grade_calculation_value->total_mark_percentage>=40.00 AND $grade_calculation_value->total_mark_percentage<45.00){
                                       $gain_gpa_with_creadit= 2.00 * $grade_calculation_value->cradit ;

                                    }else{
                                        $gain_gpa_with_creadit= 0.00 * $grade_calculation_value->cradit;
                                       }
                                     }
                                     $total_GPA = $total_GPA + $gain_gpa_with_creadit ;

                           }
                           $grade_point_avarage = $total_GPA / $total_creadit_of_exam ;

                           $i = 1;
                            foreach ($result as $value) {  ?>
                                            <tr> 
                                                <td class="nila" style="text-align: center;"><?php echo $i++?></td>
                                                <td class="nila" style="text-align: center;"><?php echo $value->subject_name ;?></td>
                                                <td class="nila" style="text-align: center;"><?php echo $value->subject_code ;?></td>  
                                                 <td class="nila" style="text-align: center;"><?php echo $value->cradit ;?></td>              

                                                 <td class="nila" style="text-align: center;"><?php echo $value->subject_total_marks ;?></td>
                                                  <td class="nila" style="text-align: center;"><?php echo $value->theroy_marks +  $value->continous_theory_marks ;?></td>
                                                   <td class="nila" style="text-align: center;"><?php echo $value->practical_marks +  $value->continous_practical_marks ;?></td>
                                                <td class="nila" style="text-align: center;"><?php echo $value->total_marks ;?></td>
                                                 <td class="nila" style="text-align: center;"><?php echo $value->total_theroy ;?></td>
                                                  <td class="nila" style="text-align: center;"><?php echo $value->total_practical ;?></td>
                                                   <td class="nila" style="text-align: center;"><?php echo $value->total_mark_percentage ;?></td>

                                                   <td class="nila" style="text-align: center;"><?php echo $value->total_theory_mark_percentage ;?></td>

                                                    <td class="nila" style="text-align: center;"><?php echo $value->total_practical_mark_percentage ;?></td>
                                                <td class="nila" style="text-align: center;">

                                  <?php
                                    if($value->subject_pass_fail_status == '2')
                                      {
                                        //failed
                                         echo  "0.00";

                                      }else{
                                   if($value->total_mark_percentage>=80.00 AND $value->total_mark_percentage<=100.00 ){
                                        $gpa= "4.00";
                                        echo $gpa;
                                    }elseif($value->total_mark_percentage>=75.00 AND $value->total_mark_percentage<80.00){
                                         $gpa= "3.75";
                                        echo $gpa;

                                    }elseif($value->total_mark_percentage>=70.00 AND $value->total_mark_percentage<75.00){
                                         $gpa= "3.50";
                                        echo $gpa;

                                    }elseif($value->total_mark_percentage>=65.00 AND $value->total_mark_percentage<70.00){
                                        $gpa= "3.25";
                                        echo $gpa;

                                    }elseif($value->total_mark_percentage>=60.00 AND $value->total_mark_percentage<65.00){
                                       $gpa= "3.00";
                                        echo $gpa;

                                    }elseif($value->total_mark_percentage>=55.00 AND $value->total_mark_percentage<60.00){
                                       $gpa= "2.75";
                                        echo $gpa;

                                    }elseif($value->total_mark_percentage>=50.00 AND $value->total_mark_percentage<55.00){
                                       $gpa= "2.50";
                                        echo $gpa;

                                    }elseif($value->total_mark_percentage>=45.00 AND $value->total_mark_percentage<50.00){
                                       $gpa= "2.25";
                                        echo $gpa;

                                    }elseif($value->total_mark_percentage>=40.00 AND $value->total_mark_percentage<45.00){
                                       $gpa= "2.00";
                                        echo $gpa;

                                    }else{
                                        $gpa= "0.00";
                                        echo  $gpa;
                                       }
                                     }
                                  ?> 
                                  </td>
                                    <td class="nila" style="text-align: center;">
                                      <?php if($value->subject_pass_fail_status == '2')
                                      {
                                        //failed
                                         echo  "F";

                                      }else{
                                   if($value->total_mark_percentage>=80.00 AND $value->total_mark_percentage<=100.00 ){
                                        echo "A+";
                                    }elseif($value->total_mark_percentage>=75.00 AND $value->total_mark_percentage<80.00){
                                          echo "A";

                                    }elseif($value->total_mark_percentage>=70.00 AND $value->total_mark_percentage<75.00){
                                          echo "A-";

                                    }elseif($value->total_mark_percentage>=65.00 AND $value->total_mark_percentage<70.00){
                                        echo "B+";

                                    }elseif($value->total_mark_percentage>=60.00 AND $value->total_mark_percentage<65.00){;
                                        echo "B";

                                    }elseif($value->total_mark_percentage>=55.00 AND $value->total_mark_percentage<60.00){
                                        echo "B-";

                                    }elseif($value->total_mark_percentage>=50.00 AND $value->total_mark_percentage<55.00){
                                        echo "C+";

                                    }elseif($value->total_mark_percentage>=45.00 AND $value->total_mark_percentage<50.00){
                                        echo "C";

                                    }elseif($value->total_mark_percentage>=40.00 AND $value->total_mark_percentage<45.00){
                                        echo "D";

                                    }else{
                                        echo "F";
                                       }
                                     }
                                     ?>
                                  </td>

                                  <td rowspan="<?php echo count($result);?>" class="nila" style="text-align: center;"><?php
                                  if($pass_fail_status == '2'){
                                    // failed
                                    echo '0.00' ;
                                  }else{
                                   echo number_format($grade_point_avarage,2) ; 
                                 }
                                ?></td>
                                  <td rowspan="<?php echo count($result);?>" class="nila" style="text-align: center;">
                                  <?php
                                  if($pass_fail_status == '2'){
                                    // failed
                                    echo 'F' ;
                                  }else{
                                    if($grade_point_avarage == 4.00){
                                      echo "A+";
                                    }elseif($grade_point_avarage >= 3.75 AND $grade_point_avarage < 4.00 ){
                                      echo "A" ;
                                    }elseif($grade_point_avarage >= 3.50 AND $grade_point_avarage < 3.75 ){
                                      echo "A-" ;
                                    }elseif($grade_point_avarage >= 3.25 AND $grade_point_avarage < 3.50 ){
                                      echo "B+" ;
                                    }elseif($grade_point_avarage >= 3.00 AND $grade_point_avarage < 3.25 ){
                                      echo "B" ;
                                    }elseif($grade_point_avarage >= 2.75 AND $grade_point_avarage < 3.00 ){
                                      echo "B-" ;
                                    }elseif($grade_point_avarage >= 2.50 AND $grade_point_avarage < 2.75 ){
                                      echo "C+" ;
                                    }elseif($grade_point_avarage >= 2.25 AND $grade_point_avarage < 2.50 ){
                                      echo "C" ;
                                    }elseif($grade_point_avarage >= 2.00 AND $grade_point_avarage < 2.25 ){
                                      echo "D" ;
                                    }elseif($grade_point_avarage >= 0.00 AND $grade_point_avarage < 2.00 ){
                                      echo "F" ;
                                    }
                                 }
                                ?>
                                  </td>
                                  </tr>  
                            <?php  } ?>

</tbody>
</table>
<div style="float: left;">
<div style="margin-left: 10px;">
<?php
              //$check_url = URL::to('marksheetVerify/'.$invoice_number);
           // $merit_for_barcode_show = $rank-1 ;
           
           // if($status == '1'){
           //  $gpa_for_barcode_show = Session::get('gpa');
           //    $status_is_barcode = "PASS";
           // }else{
           //  $gpa_for_barcode_show = 0.00;
           //  $status_is_barcode = "FAIL";
           // }
               // $barcode_info = $setting->school_name."\n".$data->studentName."\n".'Year: '.$year.' Class: '.$class_name->className.' Section: '.$section_name->sectionName."\n".'Group : '.$group_name->groupName.' Roll : '.$roll."\n".'Exam : '.$exam_info->examination_name.' Status :'.$status_is_barcode."\n".'Merit :'.$merit_for_barcode_show.' GPA '.$gpa_for_barcode_show;  
                ?>  
              
    </div>
  </div>

  <div style="float: right;display: block;overflow: hidden;">
    <!--<p><img src="images/sign.png" height="50" width="100" style="padding-left: 42px;"></p>-->
      <hr>
    <h4></h4>
  </div>
  </div>
  
  <!--<div class="footer" style="display: block;width: 100%;">
    <hr style="border: 1px solid #afa5a5;">
    <p style="text-align: center;color: #909494;font-size: 12px">Design And Developed By : ASIAN IT INC. Web: www.asianitinc.com</p>
  </div>-->
        </div>
     </div> 

	<script type="text/javascript">
	window.print();
	</script>
    </body>
</html>

   