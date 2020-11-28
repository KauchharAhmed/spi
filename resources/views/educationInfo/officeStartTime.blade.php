@extends('admin.masterSuperAdmin')
@section('content')

<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                  OFFICE START TIME
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
                    
                    </div>
                </div>
                
            </div>
        </div>
        <!--end: Search Form -->
        <!--end: Datatable -->
                <table class="table table-bordered table-hover table-responsive" id="html_table">
                  <thead>
                    <tr>    
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>SHIFT</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>CURRENT OFFICE START TIME</strong></th>
                    <th style="background-color: #ad8fd0;text-align: center;color: white;font-weight: bold;font-family: monospace;"><strong>CHANGE TIME</strong></th>
                  </tr>
                  </thead>
                               <?php $i = 1 ; foreach ($result as $value) { ?>
                               <tbody>
                                 <tr>
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo $value->shiftName;?></td>  
                                    <td style="font-size: 20px;color: black;text-align: center;"><?php echo date('h:i:s a',strtotime($value->office_start));?></td> 
                                    <td style="font-size: 20px;color: black;text-align: center;">
                                      <a class="btn btn-primary" href="{{URL::to('editStartOfficeTime/'.$value->id)}}">CHANGE OFFICE TIME</a>
                                    </td>
                                </tr>
                            <?php } ?>        
                    </tbody>
                    </table>

    </div>
</div>              
</div>
</div>
<!-- end:: Body -->            
@endsection