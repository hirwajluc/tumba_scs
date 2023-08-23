<?= $this->extend('layout/admin_layout');?>
<?= $this->section('page_css');?>
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/users/user-profile.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
<?= $this->endSection();?>
<?= $this->section('content');?>
<?php

use App\Models\Card;
if (isset($user)) {
    $usr = $user;
}
?>
<!--  BEGIN CONTENT AREA  -->
<div class="layout-px-spacing">

    <div class="row layout-spacing">

        <!-- Content -->
        <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

            <div class="user-profile layout-spacing">
                <div class="widget-content widget-content-area">
                    <div class="d-flex justify-content-between">
                        <h3 class="">Profile</h3>
                        <a href="<?=route_to('user.edit', $usr->usr_id)?>" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
                    </div>
                    <div class="text-center user-info">
                        <img src="<?=$usr->usr_picture;?>" alt="avatar" width="200" height="200">
                        <p class=""><?=$usr->tit_short.' '.$usr->usr_firstname.' '.$usr->usr_lastname;?></p>
                    </div>
                    <div class="user-info-list">

                        <div class="">
                            <ul class="contacts-block list-unstyled">
                                <li class="contacts-block__item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-slack"><path d="M14.5 10c-.83 0-1.5-.67-1.5-1.5v-5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5z"></path><path d="M20.5 10H19V8.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"></path><path d="M9.5 14c.83 0 1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5S8 21.33 8 20.5v-5c0-.83.67-1.5 1.5-1.5z"></path><path d="M3.5 14H5v1.5c0 .83-.67 1.5-1.5 1.5S2 16.33 2 15.5 2.67 14 3.5 14z"></path><path d="M14 14.5c0-.83.67-1.5 1.5-1.5h5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5h-5c-.83 0-1.5-.67-1.5-1.5z"></path><path d="M15.5 19H14v1.5c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5-.67-1.5-1.5-1.5z"></path><path d="M10 9.5C10 8.67 9.33 8 8.5 8h-5C2.67 8 2 8.67 2 9.5S2.67 11 3.5 11h5c.83 0 1.5-.67 1.5-1.5z"></path><path d="M8.5 5H10V3.5C10 2.67 9.33 2 8.5 2S7 2.67 7 3.5 7.67 5 8.5 5z"></path></svg><?=$usr->rol_name;?>
                                </li>
                            </ul>
                            <div class="text-center mb-5">
                                <!-- <button id="add-work-platforms" class="btn btn-primary">Save Change</button> -->
                                <a href="<?=route_to('user.list');?>" class="btn btn-success align-right"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg> Back to list</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

            <div class="skills layout-spacing ">
                <div class="widget-content widget-content-area">
                    <h3 class="">Other Information</h3>
                    <div class="row">
                        <div class="col-md-11 mx-auto">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location">Account Status</label>
                                        <input type="text" class="form-control mb-4" readonly id="location" value="<?=$usr->usr_status;?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Registered on</label>
                                        <input type="text" class="form-control mb-4" readonly id="phone" value="<?=date('d-m-Y', strtotime($usr->usr_created_at));?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country">Email</label>
                                        <input type="text" class="form-control mb-4" id="address" readonly value="<?=$usr->usr_email;?>" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Phone</label>
                                        <input type="text" class="form-control mb-4" id="address" readonly value="<?=$usr->usr_phone;?>" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Ation</label><br>
                                        <?php if($usr->usr_status == 'active'):?>
                                            <a href="<?=route_to('user.status',0, $usr->usr_id);?>" class="btn btn-danger desactivate confirm">Desactivate User</a>
                                        <?php else:?>
                                            <a href="<?=route_to('user.status',1, $usr->usr_id);?>" class="btn btn-info activate confirm">Re-Activate User</a>
                                        <?php endif;?>
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

<?= $this->section('page_scripts');?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="assets/js/scrollspyNav.js"></script>
<script>
    $('.widget-content .desactivate.confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: "You want to desactivate this user account!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Desactivate',
        padding: '2em'
        }).then(function(result) {
        if (result.value) {
            // swal(
            // 'Desactivated!',
            // 'The student card has been desactivated.',
            // 'success'
            // )
            window.location.href = url;
        }
        })
    });
    $('.widget-content .activate.confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: "You want to Re-Activate this user account!",
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Activate',
        padding: '2em'
        }).then(function(result) {
        if (result.value) {
            window.location.href = url;
        }
        })
    });
</script>
<?php 
$session= \Config\Services::session();
if($session->getFlashdata('success')):?>
    <script>

        const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            padding: '2em'
        });
        toast({
            type: 'success',
            title: '<?=$session->getFlashdata('success');?>',
            padding: '1em',
        })
    </script>
<?php endif;?>
<?= $this->endSection();?>
