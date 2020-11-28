@extends('admin.masterSuperAdmin')
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                   MANAGE STAFF TRANNING LIST
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
            <tr>    
                    <th>SL NO</th>
                    <th>STAFF TYPE</th>
                    <th>NAME</th>
                    <th>DEPT</th>
                    <th>DATE</th>
                    <th>DAY</th>
                    <th>DELETE</th>
       
            </tr>
            </thead>
            <tbody>
              <?php
               $i = 1 ; 
              foreach ($result as $value) { ?>
                <tr>
                <td><?php echo $i++ ; ?></td>
                <td><?php if($value->type == '2'){
                    echo "ADMIN";
                }elseif($value->type == '3'){
                    echo "TEACHER";
                }elseif($value->type == '4'){
                    echo "CRAFT";
                }elseif($value->type == '5'){
                  echo "OTHER STAFF";
                }  ?></td>
                <td><?php echo $value->name ; ?></td>
                <td><?php echo $value->departmentName ; ?></td>
                <td><?php echo date ("d-m-Y", strtotime($value->final_request_from)) .' TO '.date ("d-m-Y", strtotime($value->final_request_to));?></td>
                <td><?php echo $value->final_day ;?></td>
                <td><a class="btn btn-danger" onclick="return confirm('Are You Sure You Want To Delete It ?')" href="{{URL::to('deleteStaffTraning/'.$value->id)}}">DELETE</a></td>
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