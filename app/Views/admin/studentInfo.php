<?= $this->extend('layout/admin_layout');?>
<?= $this->section('page_css');?>
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="assets/css/users/user-profile.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
<?= $this->endSection();?>
<?= $this->section('content');?>
<?php
// $profile;
// $names;
// $reg;
// $dept;
// $date;
// $option;
?>
<!-- @foreach($student as $row)
    <?php
        // $profile = $row->std_photo;
        // $names = $row->std_firstname." ".$row->std_lastname;
        // $reg = $row->std_regno;
        // $dept = $row->created_at;
        // $date = $row->dpt_code;
        // $option = $row->opt_name;
     ?>
@endforeach -->
<!--  BEGIN CONTENT AREA  -->
<div class="layout-px-spacing">

    <div class="row layout-spacing">

        <!-- Content -->
        <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

            <div class="user-profile layout-spacing">
                <div class="widget-content widget-content-area">
                    <div class="d-flex justify-content-between">
                        <h3 class="">Profile</h3>
                        <a href="" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
                    </div>
                    <div class="text-center user-info">
                        <img src="{{asset($profile)}}" alt="avatar" width="200" height="150">
                        <p class="">ISHIMWE Pacifique</p>
                    </div>
                    <div class="user-info-list">

                        <div class="">
                            <ul class="contacts-block list-unstyled">
                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg>00RP00001
                                </li>
                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>ICT
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

            <div class="skills layout-spacing ">
                <div class="widget-content widget-content-area">
                    <h3 class="">Card Information</h3>
                    <div class="row">
                        <div class="col-md-11 mx-auto">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country">Card Status</label>
                                        <input type="text" class="form-control mb-4" id="address" readonly value="Not Active" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Card Number</label>
                                        <input type="text" class="form-control mb-4" id="address" readonly value="AFB865NG" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location">Department</label>
                                        <input type="text" class="form-control mb-4" readonly id="location" value="ICT">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Option</label>
                                        <input type="text" class="form-control mb-4" readonly id="phone" value="IT">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Registered at</label>
                                        <input type="text" class="form-control mb-4" readonly id="email" value="02-11-1111">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Ation</label>
                                        <form action="" method="POST">
                                            <input type="hidden" name="id" value="AFB865NG">
                                            <input type="hidden" name="status" value="1">
                                            <input type="submit" class="btn btn-success" value="Activate card" id="">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div> 
<!--  END CONTENT AREA  -->

<?= $this->endSection();?>
