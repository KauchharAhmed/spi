<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <style type="text/css">
  @media print {
  body {-webkit-print-color-adjust: exact;}
  } 
  .wrapper{
    width:100%;
    height:auto;
    !background:pink !important;
    margin:0px auto;
  }
  .row1{
    width:60%;
    height:auto;
    !background:orange !important;
    float:left;
  }
  .row2{
    width:30%;
    height:auto;
    !background:green !important;
    float:right;
  }
  .row3{
    width:100%;
    height:auto;
    !background:green !important;
    float:right;
  }
  table.cut,tr.cut,td.cut{
    border-collapse: collapse;
    border:1px solid #000;
    padding:5px;
    font-family:tahoma;
    font-size:14px;
  }
  .first_row{
    width:100%;
    height:140px;
    margin-top:15px;
  }
  .second_row{
    width:100%;
    height:500px;
    margin-top:0px;
  }
  
  table.roni, td.roni, th.roni {
      border: none;
    }

  .text_main{
  text-align:center;
  margin:0;
  padding:0;
  line-height:5px;
  }
  .sompa ul li{
      float:left;
    }
    .nila tr td{
      border-collapse: collapse;
      border:1px solid black;
      padding:5px;
      font-family:tahoma;
      font-size:14px;
    }
  div.fixed {
      position: fixed;
      bottom: 0;
      right: 0;
      width:100%;
    }
  table.align {
    border-collapse: collapse;
    text-align: center;
       }
  </style>
</head>

<body> 
  <header>
    <div class="text_main"> 
    <table width="100%">
        <tr style="border: 0px;">

             <td><img width="100;" style="padding-top:5px; padding-left:45px; height:60px" src="{{URL::to('images/spi_logo.jpg')}}" alt="Logo"></td>
             <td><strong><?php echo $setting->full_name ; ?></strong></td>
             <td></td>
              <td></td>

    </tr>
  </table>

  <table>
    <tr>
      <td style="padding-left: 210px;"><strong>Department:</strong> <?php echo $department->departmentName ; ?></td>
      <td style="padding-left: 50px;"><strong>Shift:</strong> <?php echo $shift->shiftName ;  ?></td>
      <td style="padding-left: 50px;"><strong>Semister:</strong> <?php echo $semister->semisterName ;  ?></td>
      <td style="padding-left: 50px;"><strong>Section:</strong> <?php echo $section->section_name ; ?></td>
    </tr>
    </table>


                   
    </div>

    </div>

  </table>
  
    </div>
  </header>
  <br/><br/>

  <table width="100%" style="border: 1px solid black" class="align">
    <tr>
      <td style="border: 1px solid black"><strong>SATURDAY</strong></td>
      <?php foreach ($day1 as $day1value) { ?>
      <td class="align" style="border: 1px solid black">
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
      </td>
      <?php } ?> 
          
    </tr>

    <tr>
      <td class="align" style="border: 1px solid black"><strong>SUNDAY</strong></td>
       <?php foreach ($day2 as $day2value) { ?>
    <td class="align" style="border: 1px solid black">
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

    </td>
    <?php } ?>
    </tr>

    <tr>
     <td class="align" style="border: 1px solid black"><strong>MONDAY</strong></td>
        <?php foreach ($day3 as $day3value) { ?>
     <td class="align" style="border: 1px solid black">
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

                                        </td>
                                   <?php } ?> 

  
    </tr>

    <tr>
   <td class="align" style="border: 1px solid black"><strong>TUESDAY</strong></td>
   <?php foreach ($day4 as $day4value) { ?>
   <td class="align" style="border: 1px solid black">
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
     
   </td>
   <?php } ?>

    </tr>
    <tr>
     <td class="align" style="border: 1px solid black"><strong>WEDENSDAY</strong></td>
     <?php foreach ($day5 as $day5value) { ?>
     <td class="align" style="border: 1px solid black">
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

                                        </td>
                                   <?php } ?> 
       
    <tr>
     <td class="align" style="border: 1px solid black"><strong>THURSDAY</strong></td>
     <?php foreach ($day6 as $day6value) { ?>
     <td class="align" style="border: 1px solid black">
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
     </td>
     <?php } ?>

    </tr>

      
      </table>
          <div class="fixed">
     
      <br/><br/><br/><br/><br/>
      <div style="border-bottom:1px solid #000;border-top:1px solid #000;width:100%;margin-top:4px;!border:1px solid #333;font-size:10px;">
         <center><span style="text-align:center;font-family:tahoma;">Software Developed By: ASIAN IT INC(www.asianitinc.com)</span></center>
      </div>
    </div>
    

  <script type="text/javascript">
  window.print();
  </script>
</body>
</html>     
      