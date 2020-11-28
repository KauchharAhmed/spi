@extends('admin.masterDepartmentHead')
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    ALL SMEISTER SUBJECT LIST
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
                      <a href="{{URL::to('addSubjectForm')}}" class="btn btn-outline-brand active">
                        <span>
                           <i class="fa fa-plus-square" aria-hidden="true"></i>
                            <span>ADD NEW SUBJECT</span>
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
                    <th>SEMISTER</th>
                    <th>SUBJECT NAME</th>
                    <th>SUBJECT CODE</th>
                    <th>TYPE</th>
                    <th>CREDIT</th>
                    <th>COT THEROY MARKS </th>
                    <th>FINAL THEROY MARKS</th>
                    <th>CONT PRACTICAL MARKS</th>
                    <th>FIANL PRACTICAL MARKS</th>
                    <th>TOTAL MARKS</th>
                    <th>REMARKS</th>
                    <th>EDIT</th>
                    <th>DELETE</th>      
            </tr>
            </thead>
            <tbody>
              <?php
              $i = 1 ; 
              foreach ($result as $value) {  ?>
                <tr>
                <td><?php echo $i++ ; ?></td>
                <td><?php echo $value->semisterName ;?></td>
                <td><?php echo $value->subject_name ;?></td>
                <td><?php echo $value->subject_code ;?></td>
                <td><?php if($value->subject_type == '1'){
                    echo "Theorotical";
                }elseif($value->subject_type == '2'){
                    echo "Practical";
                }else{
                    echo "Theorotical And Practical";
                }
                ?></td>
                <td><?php echo $value->cradit ;?></td>
                <td><?php echo $value->continous_theory_marks ;?></td>
                <td><?php echo $value->theroy_marks ;?></td>
                <td><?php  echo $value->continous_practical_marks ;?></td>
                <td><?php  echo $value->practical_marks ;?></td>
                <td><?php  echo $value->total_marks ;?></td>
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