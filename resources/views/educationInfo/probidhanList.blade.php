@extends('admin.masterAdmin')
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    PROBIDHAN LIST
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
                      <a href="{{URL::to('addNewProbidhanForm')}}" class="btn btn-outline-brand active">
                        <span>
                           <i class="fa fa-plus-square" aria-hidden="true"></i>
                            <span>ADD NEW PROBIDHAN</span>
                        </span>
                    </a>
                    <div class="m-separator m-separator--dashed d-xl-none"></div>
                </div>
            </div>
        </div>
        <!--end: Search Form -->
        <!--begin: Datatable -->
        <table class="m-datatable" id="html_table" width="100%" style="text-transform: uppercase;">
            <thead>
            <tr>    
                    <th>SL NO</th>
                    <th>PROBIDHAN NAME</th>
                    <th>MID TEARM PERCENTAGE (From Theory Continious)</th>
                    <th>Pass Marks Percentage %</th>
                    <th>Dropout Subject</th>
                    <th>RESULT PASS/ FAIL STATUS</th> 
                    <th>Internal Result Semester</th>
                    <th>REMARKS</th> 
                    <th>PRINT</th> 
            </tr>
            </thead>
            <tbody>
              <?php
              $i = 1 ; 
              foreach ($result as $value) { ?>
                <tr>
                <td><?php echo $i++ ; ?></td>
                <td><?php echo $value->probidhan_name ;?></td>
                <td><?php echo number_format($value->mid_tearm_percentage,2).' %'; ?></td>
                <td><?php echo number_format($value->pass_marks_percentage,2).' %'; ?></td>
                <td><?php echo $value->dropout_subject; ?></td>
                <td><?php if($value->pass_fail_status== '1'):?>
                    <span style="color: blue;">Continious And Final Marks Together (TC + TF + PC + PF)</span>
                     <?php elseif($value->pass_fail_status== '2'):?>
                    <span style="color: green;">Individualy Therory And Practical Marks ({ TC + TF } ,  { PC + PF })</span>
                <?php else:?>
                    <span style="color:orange">Individualy Continious Theory And Practical And Final Therory And Practical Marks ( { TC } , { TF } ,  { PC } , { PF })</span>
                    <?php endif;?>
                </td>
                <td><?php
                $semister_query = DB::table('tbl_probidhan_semister')->where('probidhan_id',$value->id)->get();
                foreach ($semister_query as $semister_value_is) {
                    $semister_info_query = DB::table('semister')->where('id',$semister_value_is->semister_id)->first();
                    echo $semister_info_query->semisterName.' , ' ;
                }
                ?></td>
                <td><?php echo $value->remarks ;?></td>
                <td><a class="btn btn-primary" href="">PRINT</a></td>  
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