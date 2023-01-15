<?= $this->extend('layout/admin_layout');?>
<?= $this->section('page_css');?>

<!-- BEGIN PAGE LEVEL STYLES -->
<link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
<link href="plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
<script src="assets/jquery-3.6.3.min.js"></script>
<!-- END PAGE LEVEL STYLES -->
<?= $this->endSection();?>
<!--  BEGIN CONTENT PART  -->
<?= $this->section('content');?>
<?php
    $validation = \Config\Services::validation();
?> 
<div class="layout-px-spacing">

    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-chart-three">
                <div class="widget-heading">
                    <div class="">
                        <h5 class="">New Student</h5>
                    </div>
                </div>

                <form action="<?=route_to('student.save');?>" method="POST" enctype="multipart/form-data">
                    <div class="widget-content row">
                        <div class="col-xl-1"></div>

                        <div class="col-xl-5 invoice-address-company">

                            <div class="invoice-address-company-fields">

                                <div class="form-group row">
                                    <label for="client-name" class="col-sm-7 col-form-label col-form-label-sm">First Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="firstname" class="form-control form-control-sm" value="<?= (isset($firstname)) ? $firstname : ''; ?>" id="client-name" placeholder="First Name">

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
                                        <input type="text" name="lastname" class="form-control form-control-sm" value="<?= (isset($lastname)) ? $lastname : ''; ?>" id="client-name" placeholder="Last Name">

                                        <?php if($validation->getError('lastname')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('lastname'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="company-email" class="col-sm-7 col-form-label col-form-label-sm">Reg Number</label>
                                    <div class="col-sm-12">
                                        <input type="text" value="<?= (isset($regno)) ? $regno : ''; ?>" name="regno" class="form-control form-control-sm" id="company-name" placeholder="Registration Number">

                                        <?php if($validation->getError('regno')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('regno'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="company-email" class="col-sm-7 col-form-label col-form-label-sm">Email</label>
                                    <div class="col-sm-12">
                                        <input type="text" value="<?= (isset($email)) ? $email : ''; ?>" name="email" class="form-control form-control-sm" id="email" placeholder="test@example.com">

                                        <?php if($validation->getError('email')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('email'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone" class="col-sm-7 col-form-label col-form-label-sm">Phone</label>
                                    <div class="col-sm-12">
                                        <input type="text" value="<?= (isset($phone)) ? $phone : ''; ?>" name="phone" class="form-control form-control-sm" id="ph-number" placeholder="(07X) XXX-XXXX">

                                        <?php if($validation->getError('phone')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('phone'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
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
                                            <option disabled selected>-----Select department-----</option>
                                            <?php if (isset($dept)):?>
                                                <?php foreach ($dept as $depts): ?>
                                                    <?php
                                                    if(isset($department)):
                                                        if($depts->dpt_id == $department):
                                                            ?>
                                                            <option value="<?=$depts->dpt_id;?>" selected><?=$depts->dpt_name;?></option>
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
                                </div>

                                <div class="form-group row">
                                    <label for="client-name" class="col-sm-7 col-form-label col-form-label-sm">Option</label>
                                    <div class="col-sm-12">
                                        <select name="option" id="option" class="form-control form-control-sm">
                                            <option value="" selected disabled>Select Option</option>
                                            <?php if (isset($opt)):?>
                                                <?php foreach ($opt as $opts): ?>
                                                    <?php
                                                    if(isset($option)):
                                                        if($opts->opt_id == $option):
                                                            ?>
                                                            <option value="<?=$opts->opt_id;?>" selected><?=$opts->opt_name;?></option>
                                                            <?php
                                                        else:
                                                            ?>
                                                            <option value="<?=$opts->opt_id;?>"><?=$opts->opt_name;?></option>
                                                            <?php
                                                        endif;
                                                    else:
                                                        ?>
                                                        <option value="<?=$opts->opt_id;?>"><?=$opts->opt_name;?></option>
                                                        <?php
                                                    endif;
                                                    ?>
                                                <?php endforeach; ?>
                                            <?php endif;?>
                                        </select>
                                        <?php if($validation->getError('option')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('option'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="client-name" class="col-sm-7 col-form-label col-form-label-sm">Level</label>
                                    <div class="col-sm-12">
                                        <select name="level" id="level" class="form-control form-control-sm">
                                            <?php
                                            $levels = array(1 => 'Level 6 - Y1', 2 => 'Level 6 - Y2', 3 => 'Level 7 - Y3');
                                            ?>
                                            <option value="" selected disabled>Select Level</option>
                                            <?php foreach ($levels as $num => $name):
                                                if(isset($level)):
                                                    if($num == $level):
                                                        ?>
                                                        <option value="<?=$num;?>" selected><?=$name;?></option>
                                                        <?php
                                                    else:
                                                        ?>
                                                        <option value="<?=$num;?>"><?=$name;?></option>
                                                        <?php
                                                    endif;
                                                else:
                                                    ?>
                                                    <option value="<?=$num;?>"><?=$name;?></option>
                                                    <?php
                                                endif;
                                            endforeach; ?>
                                            <!-- <option value="1">Level 6 - Y1</option>
                                            <option value="2">Level 6 - Y2</option>
                                            <option value="3">Level 7 - Y3</option> -->
                                        </select>
                                        <?php if($validation->getError('level')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('level'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="client-name" class="col-sm-7 col-form-label col-form-label-sm">Gender</label>
                                    <div class="col-sm-12">
                                        <select name="gender" id="gender" class="form-control form-control-sm">
                                            <?php
                                            $genders = array('male' => 'Male', 'female' => 'Female');
                                            ?>
                                            <option value="" selected disabled>Select Gender</option>
                                            <?php foreach ($genders as $key => $name):
                                                if(isset($gender)):
                                                    if($key == $gender):
                                                        ?>
                                                        <option value="<?=$key;?>" selected><?=$name;?></option>
                                                        <?php
                                                    else:
                                                        ?>
                                                        <option value="<?=$key;?>"><?=$name;?></option>
                                                        <?php
                                                    endif;
                                                else:
                                                    ?>
                                                    <option value="<?=$key;?>"><?=$name;?></option>
                                                    <?php
                                                endif;
                                            endforeach; ?>
                                        </select>
                                        <?php if($validation->getError('gender')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('gender'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>
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

                                        <?php if($validation->getError('photo')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('photo'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
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
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.bundle.min.js"></script>
    <script src="plugins/file-upload/file-upload-with-preview.min.js"></script>

    <script>
        //First upload
        var firstUpload = new FileUploadWithPreview('myFirstImage')
    </script>
    <script>
    // Email

    $("#email").inputmask(
        {
            mask:"*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
            greedy:!1,onBeforePaste:function(m,a){return(m=m.toLowerCase()).replace("mailto:","")},
            definitions:{"*":
                {
                    validator:"[0-9A-Za-z!#$%&'*+/=?^_`{|}~-]",
                    cardinality:1,
                    casing:"lower"
                }
            }
        }
    );

    $("#ph-number").inputmask({mask:"(999) 999-9999"});
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
            title: '<?=$session->getFlashdata('success').' is registered';?>',
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
<script type='text/javascript'>

    $(document).ready(function(){

        // Department Change
        $('#dept_sel').change(function(){

            // Department id
            var id = $(this).val();

            // Empty the dropdown
            $('#option').find('option').not(':first').remove();

            // AJAX request
            $.ajax({
                url:"<?php echo base_url('/admin/optionJson'); ?>",
                method:"POST",
                data:{id:id},
                dataType:"JSON",
                success:function(data)
                {
                    var html = '<option selected disabled value="">--Select Option--</option>';

                    for(var count = 0; count < data.length; count++)
                    {

                        html += '<option value="'+data[count].opt_id+'">'+data[count].opt_name+'</option>';

                    }

                    $('#option').html(html);
                }
            });
        });

    });

</script>
<?= $this->endSection();?>