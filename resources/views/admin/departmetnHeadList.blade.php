@extends('admin.masterSuperAdmin')
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    ALL DEPARTMENT HEAD LIST
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
        <div class="row">
            {!! Form::open(['url' =>'printDepHeadList','method' => 'post']) !!}
            <button class="btn btn-primary m-r-5 m-b-5" > <i class="fa fa-print" style="padding-right:10px"></i>PRINT</button>
             {!! Form::close() !!}
        </div>
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
                      <a href="{{URL::to('addDepartmentHeadForm')}}" class="btn btn-outline-brand active">
                        <span>
                           <i class="fa fa-plus-square" aria-hidden="true"></i>
                            <span>ADD NEW DEPARTMENT HEAD</span>
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
            <tr>    <th>SL NO</th>
                    <th>DEP NAME</th>
                    <th>NAME</th>
                    <th>TITLE</th>
                    <th>MOBILE</th>
                    <th>IMAGE</th>
                    <th>SIGNATURE</th>
                    <th>CHANGE</th>
                    <th>EDIT</th>    
            </tr>
            </thead>
            <tbody>
              <?php
              $i = 1 ; 
              foreach ($result as $value) { ?>
                <tr>
                <td><?php echo $i++ ; ?></td>
                <td><?php echo $value->departmentName ;?></td>
                <td><?php echo $value->name ;?></td>
                <td><?php 
                if($value->title == '1')
                {
                    echo "Department Head";
                }else{
                    echo "Acting Department Head";
                }
                ?></td>
                <td><?php echo $value->mobile ;?></td>
                <td><?php 
                if(!empty($value->image)){?>
                <img src="<?php echo $value->image; ?>" width="100" height="50">
               <?php }?>   
                </td>
                <td><?php 
                if(!empty($value->signature)){?>
                <img src="<?php echo $value->signature; ?>" width="100" height="50">
               <?php }?>   
                </td>
               <td><a class="btn btn-info" href="">CHANGE</a></td>
                <td><a class="btn btn-primary" href="">EDIT</a></td>
          
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