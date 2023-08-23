<?= $this->extend('layout/admin_layout');?>
<?= $this->section('page_css');?>
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
<link href="plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL STYLES -->
<?= $this->endSection();?>

<!--  BEGIN CONTENT PART  -->
<?= $this->section('content');?>
<?php
    $validation = \Config\Services::validation();
?> 
<!--  BEGIN CONTENT PART  -->
<div class="layout-px-spacing">

    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-chart-three">
                <div class="widget-heading">
                    <div class="">
                        <h5 class="">New Option</h5>
                    </div>
                </div>

                <form action="<?=route_to('option.save');?>" method="POST" enctype="multipart/form-data">
                    <div class="widget-content row">
                        <div class="col-xl-1"></div>

                        <div class="col-xl-10 invoice-address-company">

                            <div class="invoice-address-company-fields">

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="client-name" class="col-sm-7 col-form-label col-form-label-sm">Option department</label>
                                        <select name="department" class="form-control form-control-sm" value="" id="client-name">
                                            <option disabled selected>-----Select department-----</option>
                                            <?php if ($dept):?>
                                                <?php foreach ($dept as $depts): ?>
                                                    <?php
                                                    if(isset($department)):
                                                        if($depts->dpt_id == $department):
                                                            ?>
                                                            <option value="<?=$depts->dpt_id;?>" selected><?= $depts->dpt_name;?></option>
                                                            <?php
                                                        else:
                                                            ?>
                                                            <option value="<?=$depts->dpt_id;?>"><?=$depts->dpt_name;?></option>
                                                            <?php
                                                        endif;
                                                    else:
                                                        ?>
                                                        <option value="<?=$depts->dpt_id;?>"><?=$depts->dpt_name;?></option>
                                                        <?php
                                                    endif;
                                                    ?>
                                                <?php endforeach; ?>
                                            <?php endif;?>
                                        </select>

                                        <?php if($validation->getError('department')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('department'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="client-name" class="col-sm-7 col-form-label col-form-label-sm">Option code</label>
                                        <input type="text" value="<?= (isset($opt_code)) ? $opt_code : ''; ?>" name="code" class="form-control form-control-sm" value="" id="client-name" placeholder="IT">

                                        <?php if($validation->getError('code')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('code'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="client-name" class="col-sm-7 col-form-label col-form-label-sm">Option name</label>
                                        <input type="text" value="<?= (isset($opt_name)) ? $opt_name : ''; ?>" name="name" class="form-control form-control-sm" value="" id="client-name" placeholder="Information Technology">

                                        <?php if($validation->getError('name')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('name'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <button type="submit" class="btn btn-outline-primary mb-2">Save Information</button>
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
            title: '<?=$session->getFlashdata('success')?> option is successfully saved',
            padding: '1em',
        })
            </script>
<?php elseif($session->getFlashdata('fail')):?>
    <script>
        const toast1 = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            padding: '2em'
        });
        toast1({
            type: 'error',
            title: '<?=$session->getFlashdata('fail')?>',
            padding: '1em',
        })
    </script>
<?php endif;?>
<?= $this->endSection();?>
