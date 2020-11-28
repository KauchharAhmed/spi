@extends('admin.masterCraft')
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    YOUR LEAVE REQUEST HISTORY
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
                      <a href="{{URL::to('requestLeave')}}" class="btn btn-outline-brand active">
                        <span>
                           <i class="fa fa-plus-square" aria-hidden="true"></i>
                            <span>SEND NEW LEAVE REQUEST</span>
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
                    <th>LEAVE TYPE</th>
                    <th>APP TYPE</th>
                    <th>REQUEST DATE</th>
                    <th>REQUEST DAY</th>
                    <th>ACCEPTED DATE</th>
                    <th>ACCEPTED DAY</th>
                    <th>STATUS</th>
                    <th>VIEW APPLICATION</th>
                    <th>DELETE</th>      
            </tr>
            </thead>
            <tbody>
              <?php
               $i = 1 ; 
              foreach ($result as $value) { ?>
                <tr>
                <td><?php echo $i++ ; ?></td>
                <td>
                    <?php if($value->leave_type =='1'){
                       echo 'ৈনমিত্তিক->CL';
                    }elseif($value->leave_type =='2'){
                         echo ' অবকাশকালীন -> VL';
                    }elseif($value->leave_type =='3'){
                           echo 'মেডিক্যাল / অসুস্হতা -> ML';
                    }elseif($value->leave_type =='4'){
                           echo 'মাতৃত্বজনিত -> Mat L';
                    }elseif($value->leave_type =='5'){
                           echo 'অর্জিত -> EL';
                    }elseif($value->leave_type =='6'){
                           echo 'শ্রান্তি বিনোদনে -> RL';
                    }elseif($value->leave_type =='7'){
                       echo 'অনন্য -> OT';
                    }
                    ?>
                    </td>
                <td><?php 
                 if($value->application_type == '1'){
                    echo "Before Leave";
                 }else{
                    echo "After Leave";
                 }
                 ?>
                     
                 </td>

                <td><?php echo date ("d-m-Y", strtotime($value->request_from)) .' TO '.date ("d-m-Y", strtotime($value->request_to));?></td>
                <td><?php echo $value->day ;?></td>

                <td>
                    <?php if($value->status == '0'):?>
                    Pending
                    <?php elseif($value->status == '1'):?>
                        <?php echo date ("d-m-Y", strtotime($value->final_request_from)) .' TO '.date ("d-m-Y", strtotime($value->final_request_to));?>
                    <?php else:?>
                        reject
                    <?php endif;?>
                        
                    </td>
                <td>
                    <?php if($value->status == '0'):?>
                    Pending
                    <?php elseif($value->status == '1'):?>
                        <?php echo $value->final_day ;?>
                    <?php else:?>
                        reject
                    <?php endif;?>
                    </td>
                <td>
                    <?php if($value->status == '0'):?>
                     <span style="color:orange;"><strong>PENDING</strong></span>
                    <?php elseif($value->status == '1'):?>
                         <span style="color:green"><strong>ACCEPTED</strong></span>
                    <?php else:?>
                        <span style="color:red;"><strong>REJECTED</strong></span>
                    <?php endif;?>
                    
                </td>
                <td> <a class="btn btn-info" href="{{URL::to('viewCraftApplication/'.$value->id)}}">VIEW APPLICATION</a></td>
                <td> <?php if($value->status==0){ ?>
                    <a class="btn btn-danger" onclick="return confirm('Are You Sure You Want To Delete It ?')" href="{{URL::to('deleteCraftApplication/'.$value->id)}}">DELETE</a>
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
