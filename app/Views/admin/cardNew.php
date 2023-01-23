<?= $this->extend('layout/admin_layout');?>
<?= $this->section('page_css');?>
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
<link href="plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
<script src="assets/jquery-3.6.3.min.js"></script>
<!-- END PAGE LEVEL STYLES -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
        <script>
            $(document).ready(function () {

                setInterval( function() {
                    $("#number").load(location.href + " #number");
                }, 500);

            });
        </script>
<?= $this->endSection();?>
<!--  BEGIN CONTENT PART  -->
<?= $this->section('content');?>
<?php

use App\Models\User;

    $validation = \Config\Services::validation();
?> 
<div class="layout-px-spacing">

    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-chart-three">
                <div class="widget-heading">
                    <div class="">
                        <h5 class="">New Card</h5>
                        <h6 class="text-danger"><b> N.B:</b><u>Please, search student's information using his/her Registration Number.</u> </h6>
                    </div>
                    <div class="">
                        <a href="<?= route_to('card.swap');?>" class="btn btn-outline-success btn-rounded btn-download"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg></line></i> Swap Card</a>
                    </div>
                </div>

                <form action="<?= route_to('card.save');?>" method="post">
                <div class="widget-content row">
                    <div class="col-xl-1"></div>
                    <div class="avatar avatar-xl col-xl-11">
                        <img alt="avatar" src="assets/img/dark-icon.png" width="100" height="100" class="rounded-circle" />
                    </div>
                    <div class="col-xl-1"></div>
                        <div class="col-xl-4 invoice-address-company">

                            <div class="invoice-address-company-fields">

                                <div class="form-group row">
                                    <label for="company-email" class="col-sm-7 col-form-label col-form-label-sm">Reg Number</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="regno" required class="form-control form-control-sm" value="" id="id" placeholder="Registration Number">
                                        <input type="hidden" name="id" id="student" value="<?= (isset($id)) ? $id : ''; ?>">
                                        <?php if($validation->getError('regno')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('regno'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
                                        <?php if($validation->getError('id')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('id'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    
                                </div>

                                <div class="form-group row">
                                    <label for="company-name" class="col-sm-7 col-form-label col-form-label-sm">First Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="firstname" readonly required class="form-control form-control-sm" id="firstname" placeholder="">
                                        <?php if($validation->getError('firstname')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('firstname'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="client-name" class="col-sm-7 col-form-label col-form-label-sm">Last Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="lastname" readonly required class="form-control form-control-sm" id="lastname" placeholder="">
                                        <?php if($validation->getError('lastname')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('lastname'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-xl-6 invoice-address-company">

                            <div class="invoice-address-company-fields">
                                <div class="form-group row">
                                    
                                    
                                    <div class="col-sm-6" id="number">
                                        <label for="company-email" class="col-form-label col-form-label-sm" style="min-width: 250px;">Card Number  (<b class="text-warning">Tap Card</b>)</label>
                                        <?php
                                            $user = new User();
                                            $value = $user->getCardNumber(session()->get('userID'));
                                        ?>
                                        <input type="text" name="card" required class="form-control form-control-sm" value="<?= $value;?>" id="company-name" placeholder="Tap Card to get number" style="min-width: 250px;">
                                        <?php if($validation->getError('card')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('card'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="company-email" class="col-form-label col-form-label-sm">Academic Year</label>
                                        <?php
                                            // $result = App\Models\NewCard::all()->first();
                                            // $value="";
                                            // if ($result) {
                                            //     $value =$result->card_no;
                                            // }
                                        ?>
                                        <select name="ac_year" id="ac_year" class="form-control form-control-sm">
                                            <option value="" selected disabled>--Select Year--</option>
                                            <?php if (isset($acadYear)):?>
                                                <?php foreach ($acadYear as $acad): ?>
                                                    <?php
                                                    if(isset($ac_year)):
                                                        if($acad->acd_id == $ac_year):
                                                            ?>
                                                            <option value="<?=$acad->acd_id;?>" selected><?=$acad->acd_year;?></option>
                                                            <?php
                                                        else:
                                                            ?>
                                                            <option value="<?=$acad->acd_id;?>"><?=$acad->acd_year;?></option>
                                                            <?php
                                                        endif;
                                                    else:
                                                        ?>
                                                        <option value="<?=$acad->acd_id;?>"><?=$acad->acd_year;?></option>
                                                        <?php
                                                    endif;
                                                    ?>
                                                <?php endforeach; ?>
                                            <?php endif;?>
                                        </select>
                                        <?php if($validation->getError('ac_year')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('ac_year'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    
                                </div>

                                <div class="form-group row">
                                    <label for="company-email" class="col-sm-7 col-form-label col-form-label-sm">Department</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="department" readonly required class="form-control form-control-sm" value="" id="dept" placeholder="">

                                        <?php if($validation->getError('department')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('department'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    
                                </div>

                                <div class="form-group row">
                                    <label for="company-email" class="col-sm-7 col-form-label col-form-label-sm">Option</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="option" readonly required class="form-control form-control-sm" value="" id="opt">
                                        <?php if($validation->getError('option')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('option'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-xl-2 invoice-address-company">
                        </div>
                        <div class="col-xl-5 invoice-address-company">
                            <button type="submit" class="btn btn-secondary mb-4 mr-2">Save Information</button>
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
    <script src="assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="plugins/file-upload/file-upload-with-preview.min.js"></script>

    <script>
        //First upload
        var firstUpload = new FileUploadWithPreview('myFirstImage')
    </script>
    <script>
        $(document).on('change', '#id', function(e) {
        e.preventDefault();
        var pkid = $(this).val();
        $.ajax({
            type:'POST',
            url: "<?= route_to('student.json');?>",
            dataType: "json",
            data:{
            "_token": "<?= csrf_token() ?>",
            'regno': pkid
            },
            success: function(data){
            $('input#firstname').val(data.std_firstname);
            $('input#lastname').val(data.std_lastname);
            $('input#dept').val(data.dpt_name);
            $('input#opt').val(data.opt_name);
            $('input#student').val(data.std_id);

            }

        });
        });
    </script>
<?php $session= \Config\Services::session();?>
<?php if($session->getFlashdata('success')):?>
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
            title: '<?=$session->getFlashdata('success').' card is registered';?>',
            padding: '1em',
        })
    </script>
<?php elseif($session->getFlashdata('fail')):?>
    <script>

        const toast2 = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            padding: '2em'
        });
        toast2({
            type: 'error',
            title: '<?=$session->getFlashdata('fail')?>',
            padding: '1em',
        })
    </script>
<?php endif;?>
<?= $this->endSection();?>
