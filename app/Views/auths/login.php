<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?= (isset($pageTitle)) ? $pageTitle : 'Login | TumbaSCS'; ?> </title>
    <base href="/">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/authentication/form-1.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <!-- toastr -->
    <link href="plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
</head>
<body class="form">
    <?php
    $validation = \Config\Services::validation();
    ?>   

    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">Welcome to <br><a href="https://iprctumba.rp.ac.rw"><span class="brand-name">IPRC Tumba SCS</span></a></h1>
                        <form method="POST" action="<?=route_to('user.log');?>" class="text-left">
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="username" name="username" type="text" class="form-control" placeholder="Username / Email" value="<?= (isset($username)) ? $username : ''; ?>">  
                                    
                                </div>
                                

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password" value="<?= (isset($password)) ? $password : ''; ?>">
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper toggle-pass">
                                        <p class="d-inline-block">Show Password</p>
                                        <label class="switch s-primary">
                                            <input type="checkbox" id="toggle-password" class="d-none">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">Log In</button>
                                    </div>
                                    
                                </div>

                                <!-- <div class="field-wrapper text-center keep-logged-in">
                                    <div class="n-chk new-checkbox checkbox-outline-primary">
                                        <label class="new-control new-checkbox checkbox-outline-primary">
                                          <input type="checkbox" class="new-control-input">
                                          <span class="new-control-indicator"></span>Keep me logged in
                                        </label>
                                    </div>
                                </div> -->

                                <div class="field-wrapper">
                                    <a href="auth_pass_recovery.html" class="forgot-pass-link">Forgot Password?</a>
                                </div>

                            </div>
                        </form>  
                        <?php
                                if ($validation -> getError('username')) {
                                    ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?=$validation->getError('username');?></strong>
                                    </span>
                                    <?php
                                }
                                ?>                      
                        <p class="">Copyright © <?=date('Y');?> <a target="_blank" href="https://iprctumba.rp.ac.rw">IPRC Tumba</a>, All rights reserved.</p> 

                    </div>                    
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-image" style="background-image: url(assets/img/dark-icon.png); position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: #060818; background-position: center center; background-repeat: no-repeat; background-size: 75%; background-position-x:  center; background-position-y: center;">
            </div>
        </div>
    </div>

    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/authentication/form-1.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="assets/js/scrollspyNav.js"></script>
    <!-- toastr -->
    <script src="plugins/notification/snackbar/snackbar.min.js"></script>
    <!-- END PAGE LEVEL PLUGINS -->

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <script src="assets/js/components/notification/custom-snackbar.js"></script>
    <!--  END CUSTOM SCRIPTS FILE  -->
    <?php
    $session = session();
    if ($validation -> getError('username')) {
        ?>
        <script>
            Snackbar.show({
                //showAction: false,
                text: '<?=$validation -> getError('username');?>',
                actionText: 'X',
                actionTextColor: '#ffffff',
                backgroundColor: '#e7515a',
                duration: 3000
            });
        </script>
        <?php
    } else if ($validation -> getError('password')) {
        ?>
        <script>
            Snackbar.show({
                text: '<?=$validation -> getError('password');?>',
                actionText: 'X',
                actionTextColor: '#ffffff',
                backgroundColor: '#e7515a',
                duration: 3000
            });
        </script>
        <?php
    } else if($session->getFlashdata('fail')){
        ?>
        <script>
            Snackbar.show({
                text: '<?=$session->getFlashdata('fail');?>',
                actionText: 'X',
                actionTextColor: '#ffffff',
                backgroundColor: '#e7515a',
                duration: 3000
            });
        </script>
        <?php
    }
    ?>
</body>
</html>