<?php

use App\Models\Card;
use App\Models\Log;
use App\Models\Reader;
use App\Models\Student;
use App\Models\TempCard;
use CodeIgniter\I18n\Time;

$this->extend('layout/gate_layout');
$this->section('page_css');?>

<link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
<script src="assets/jquery-3.6.3.min.js"></script>
<style>
#content.fullscreen {
    background: #f1f2f3;
    z-index: 9999;
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
}
#content {
    background: #f1f2f3;
    position: relative;
    width: 50%;
    flex-grow: 8;
    margin-top: 106px;
    margin-bottom: 0;
    margin-left: 212px;
    transition: .600s;
}

.switch.s-outline[class*="s-outline-"] .slider:before {
    bottom: 1px;
    left: 1px;
    border: 2px solid #e7515a;
    background-color: #e7515a;
    color: #e7515a;
    box-shadow: #e7515a; 
}
#fscreen svg:hover{
    width: 40px;
    height: 40px;
}

</style>
<?= $this->endSection();?>
<?= $this->section('content');?>
 <!--  BEGIN CONTENT AREA  -->
<div class="layout-top-spacing">
    <div class="row layout-spacing pr-4 mt-3">
        <div class="col-xl-2 col-lg-1 col-md-1 col-sm-12 layout-top-spacing">
            <span style="font-size: 25px" class="text-danger">CHECK-OUT</span >
        </div>
        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 layout-top-spacing">
            <label class="switch s-icons s-outline s-outline-success mr-2">
                <input type="checkbox" value="1" id="status">
                <span class="slider round"></span>
            </label>
        </div>
        <div class="col-xl-2 col-lg-1 col-md-1 col-sm-12 layout-top-spacing">
            <span style="font-size: 25px" class="text-success">CHECK-IN</span >
        </div>
        <div class="col-xl-7 col-lg-9 col-md-9 col-sm-12 layout-top-spacing text-right">
            <button style="background: transparent; border: 0px; background-color: transparent; box-shadow: transparent;" onclick="var el = document.getElementById('content'); el.requestFullscreen();" id="fscreen"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize" id="fullscreenIcon"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></button>
        </div>
    </div>
