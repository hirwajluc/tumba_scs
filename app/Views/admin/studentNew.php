<?= $this->extend('layout/admin_layout');?>
<?= $this->section('page_css');?>

<!-- BEGIN PAGE LEVEL STYLES -->
<link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
<link href="plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- END PAGE LEVEL STYLES -->
<?= $this->endSection();?>
<!--  BEGIN CONTENT PART  -->
<?= $this->section('content');?>
<div class="layout-px-spacing">

    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-chart-three">
                <div class="widget-heading">
                    <div class="">
                        <h5 class="">New Student</h5>
                    </div>
                </div>

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="widget-content row">
                        <div class="col-xl-1"></div>

                        <div class="col-xl-5 invoice-address-company">

                            <div class="invoice-address-company-fields">

                                <div class="form-group row">
                                    <label for="client-name" class="col-sm-7 col-form-label col-form-label-sm">First Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" value="" name="firstname" class="form-control form-control-sm" value="" id="client-name" placeholder="First Name">

                                        <!-- @error('firstname')
                                            <span>
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror -->
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="client-name" class="col-sm-7 col-form-label col-form-label-sm">Last Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" value="" name="lastname" class="form-control form-control-sm" value="" id="client-name" placeholder="Last Name">

                                        <!-- @error('lastname')
                                            <span>
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror -->
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="company-email" class="col-sm-7 col-form-label col-form-label-sm">Reg Number</label>
                                    <div class="col-sm-12">
                                        <input type="text" value="" name="std_regno" class="form-control form-control-sm" value="" id="company-name" placeholder="Registration Number">

                                        <!-- @error('std_regno')
                                            <span>
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror -->
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-xl-5 invoice-address-company">

                            <div class="invoice-address-company-fields">

                                <div class="form-group row">
                                    <label for="company-name" class="col-sm-7 col-form-label col-form-label-sm">Department</label>
                                    <div class="col-sm-12">
                                        <select name="department" id="dept_sel" class="form-control form-control-sm">
                                            <option value="" selected disabled>Select Department</option>
                                            <option value="">ICT - Infornation and Communication Technology</option>
                                            <option value="">EEE - Electrical and Electronics Engineering</option>
                                        </select>

                                        <!-- @error('department')
                                            <span>
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror -->
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="client-name" class="col-sm-7 col-form-label col-form-label-sm">Option</label>
                                    <div class="col-sm-12">
                                        <select name="option" id="option" class="form-control form-control-sm">
                                            <option value="" selected disabled>Select Option</option>
                                            <option value="">IT - Information Technology</option>
                                            <option value="">ETT - Electronics and Telecommunication Technology</option>
                                            <option value="">RE - Renewable Energy</option>
                                        </select>
                                        <!-- @error('option')username
                                            <span>
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror -->
                                    </div>
                                </div>

                            </div>
                            <!-- <script type='text/javascript'>

                                $(document).ready(function(){

                                    // Department Change
                                    $('#dept_sel').change(function(){

                                        // Department id
                                        var id = $(this).val();

                                        // Empty the dropdown
                                        $('#option').find('option').not(':first').remove();

                                        // AJAX request
                                        $.ajax({
                                        url: 'getOptionById/'+id,
                                        type: 'get',
                                        dataType: 'json',
                                        success: function(response){

                                            var len = 0;
                                            if(response['data'] != null){
                                            len = response['data'].length;
                                            }

                                            if(len > 0){
                                            // Read data and create <option >
                                            for(var i=0; i<len; i++){

                                                var id = response['data'][i].id;
                                                var name = response['data'][i].opt_name;

                                                var option = "<option value='"+id+"'>"+name+"</option>";

                                                $("#option").append(option);
                                            }
                                            }

                                        }
                                    });
                                    });

                                });

                                </script> -->

                        </div>
                        <div class="col-xl-1"></div>
                        <div class="col-xl-1"></div>
                        <div id="fuSingleFile" class="col-lg-10 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Student Photo</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <div class="custom-file-container" data-upload-id="myFirstImage">
                                        <label>Select Student's Photo <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                        <label class="custom-file-container__custom-file" >
                                            <input type="file" value="{{ old('photo') }}" name="photo" class="custom-file-container__custom-file__custom-file-input">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        </label>
                                        <div class="custom-file-container__image-preview"></div>

                                        <!-- @error('photo')
                                            <span>
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror -->
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4"></div>
                        <div class="col-xl-6">
                        <button type="submit" class="btn btn-outline-primary mb-2">Submit Information</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>
<?= $this->endSection();?>
<?= $this->section('page_scripts');?>
<script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="plugins/highlight/highlight.pack.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="plugins/file-upload/file-upload-with-preview.min.js"></script>

    <script>
        //First upload
        var firstUpload = new FileUploadWithPreview('myFirstImage')
    </script>
<?= $this->endSection();?>