@extends('admin.masterDepartmentHead')
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    ALL ROUTINE LIST
                </h3>
            </div>
        </div>
    </div>
    <div class="m-portlet__body">
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
        <!--begin: Search Form -->
        <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
            <div class="row align-items-center">
                <div class="col-xl-8 order-2 order-xl-1">
                    <div class="form-group m-form__group row align-items-center">
                        <div class="col-md-4">
                            <div class="m-input-icon m-input-icon--left">
                                <input type="text" class="form-control m-input m-input--solid" placeholder="Search..." id="generalSearch">
                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                    <span><i class="la la-search"></i></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                      <a href="{{URL::to('addRoutineForm')}}" class="btn btn-outline-brand active">
                        <span>
                           <i class="fa fa-plus-square" aria-hidden="true"></i>
                            <span>ADD NEW SUBJECT INTO ROUTINE</span>
                        </span>
                    </a>
                    <div class="m-separator m-separator--dashed d-xl-none"></div>
                </div>
            </div>
        </div>
        <!--end: Search Form -->
        <!--begin: Datatable -->
        <table class="m-datatable" id="html_table" width="100%">
            <thead>
            <tr>    
                    <th>SL NO</th>
                    <th>YEAR</th>
                    <th>SHIFT</th>
                    <th>SEMISTER</th>
                    <th>DAY</th>
                    <th>TIME</th>
                    <th>SUBJECT NAME</th>
                    <th>TEACHER </th>
                    <th>REMARKS</th>
                    <th>EDIT</th>
                    <th>DELETE</th>      
            </tr>
            </thead>
            <tbody>
              <?php 
              $i = 1 ; 
              foreach ($result as $value) { ?>
                <tr>
                <td><?php echo $i++ ; ?></td>
                <td><?php echo $value->year ;?></td>
                <td><?php echo $value->shiftName ;?></td>
                <td><?php echo $value->semisterName ;?></td>
                <td><?php 
                 if($value->day == '1')
                 {
                      echo "Saturday";
                 }elseif($value->day == '2'){
                      echo "Sunday";
                 }elseif($value->day == '3'){
                      echo "Monday";
                 }elseif($value->day == '4'){
                       echo "Tuesday";
                 }elseif($value->day == '5'){
                        echo "Wednesday";
                 }elseif($value->day == '6'){
                         echo "Thursday";
                 }elseif($value->day == '7'){
                          echo "Friday";
                 }
                 ?>
                     
                 </td>
                  <td><?php 
                  echo date('h:i A', strtotime($value->from)).' - '.date('h:i A', strtotime($value->to)) ;
                  ?></td>
                <td><?php echo $value->subject_name ;?></td>
                <td><?php echo $value->name ;?></td>
                <td><?php echo $value->remarks ;?></td>
                <td><a class="btn btn-primary" href="">EDIT</a></td>
                <td><a class="btn btn-danger" onclick="return confirm('Are You Sure You Want To Delete It ?')" href="">DELETE</a></td>
                
            </tr>
            <?php } ?>
            </tbody>
        </table>
        <!--end: Datatable -->
    </div>
</div>              
</div>
</div>
<!-- end:: Body -->            
@endsection