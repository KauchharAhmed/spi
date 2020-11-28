@extends('admin.masterAdmin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    EDIT TEACHERS
                </h3>
            </div>
        </div>
    </div>
    <!--<div class="m-portlet__body">-->
       <!--begin::Form--> 
    <div class="m-portlet__body">
        <!-- START SESSION MESSAGE -->
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
<!-- end sesssion message-->
    
    <div class="12">
    <div style="background-color: #e7f3fe;
    border-left: 6px solid #2196F3; margin-bottom: 15px;
    padding: 4px 12px;">
    <strong> Must Be Filled Input Box Which Symbol Is <span style="color:red ; padding-left:5px;" >*</span>
    </strong>                                  
    </div>
    </div>
                {!! Form::open(['url' =>'updateCraftInfo','method' => 'post','files' => true]) !!}
                <div class="row">
                <div class="col-md-6">
                        <div class="form-group m-form__group">
                        <label for="full_name">Department Name </label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" name="dep_name" required="">
                            <option value="<?php echo $row->dep_id;?>"><?php echo $row->departmentName;?></option>
                            <?php foreach ($result as $value) { ?>
                            <option value="<?php echo $value->id ; ?>"><?php echo $value->departmentName ; ?></option>
                            <?php } ?>
                        </select>  
                    </div>
                    <div class="form-group m-form__group">
                        <label for="full_name">Full Name </label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="text" class="form-control m-input m-input--square" name="full_name"  value="<?php echo $row->name;?>" required="">  
                    </div>
                          <div class="form-group m-form__group">
                        <label for="full_name">Short Name </label>
                        <input type="text" class="form-control m-input m-input--square" name="short_name" value="<?php echo $row->short_name;?>">  
                    </div>
                        <div class="form-group m-form__group">
                        <label for="full_name">Designation </label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="text" class="form-control m-input m-input--square" name="des" value="<?php echo $row->degi;?>" required="">  
                    </div>
                    <div class="form-group m-form__group">
                        <label for="phone_number">Mobile No (Login Id) <span style="color:red ; padding-left:30px;" >*</span></label>
                        <input type="number" class="form-control m-input m-input--square" name="mobile_number" required="" value="<?php echo $row->mobile;?>">
                    </div>
                        <div class="form-group m-form__group">
                        <label for="phone_number">Retype Mobile No <span style="color:red ; padding-left:30px;" >*</span></label>
                        <input type="number" class="form-control m-input m-input--square" name="retype_mobile_number" required="" value="<?php echo $row->mobile;?>">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="phone_number">Email</label><span style="color:red ; padding-left:30px;" >*</span>
                        <input type="email" class="form-control m-input m-input--square" name="email_address" required="" value="<?php echo $row->email;?>">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="phone_number">Blood Group</label><span style="color:red ; padding-left:30px;" >*</span>
                        <select class="form-control m-input m-input--square" name="blood_group">
                        <option value="<?php echo $row->blood_group;?>"><?php echo $row->blood_group;?></option>
                        <option value="A+">A+</option>
                        <option value="A−">A−</option>
                        <option value="B+">B+</option>
                        <option value="B−">B−</option>
                        <option value="O+">O+</option>
                        <option value="O−">O−</option>
                        <option value="AB+">AB+</option>
                        <option value="AB−">AB−</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group m-form__group">
                    <label for="full_name">Joining Date &nbsp; (yyyy-mm-dd)</label>
                        <input type="text" class="form-control" id="m_datepicker_1" placeholder="Select date"  name="join_date" data-date-format="yyyy-mm-dd" value="<?php echo $row->joinig_date;?>">
                    </div>

                        <div class="form-group m-form__group">
                        <label for="full_name">Previous Institute </label>
                        <input type="text" class="form-control m-input m-input--square" name="previous_institute" value="<?php echo $row->previous_institute;?>">  
                    </div>
                        <div class="form-group m-form__group">
                        <label for="full_name">Index No </label>
                        <input type="text" class="form-control m-input m-input--square" name="index_no"  value="<?php echo $row->index_no;?>">  
                    </div>

                    <div class="form-group m-form__group">
                        <label for="phone_number">Educational Information</label>
                        <textarea type="text" class="form-control m-input m-input--square" name="education_info"><?php echo $row->education_info;?></textarea>
                    </div>
                    <div class="form-group m-form__group">
                        <label for="phone_number">Address</label>
                        <textarea type="text" class="form-control m-input m-input--square" name="address"><?php echo $row->address;?></textarea>
                    </div>

                        <div class="form-group m-form__group">
                        <label for="phone_number">Current Image</label>
                        <?php if($row->image == ''):?>
                            <span>NOT ADDED IMAGE</span>
                        <?php else:?>
                        <img  width="100" height="100" src="{{URL::to($row->image)}}"  alt="" />
                    <?php endif;?>
                    </div>

                     <div class="form-group m-form__group">
                        <label for="phone_number">Upload Image <span style="color:green">(Must Be jpg, jpeg , png type And Max Size 100 KB)</span></label>
                        <input type="file" class="form-control m-input m-input--square" name="image">
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $row->id;?>">
                    <div class="form-group m-form__group">
                       <button type="submit" class="btn btn-primary">UPDATE</button>
                    </div>
                </div>

                {!! Form::close() !!}
         
        <!--end: Search Form -->
        <!--begin: Datatable -->
   <!-- </div>-->
</div>              
</div>
</div>
</div>
</div>
@endsection