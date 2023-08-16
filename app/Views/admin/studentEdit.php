<?= $this->extend('layout/admin_layout');?>
<?= $this->section('page_css');?>
<!--  BEGIN CUSTOM STYLE FILE  -->
<link rel="stylesheet" type="text/css" href="plugins/dropify/dropify.min.css">
<link href="assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />
<link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
<script src="assets/jquery-3.6.3.min.js"></script>
<!--  END CUSTOM STYLE FILE  -->
<?= $this->endSection();?>
<!--  BEGIN CONTENT PART  -->
<?= $this->section('content');?>
<?php
//$std = $student;
$validation = \Config\Services::validation();
?>
<div class="layout-px-spacing">

    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="scrollspy-example row" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                    <form action="<?=route_to('student.update')?>" method="POST" enctype="multipart/form-data" id="general-info" class="section general-info">
                        <div class="info row">
                            <h6 class="">General Information</h6>
                            <div class="col-md-12 text-right mb-5">
                                <button id="add-work-platforms" class="btn btn-primary">Save Change</button>
                            </div>
                            <?php
                            if (isset($student)) {
                                $std = $student;
                            }
                            ?>
                            <div class="col-lg-12 mx-auto row">
                                <div class="col-xl-2 col-lg-12 col-md-4">
                                    <div class="upload mt-4 pr-md-4">
                                        <input type="file" id="input-file-max-fs" name="photo" class="dropify" accept="image/png, image/jpeg, image/jpg" data-default-file="<?=$std->std_picture;?>" data-max-file-size="2M" />
                                        <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i> Upload Picture</p>

                                        <?php if($validation->getError('photo')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('photo'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="text-center">
                                        <a href="<?=route_to('student.list');?>" class="btn btn-success align-right"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg> Back to list</a>
                                    </div>
                                </div>
                                <div class="col-xl-10 col-lg-12 col-md-10 mt-md-0 mt-2">
                                    <div class="form row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="hidden" name="std_id" value="<?= (isset($std_id)) ? $std_id : $std->std_id; ?>">
                                                <input type="text" class="form-control mb-4" name="firstname" id="firstname" value="<?= (isset($firstname)) ? $firstname : $std->std_firstname; ?>">
                                                <input type="hidden" class="form-control mb-4" name="id" id="fname" value="1">

                                                <?php if($validation->getError('firstname')): ?>
                                                    <span>
                                                        <strong class="text-danger">
                                                            <?=$validation->getError('firstname'); ?>
                                                        </strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control mb-4" name="lastname" id="lastname" value="<?= (isset($lastname)) ? $lastname : $std->std_lastname; ?>">
                                                
                                                <?php if($validation->getError('lastname')): ?>
                                                    <span>
                                                        <strong class="text-danger">
                                                            <?=$validation->getError('lastname'); ?>
                                                        </strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Reg Number</label>
                                                <input type="text" class="form-control mb-4" name="regno" id="regno" value="<?= (isset($regno)) ? $regno : $std->std_regno; ?>">

                                                <?php if($validation->getError('regno')): ?>
                                                    <span>
                                                        <strong class="text-danger">
                                                            <?=$validation->getError('regno'); ?>
                                                        </strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control mb-4" name="email" id="email" value="<?= (isset($email)) ? $email : $std->std_email; ?>">
                                                <input type="hidden" class="form-control mb-4" name="id" id="fname" value="1">

                                                <?php if($validation->getError('email')): ?>
                                                    <span>
                                                        <strong class="text-danger">
                                                            <?=$validation->getError('email'); ?>
                                                        </strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" class="form-control mb-4" name="phone" id="phone" value="<?= (isset($phone)) ? $phone : $std->std_phone; ?>">

                                                <?php if($validation->getError('phone')): ?>
                                                    <span>
                                                        <strong class="text-danger">
                                                            <?=$validation->getError('phone'); ?>
                                                        </strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select class="form-control mb-4" name="gender" id="gender">
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
                                                        if($key == $std->std_gender):
                                                            ?>
                                                            <option value="<?=$key;?>" selected><?=$name;?></option>
                                                            <?php
                                                        else:
                                                            ?>
                                                            <option value="<?=$key;?>"><?=$name;?></option>
                                                            <?php
                                                        endif;
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
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Department</label>
                                                <select class="form-control mb-4" name="department" id="dept_sel">
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
                                                            elseif($depts->dpt_id == $std->dpt_id):
                                                                ?>
                                                                <option value="<?=$depts->dpt_id;?>" selected><?=$depts->dpt_name;?></option>
                                                                <?php
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
                                            <div class="form-group">
                                                <label>Option</label>
                                                <select class="form-control mb-4" name="option" id="option">
                                                <option disabled selected>Select Option</option>
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
                                                            elseif($opts->opt_id == $std->opt_id):
                                                                ?>
                                                                <option value="<?=$opts->opt_id;?>" selected><?=$opts->opt_name;?></option>
                                                                <?php
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
                                            <div class="form-group">
                                                <label>Level</label>
                                                <select class="form-control mb-4" name="level" id="level">
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
                                                    elseif($num == $std->std_level):
                                                        ?>
                                                        <option value="<?=$num;?>" selected><?=$name;?></option>
                                                        <?php
                                                    else:
                                                        ?>
                                                        <option value="<?=$num;?>"><?=$name;?></option>
                                                        <?php
                                                    endif;
                                                endforeach; ?>
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
<?= $this->endSection();?>

<!--  END CONTENT AREA  -->
<?= $this->section('page_scripts');?>
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->

    <script src="plugins/dropify/dropify.min.js"></script>
    <script src="plugins/blockui/jquery.blockUI.min.js"></script>
    <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
    <script src="assets/js/users/account-settings.js"></script>
    <!--  END CUSTOM SCRIPTS FILE  -->
    <script src="assets/js/scrollspyNav.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.bundle.min.js"></script>

    <script>
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

    $("#phone").inputmask({mask:"(999) 999-9999"});
    </script>
    
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