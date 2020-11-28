@extends('admin.masterTeacher')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">  
                      <!-- BEGIN: Subheader -->
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
<div class="m-content">
<div class="m-portlet ">
    <div class="m-portlet__body  m-portlet__body--no-padding" style="display: none;">
        <div class="row m-row--no-padding m-row--col-separator-xl">
            <div class="col-md-12 col-lg-6 col-xl-3">
                <!--begin::Total Profit-->
                <div class="m-widget24">                     
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                            TOTAL ADMIN
                        </h4><br>
                        <span class="m-widget24__stats m--font-brand">
                          hh
                        </span>     
                        <div class="m--space-10"></div>
                        <div class="progress m-progress--sm">
                            <div class="progress-bar m--bg-brand" role="progressbar" style="width: 78%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="m-widget24__change">
                           
                        </span>
                       
                    </div>                    
                </div>
                <!--end::Total Profit-->
            </div>
            <div class="col-md-12 col-lg-6 col-xl-3">
                <!--begin::New Feedbacks-->
                <div class="m-widget24">
                     <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                            hh
                        </h4><br>
                        
                        <span class="m-widget24__stats m--font-info">
                           gg
                        </span>     
                        <div class="m--space-10"></div>
                        <div class="progress m-progress--sm">
                            <div class="progress-bar m--bg-info" role="progressbar" style="width: 84%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="m-widget24__change">
                        
                        </span>
                        
                    </div>      
                </div>
                <!--end::New Feedbacks--> 
            </div>
            <div class="col-md-12 col-lg-6 col-xl-3">
                <!--begin::New Orders-->
                <div class="m-widget24">
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                    ggg
                        </h4><br>
                        <span class="m-widget24__stats m--font-danger">
                        hhhh
                        </span>     
                        <div class="m--space-10"></div>
                        <div class="progress m-progress--sm">
                            <div class="progress-bar m--bg-danger" role="progressbar" style="width: 69%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="m-widget24__number">

                        </span>
                    </div>      
                </div>
                <!--end::New Orders--> 
            </div>
            <div class="col-md-12 col-lg-6 col-xl-3">
                <!--begin::New Users-->
                <div class="m-widget24">
                     <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                        TOTAL STAFF
                        </h4><br>
                        <span class="m-widget24__stats m--font-success">
                        hjj
                        </span>     
                        <div class="m--space-10"></div>
                        <div class="progress m-progress--sm">
                            <div class="progress-bar m--bg-success" role="progressbar" style="width: 90%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                       
                        <span class="m-widget24__number">
                      
                        </span>
                    </div>      
                </div>
                <!--end::New Users--> 
            </div>
        </div>
    </div>
</div>

</div>

</div>
</div>
</div>

 
@endsection
