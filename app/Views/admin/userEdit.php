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
                    <form action="<?=route_to('user.update')?>" method="POST" enctype="multipart/form-data" id="general-info" class="section general-info">
                        <div class="info row">
                            <h6 class="">General Information</h6>
                            <div class="col-md-12 text-right mb-5">
                                <button id="add-work-platforms" class="btn btn-primary">Save Change</button>
                            </div>
                            <?php
                            if (isset($user_data)) {
                                $usr = $user_data;
                            }
                            ?>
                            <div class="col-lg-12 mx-auto row">
                                <div class="col-xl-2 col-lg-12 col-md-4">
                                    <div class="upload mt-4 pr-md-4">
                                        <input type="file" id="input-file-max-fs" name="photo" class="dropify" accept="image/png, image/jpeg, image/jpg" data-default-file="<?=($usr->usr_picture == null) ? 'assets/img/user_'.$usr->usr_gender.'_icon.png' : $usr->usr_picture;?>" data-max-file-size="2M" />
                                        <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i> Upload Picture</p>

                                        <?php if($validation->getError('photo')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('photo'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-xl-10 col-lg-12 col-md-10 mt-md-0 mt-2">
                                    <div class="form row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <select class="form-control mb-4" name="title" id="title">
                                                <option disabled selected>Select Tile</option>
                                                    <?php if (isset($titles)):?>
                                                        <?php foreach ($titles as $tit): ?>
                                                            <?php
                                                            if(isset($title)):
                                                                if($tit->tit_id == $title):
                                                                    ?>
                                                                    <option value="<?=$tit->tit_id;?>" selected><?=$tit->tit_short;?></option>
                                                                    <?php
                                                                else:
                                                                    ?>
                                                                    <option value="<?=$tit->tit_id;?>"><?=$tit->tit_short;?></option>
                                                                    <?php
                                                                endif;
                                                            elseif($tit->tit_id == $usr->usr_title):
                                                                ?>
                                                                <option value="<?=$tit->tit_id;?>" selected><?=$tit->tit_short;?></option>
                                                                <?php
                                                            else:
                                                                ?>
                                                                <option value="<?=$tit->tit_id;?>"><?=$tit->tit_short;?></option>
                                                                <?php
                                                            endif;
                                                            ?>
                                                        <?php endforeach; ?>
                                                    <?php endif;?>
                                                </select>

                                                <?php if($validation->getError('title')): ?>
                                                    <span>
                                                        <strong class="text-danger">
                                                            <?=$validation->getError('title'); ?>
                                                        </strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group">
                                                <label>Role</label>
                                                <select class="form-control mb-4" name="role" id="role">
                                                    <option disabled selected>-----Select Role-----</option>
                                                    <?php if (isset($roles)):?>
                                                        <?php foreach ($roles as $rol): ?>
                                                            <?php
                                                            if(isset($role)):
                                                                if($rol->rol_id == $role):
                                                                    ?>
                                                                    <option value="<?=$rol->rol_id;?>" selected><?=ucfirst($rol->rol_name);?></option>
                                                                    <?php
                                                                else:
                                                                    ?>
                                                                    <option value="<?=$rol->rol_id;?>"><?=ucfirst($rol->rol_name);?></option>
                                                                    <?php
                                                                endif;
                                                            elseif($rol->rol_id == $usr->usr_role):
                                                                ?>
                                                                <option value="<?=$rol->rol_id;?>" selected><?=ucfirst($rol->rol_name);?></option>
                                                                <?php
                                                            else:
                                                                ?>
                                                                <option value="<?=$rol->rol_id;?>"><?=ucfirst($rol->rol_name);?></option>
                                                                <?php
                                                            endif;
                                                            ?>
                                                        <?php endforeach; ?>
                                                    <?php endif;?> 
                                                </select>

                                                <?php if($validation->getError('role')): ?>
                                                    <span>
                                                        <strong class="text-danger">
                                                            <?=$validation->getError('role'); ?>
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
                                                        if($key == $usr->usr_gender):
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
                                                <label>First Name</label>
                                                <input type="hidden" name="usr_id" value="<?= (isset($usr_id)) ? $usr_id : $usr->usr_id; ?>">
                                                <input type="text" class="form-control mb-4" name="firstname" id="firstname" value="<?= (isset($firstname)) ? $firstname : $usr->usr_firstname; ?>">

                                                <?php if($validation->getError('firstname')): ?>
                                                    <span>
                                                        <strong class="text-danger">
                                                            <?=$validation->getError('firstname'); ?>
                                                        </strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control mb-4" name="email" id="email" value="<?= (isset($email)) ? $email : $usr->usr_email; ?>">
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
                                                <label>Username</label>
                                                <input type="text" class="form-control mb-4" name="username" id="username" value="<?= (isset($username)) ? $username : $usr->usr_username; ?>">

                                                <?php if($validation->getError('username')): ?>
                                                    <span>
                                                        <strong class="text-danger">
                                                            <?=$validation->getError('username'); ?>
                                                        </strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control mb-4" name="lastname" id="lastname" value="<?= (isset($lastname)) ? $lastname : $usr->usr_lastname; ?>">
                                                
                                                <?php if($validation->getError('lastname')): ?>
                                                    <span>
                                                        <strong class="text-danger">
                                                            <?=$validation->getError('lastname'); ?>
                                                        </strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" class="form-control mb-4" name="phone" id="phone" value="<?= (isset($phone)) ? $phone : $usr->usr_phone; ?>">

                                                <?php if($validation->getError('phone')): ?>
                                                    <span>
                                                        <strong class="text-danger">
                                                            <?=$validation->getError('phone'); ?>
                                                        </strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group">
                                                <label>Password</label>
                                                <select class="form-control mb-4" name="password" id="password">
                                                <?php
                                                $decision = array(0 => 'Keep', 1 => 'Regenerate');
                                                ?>
                                                <?php foreach ($decision as $key => $name):
                                                    if(isset($password)):
                                                        if($key == $password):
                                                            ?>
                                                            <option value="<?=$key;?>" selected><?=$name;?></option>
                                                            <?php
                                                        else:
                                                            ?>
                                                            <option value="<?=$key;?>"><?=$name;?></option>
                                                            <?php
                                                        endif;
                                                    else:
                                                        if($key == 0):
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

                                                <?php if($validation->getError('password')): ?>
                                                    <span>
                                                        <strong class="text-danger">
                                                            <?=$validation->getError('password'); ?>
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