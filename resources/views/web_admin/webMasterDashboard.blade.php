@extends('web_admin.webMasterAdmin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                        <!-- BEGIN: Subheader -->
<div class="m-content">
<div class="m-portlet ">
    <div class="m-portlet__body  m-portlet__body--no-padding">
        <div class="row m-row--no-padding m-row--col-separator-xl">
            <div class="col-md-12 col-lg-6 col-xl-3">
                <!--begin::Total Profit-->
                <div class="m-widget24">                     
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                            TOTAL ADMIN
                        </h4><br>
                        <span class="m-widget24__stats m--font-brand">
                            <?php //echo $admin ; ?>
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
                            TOTAL TEACHER
                        </h4><br>
                        
                        <span class="m-widget24__stats m--font-info">
                           <?php // echo //$teacher ;?>
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
                      TOTAL CRAFT
                        </h4><br>
                        <span class="m-widget24__stats m--font-danger">
                         <?php //echo //$craft ; ?>
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
                         <?php //echo $staff ; ?>
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
