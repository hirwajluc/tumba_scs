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
if (isset($student)) {
    $std = $student;
    $card = new Card();
    $card_data = $card->where('crd_student', $std->std_id)
                      ->join('scs_acad_year', 'acd_id = crd_acad_year')
                      ->first();
    $crd_status = ($card_data != null) ? ucfirst($card_data->crd_status): 'No card';
    $crd_number = ($card_data != null) ? $card_data->crd_tag_code : 'N/A';
    $crd_created_at = ($card_data != null) ? date('d-m-Y',strtotime($card_data->crd_created_at)) : 'N/A';
    $last_date = ($card_data != null) ? date('d-m-Y',$card_data->acd_ended_at) : 'N/A';
    $acd_year = ($card_data != null) ? $card_data->acd_year : 'N/A';
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
                        <a href="<?=route_to('student.edit', $std->std_id)?>" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
                    </div>
                    <div class="text-center user-info">
                        <img src="<?=$std->std_picture;?>" alt="avatar" width="200" height="200">
                        <p class=""><?=$std->std_firstname.' '.$std->std_lastname;?></p>
                    </div>
                    <div class="user-info-list">

                        <div class="">
                            <ul class="contacts-block list-unstyled">
                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg><?=$std->std_regno;?>
                                </li>
                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg><?=$std->opt_name;?>
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
                                        <input type="text" class="form-control mb-4" id="address" readonly value="<?=$crd_status;?>" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Card Number</label>
                                        <input type="text" class="form-control mb-4" id="address" readonly value="<?=$crd_number;?>" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location">Academic Year</label>
                                        <input type="text" class="form-control mb-4" readonly id="location" value="<?=$acd_year;?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Option</label>
                                        <input type="text" class="form-control mb-4" readonly id="phone" value="<?=$std->opt_code;?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Registered at</label>
                                        <input type="text" class="form-control mb-4" readonly id="date" value="<?= $crd_created_at;?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Expires at</label>
                                        <input type="text" class="form-control mb-4" readonly id="date" value="<?=$last_date;?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Ation</label><br>
                                        <?php if($crd_status == 'Active'):?>
                                            <a href="<?=route_to('card.update',0, $card_data->crd_id, $std->std_id);?>" class="btn btn-danger desactivate confirm">Desactivate card</a>
                                        <?php elseif($crd_status == 'Expired'):?>
                                            <a href="<?=route_to('card.update',2, $card_data->crd_id, $std->std_id);?>" class="btn btn-info upgrade confirm">Upgrade card</a>
                                        <?php elseif($crd_status == 'Not active'):?>
                                            <a href="<?=route_to('card.update',1, $card_data->crd_id, $std->std_id);?>" class="btn btn-info activate confirm">Re-Activate card</a>
                                        <?php else:?>
                                            <a href="<?=route_to('card.new');?>" class="btn btn-success">Assign card</a>
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
        text: "You want to desactivate this card!",
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
        text: "You want to Re-Activate this card!",
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
    $('.widget-content .upgrade.confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: "The academic year will be updated to the current academic year!",
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Upgrade',
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
