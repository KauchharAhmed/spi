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
       
            <td style="border: 0px; padding-left:180px; font-size: 16px;"><strong>
                
              <?php echo $setting->full_name ;  ;?>
              </strong>
              <br/>
             
              <!--<img width="150px;" style="padding-top:5px; padding-left:45px; height:80px" src="<?php //echo $setting->image; ?>" alt="Logo">
              <br/>-->
              <span style="font-size:14px; padding-left:80px;">
              <?php echo $setting->address ; ?>
            </span>
            <br/>
          
             
          
            </td> 
    </tr>
    <?php foreach ($data as $value1) {

    }?>

    <tr>
    <td style="border: 0px; font-size: 14px;  padding-left:260px;">
        <strong>STUDENT LIST</strong>
      </td>
     </tr> 
     <?php if($shift !=''){?>
      <tr>
        <td style="border: 0px; font-size: 14px;  padding-left:260px;">
        <strong>SHIFT : <?php echo $value1->shiftName ;  ?> </strong>
      </td>
    </tr>
        <?php }?>

    </tr>

       <?php if($semister !=''){?>
        <tr>
        <td style="border: 0px; font-size: 14px;  padding-left:260px;">
        <strong>SEMISTER : <?php echo $value1->semisterName ;  ?> </strong>
      </td>
    </tr>
        <?php }?>
        <tr>
        <td style="border: 0px; font-size: 14px;  padding-left:260px;">
        <strong>SECTION : <?php echo $value1->section_name ; ?></strong>
      </td>
  
    </tr>
                   
    </div>

    </div>

  </table>
  
    </div>
  </header>
  <br/><br/>

  <table width="100%" style="border: 1px solid black" class="align">
    <tr>
      <td class="align" style="border: 1px solid black"><strong>Sl No</strong></td>
      <td class="align" style="border: 1px solid black"><strong>Session</strong></td>
       <td class="align" style="border: 1px solid black"><strong>Name</strong></td>  
       <td class="align" style="border: 1px solid black"><strong>Roll</strong></td> 
        <td class="align" style="border: 1px solid black"><strong>Registration</strong></td>  
        <td class="align" style="border: 1px solid black"><strong>Pic</strong></td>  
        <td class="align" style="border: 1px solid black"><strong>Rfid Card Number</strong></td>
         <td class="align" style="border: 1px solid black"><strong>Signature</strong></td>
    </tr>

       <?php $i = 1 ; foreach ($data as $value) { ?>
        <tr>
        <td class="align" style="border: 1px solid black"><?php echo $i++ ; ?></td>
        <td class="align" style="border: 1px solid black"><?php echo $value->sessionName;?></td>
        <td class="align" style="border: 1px solid black"><?php echo $value->studentName;?></td>
        <td class="align" style="border: 1px solid black"><?php echo $value->roll;?></td>
        <td class="align" style="border: 1px solid black"><?php echo $value->registration;?></td>
        <td class="align" style="border: 1px solid black">
          <?php if(!empty($value->studentImage)){?>
          <img src="{{URL::to($value->studentImage) }}" width="100" height="50">
        <?php } ?>
        </td>
        <td class="align" style="border: 1px solid black"></td>
           <td class="align" style="border: 1px solid black"></td>
       </tr> 
     <?php } ?>
      </table>
  <script type="text/javascript">
  window.print();
  </script>
</body>
</html>     
      