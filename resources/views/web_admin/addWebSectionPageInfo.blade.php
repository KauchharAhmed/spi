@extends('web_admin.webMasterAdmin')
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">                      
<div class="m-content">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    WEB SECTION PAGE INFO
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
        {!! Form::open(['url' =>'webSectionPageInfo','method' => 'post','files' => true]) !!}
            <div class="form-group m-form__group">
                <label for="full_name">Select Section</label><span style="color:red ; padding-left:30px;" >*</span>
                <select class="form-control m-input m-input--square" id="web_section_id" name="web_section_id" required="">
                    <option value="">Select</option>
                    <?php foreach ($result as $value) { ?>
                        <option value="<?php echo $value->id; ?>"><?php echo $value->w_section_name; ?></option>
                    <?php } ?>
                </select> 
            </div>

            <div class="form-group m-form__group">
                <label for="full_name">Select Section Submenu</label><span style="color:red ; padding-left:30px;" >*</span>
                <select class="form-control m-input m-input--square" id="section_submenu_id" name="section_submenu_id" required="">
 
                </select> 
            </div>

            <div class="form-group m-form__group">
                <label for="submenu_name">Page Title</label><span style="color:red ; padding-left:30px;" >*</span>
                <input type="text" class="form-control m-input m-input--square" name="page_title" required="">
            </div>

            <div class="form-group m-form__group">
                <label for="full_name"> Page Text Info</label>
               <textarea id="summernote" name="page_content"></textarea>
           </div>

            <div class="form-group m-form__group">
                <label for="phone_number">Upload File <span style="color:green">(Must Be pdf, docx,doc  And Max Size 2000 KB)</span></label>
                <input type="file" class="form-control m-input m-input--square" name="image">
            </div>


            <div class="form-group m-form__group">
               <button type="submit" class="btn btn-primary">ADD</button>
            </div>
        </div>
        {!! Form::close() !!}
 
   <!-- </div>-->
</div>              
</div>
</div>
</div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Write Page Info Here',
            tabsize: 2,
            height: 250
        });
    });

    $("#web_section_id").change(function(e){
        e.preventDefault();
        var web_section_id = $(this).val();

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            'url':"{{ url('/getWebSectionSubmenu') }}",
            'type':'post',
            'dataType':'text',
            data:{  
            web_section_id:web_section_id 
            },
            success:function(data)
            {
              $('#section_submenu_id').html(data);
            }
        });
    })

</script>
@endsection