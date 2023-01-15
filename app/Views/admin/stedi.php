<?= $this->extend('layout/admin_layout');?>
<?= $this->section('page_css');?>
<!--  BEGIN CUSTOM STYLE FILE  -->
<link rel="stylesheet" type="text/css" href="plugins/dropify/dropify.min.css">
    <link href="assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
<?= $this->endSection();?>
<!--  BEGIN CONTENT PART  -->
<?= $this->section('content');?>
<!-- @foreach($students as $row)
    <?php
        // $id = $row->id;
        // $profile = $row->std_photo;
        // $fname = $row->std_firstname;
        // $lname = $row->std_lastname;
        // $reg = $row->std_regno;
        // $dept_id = $row->dptId;
        // $dept = $row->dpt_name;
        // $opt_id = $row->optId;
        // $opt = $row->opt_name;
     ?>
@endforeach -->
<div class="layout-px-spacing">

    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                        <form action="{{ route('student.editOp') }}" method="POST" enctype="multipart/form-data" id="general-info" class="section general-info">
                            <div class="info">
                                <h6 class="">General Information</h6>
                                <div class="row">
                                    <div class="col-md-12 text-right mb-5">
                                        <button id="add-work-platforms" class="btn btn-primary">Save Change</button>
                                    </div>
                                    <div class="col-lg-11 mx-auto">
                                        <div class="row">
                                            <div class="col-xl-3 col-lg-12 col-md-4">
                                                <div class="upload mt-4 pr-md-4">
                                                    <input type="file" id="input-file-max-fs" name="photo" class="dropify" data-default-file="assets/img/user_male_icon.png" data-max-file-size="2M" value="assets/img/user_female_icon.png" />
                                                    <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i> Upload Picture</p>
                                                    <!-- @error('photo')
                                                        <span>
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                                    @enderror -->
                                                </div>
                                            </div>
                                            <div class="col-xl-9 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                <div class="form">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>First Name</label>
                                                                <input type="text" class="form-control mb-4" name="fname" id="fname" value="ISHIMWE">
                                                                <input type="hidden" class="form-control mb-4" name="id" id="fname" value="1">
                                                                <!-- @error('fname')
                                                                    <span>
                                                                        <strong class="text-danger">{{ $message }}</strong>
                                                                    </span>
                                                                @enderror -->
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Last Name</label>
                                                                <input type="text" class="form-control mb-4" name="lname" id="lname" value="Eric">
                                                                <!-- @error('lname')
                                                                    <span>
                                                                        <strong class="text-danger">{{ $message }}</strong>
                                                                    </span>
                                                                @enderror -->
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>RegNo</label>
                                                                <input type="text" class="form-control mb-4" name="std_regno" id="regno" value="00RP00001">
                                                                <!-- @error('std_regno')
                                                                    <span>
                                                                        <strong class="text-danger">{{ $message }}</strong>
                                                                    </span>
                                                                @enderror -->
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Department</label>
                                                                <select class="form-control mb-4" name="department" id="dept">
                                                                    <option value="1" selected>Information and Communication Technology</option>
                                                                    <option value="2">Electrical and Electronics Engineering</option> 
                                                                </select>
                                                                <!-- @error('option')
                                                                    <span>
                                                                        <strong class="text-danger">{{ $message }}</strong>
                                                                    </span>
                                                                @enderror -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Option</label>
                                                        <select class="form-control mb-4" name="option" id="option">
                                                            <option value="1" selected>Information Technology</option>
                                                            <option value="2">Renewable Energy</option>
                                                        </select>
                                                        <!-- @error('department')
                                                            <span>
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                            </span>
                                                        @enderror -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection();?>

<!--  END CONTENT AREA  -->
<?= $this->section('page_scripts');?>
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->

    <script src="plugins/dropify/dropify.min.js"></script>
    <script src="plugins/blockui/jquery.blockUI.min.js"></script>
    <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
    <script src="assets/js/users/account-settings.js"></script>
    <!--  END CUSTOM SCRIPTS FILE  -->

    
<?= $this->endSection();?>