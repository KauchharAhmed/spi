@extends('admin.masterSuperAdmin')
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    ALL DEPARTMENT REG STUDENT LIST
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
            </div>
        </div>
        <!--end: Search Form -->
        <!--begin: Datatable -->
        <table class="m-datatable" id="html_table" width="100%">
            <thead>
            <tr>    <th>SL NO</th>
                    <th>SESSION</th>
                    <th>DEP NAME</th>
                    <th>SEMESTER</th>
                    <th>SHIFT</th>
                    <th>SECTION</th>
                    <th>NAME</th>
                    <th>FATHER NAME</th>
                    <th>ROLL</th>
                    <th>REGISTRATION</th>
                    <th>MOBILE</th>
                    <th>IMAGE</th>     
            </tr>
            </thead>
            <tbody>
              <?php
              $i = 1 ; 
              foreach ($result as $value) { ?>
                <tr>
                <td><?php echo $i++ ; ?></td>
                <td><?php echo $value->sessionName ;?></td>
                <td><?php echo $value->departmentName ;?></td>
                <td><?php echo $value->semisterName ;?></td>
                <td><?php echo $value->shiftName ;?></td>
                <td><?php echo $value->section_name ;?></td>
                <td><?php echo $value->studentName ;?></td>
                <td><?php echo $value->fatherName ;?></td>
                <td><?php echo $value->roll ;?></td>
                <td><?php echo $value->registration ;?></td>
                <td><?php echo $value->studentMobile ;?></td>
                <td><?php 
                if(!empty($value->studentImage)){?>
                <img src="<?php echo $value->studentImage; ?>" width="100" height="50">
               <?php }?>   
                </td>
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