</div>
<div class="layout-px-spacing" id="page">

    <div class="row layout-spacing pt-2 pr-4 mt-3">

        <?php
        $reader = new Reader();
        $tmpCard = new TempCard();
        $card = new Card();
        $student = new Student();
        $readerData = $reader->where('rdr_user', session()->get('userID'))
                            ->first();
        $tempCardData = ($readerData != null) ? $tmpCard->where('tcd_reader', $readerData->rdr_id)->first() : null;
        if($tempCardData){
            $startTime = strtotime($tempCardData->tcd_updated_at);
            $nowTime = Time::now('Africa/Kigali');
            $finishTime = strtotime($nowTime->toDateTimeString());
            $diffTime = $finishTime-$startTime;

            //To stop displaying the student data after 5 seconds
            if($diffTime >= 15):
                $tmpCard->where('tcd_reader', $readerData->rdr_id)
                        ->delete();
            endif;

            $cardData = $card->where('crd_tag_code', $tempCardData->tcd_tag)
                            ->first();
            if ($cardData) {
                //check whether the card belongs to a student
                if ($cardData->crd_student != null) {
                    $std = $student->where('std_id', $cardData->crd_student)
                                    ->join('scs_options', 'opt_id = std_option')
                                    ->join('scs_departments', 'dpt_id = opt_department')
                                    ->first();
                    if ($std) {
                        ?>
                        <div class="col-xl-5 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

                            <div class="user-profile layout-spacing">
                                <div class="widget-content widget-content-area">
                                    <div class="d-flexjustify-content-between text-center">
                                        <h2 class="text-primary">Profile</h2>
                                    </div>
                                    <div class="text-center user-info w-img">
                                        <img src="<?=$std->std_picture;?>" alt="avatar" width="300" height="300" style="border-radius: 50%;">
                                        <h1 class=""><?=$std->std_lastname." ".$std->std_firstname;?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-7 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

                            <div class="skills layout-spacing ">
                                <div class="widget-content widget-content-area">
                                    <h1 class="text-primary">Card Information</h1>
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <h3>Department:</h3>
                                        </div>
                                        <div class="col-xl-4">
                                            <h3><?=$std->dpt_name;?></h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <h3>Option:</h3>
                                        </div>
                                        <div class="col-xl-8">
                                            <h3><?=$std->opt_name;?></h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <h3>Card Number:</h3>
                                        </div>
                                        <div class="col-xl-8">
                                            <h3><?=$cardData->crd_tag_code;?></h3>
                                            <input type="hidden" value="<?=$std->std_regno;?>" id="card">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="skills layout-spacing ">
                                <?php if($cardData->crd_status == 'active'):?>
                                    <div class="widget-content widget-content-area bg-success">
                                <?php elseif($cardData->crd_status == 'expired'):?>
                                <div class="widget-content widget-content-area bg-warning">
                                <?php elseif($cardData->crd_status == 'not active'):?>
                                <div class="widget-content widget-content-area bg-danger">
                                <?php else:?>
                                <div class="widget-content widget-content-area bg-info">
                                <?php endif;?>
                                    <h2 class="text-dark"><strong>Card Status</strong></h2><br><br>
                                    <div class="row">
                                        <div class="col-xl-12 text-center">
                                            <?php if($cardData->crd_status == 'active'):?>
                                                <?php
                                                $log = new Log();
                                                $logData = $log->where('log_card', $cardData->crd_id)->orderBy('log_id', 'DESC')->first();
                                                if ($logData) {
                                                    //check the last log time
                                                    $logTime = strtotime($logData->log_updated_at);
                                                    //$currTime = strtotime(date('Y-m-d H:i:s'));
                                                    $currTime = strtotime($nowTime->toDateTimeString());
                                                    $diff = $currTime - $logTime;
                                                    if ($diff > 15) {
                                                        $data = [
                                                            'log_gate_user' => session()->get('userID'), 
                                                            'log_card' => $cardData->crd_id, 
                                                            'log_acad_year' => $cardData->crd_acad_year, 
                                                            'log_status' => $_COOKIE['js_var_value']
                                                        ];
                                                        $log->insert($data);
                                                    }
                                                }else{
                                                    $data = [
                                                        'log_gate_user' => session()->get('userID'), 
                                                        'log_card' => $cardData->crd_id, 
                                                        'log_acad_year' => $cardData->crd_acad_year, 
                                                        'log_status' => $_COOKIE['js_var_value']
                                                    ];
                                                    $log->insert($data);
                                                }
                                                ?>
                                                <h1><?= ucfirst($cardData->crd_status);?></h1>
                                            <?php else:?>
                                                <h1><?= ucfirst($cardData->crd_status);?></h1>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } elseif ($cardData->crd_staff != null) {
                    # code...
                } else {

                }
            } else {
                ?>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">
                    <div class="skills layout-spacing ">
                        <div class="widget-content widget-content-area bg-warning">
                            <h1 class="text-center">Card Not Registered</h1><br>
                            <h1 class="text-center"><svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="red" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                                </svg></h1>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">
                <div class="skills layout-spacing ">
                    <div class="widget-content widget-content-area" style="background: transparent">
                        <h1 class="text-center">Tap Card To Check</h1><br>
                        <h1 class="text-center"><svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="green" class="bi bi-credit-card-fill" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1H0V4zm0 3v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7H0zm3 2h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1z"/>
                            </svg></h1>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<!--  END CONTENT AREA  -->
<!-- @endsection
@endif
@section('styles') -->
<?= $this->endSection();?>
<?= $this->section('page_scripts');?>
<script>
    $(document).ready(function () {

        setInterval( function() {
            $("#page").load(location.href + " #page");

            if(document.getElementById("status").checked){
                document.cookie = "js_var_value = " + "in"
            }else{
                document.cookie = "js_var_value = " + "out"
            }
        }, 1000);

    });
</script>

<script src="plugins/highlight/highlight.pack.js"></script>
<script src="assets/js/custom.js"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->
<script src="assets/js/scrollspyNav.js"></script>
<script>
    $('button').click(function(e) {
        $('#content').toggleClass('main-content fullscreen');
        if ($('#fullscreenIcon').hasClass("feather-maximize")) {
            $('#content').toggleClass('fullscreen');
            $(this).html("<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-minimize'><path d='M8 3v3a2 2 0 0 1-2 2H3m18 0h-3a2 2 0 0 1-2-2V3m0 18v-3a2 2 0 0 1 2-2h3M3 16h3a2 2 0 0 1 2 2v3'></path></svg>");
        } else {
            $('#content').toggleClass('fullscreen');
            $(this).html("<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-maximize'><path d='M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3'></path></svg>");
            document.exitFullscreen();
        }
    });
</script>
<?= $this->endSection();?>
