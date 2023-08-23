<?php

use App\Models\Log;
use Carbon\Carbon;

$logObj = new Log();
$mandayIn=0;
$mandayOut=0;

$tuesdayIn=0;
$tuesdayOut=0;

$wednesdayIn=0;
$wednesdayOut=0;

$thursdayIn=0;
$thursdayOut=0;

$fridayIn=0;
$fridayOut=0;

$saturdayIn=0;
$saturdayOut=0;

$sundayIn=0;
$sundayOut=0;

$allLogs = $logObj ->where('log_created_at BETWEEN ' . "'" . Carbon::now()->startOfWeek() . "'" . ' AND ' . "'" . Carbon::now()->endOfWeek() . "'")
                    ->findAll();
foreach ($allLogs as $lg) {
    $d = Carbon::createFromFormat('Y-m-d', date('Y-m-d',strtotime($lg->log_created_at)))->format('l');
    if ($d == "Monday" && $lg->log_status == 'in') {
        $mandayIn+=1;
    }
    if ($d == "Monday" && $lg->log_status == 'out') {
        $mandayOut+=1;
    }

    if ($d == "Tuesday" && $lg->log_status == 'in') {
        $tuesdayIn+=1;
    }
    if ($d == "Tuesday" && $lg->log_status == 'out') {
        $tuesdayOut+=1;
    }

    if ($d == "Wednesday" && $lg->log_status == 'in') {
        $wednesdayIn+=1;
    }
    if ($d == "Wednesday" && $lg->log_status == 'out') {
        $wednesdayOut+=1;
    }

    if ($d == "Thursday" && $lg->log_status == 'in') {
        $thursdayIn+=1;
    }
    if ($d == "Thursday" && $lg->log_status == 'out') {
        $thursdayOut+=1;
    }

    if ($d == "Friday" && $lg->log_status == 'in') {
        $fridayIn+=1;
    }
    if ($d == "Friday" && $lg->log_status == 'out') {
        $fridayOut+=1;
    }

    if ($d == "Saturday" && $lg->log_status == 'in') {
        $saturdayIn+=1;
    }
    if ($d == "Saturday" && $lg->log_status == 'out') {
        $saturdayOut+=1;
    }

    if ($d == "Sunday" && $lg->log_status == 'in') {
        $sundayIn+=1;
    }
    if ($d == "Sunday" && $lg->log_status == 'out') {
        $sundayOut+=1;
    }
}
?>
<?= $this->extend('layout/admin_layout');?>
<?= $this->section('page_css');?>
    <link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
    <link href="plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="assets/css/widgets/modules-widgets.css">
<?= $this->endSection();?>
<?= $this->section('content');?>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-three">
                    <div class="widget-heading">
                        <div class="">
                            <h5 class="">Gate Entrance</h5>
                        </div>
                    </div>

                    <div class="widget-content">
                        <div id="logsChart"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-two">
                    <div class="widget-heading">
                        <h5 class="">Today's Logs</h5>
                    </div>
                    <div class="widget-content">
                        <div id="donatChart" class=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection();?>
<?= $this->section('page_scripts');?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {

            setInterval( function() {
                $("#page").load(location.href + " #page");

                if(document.getElementById("status").checked){
                    document.cookie = "js_var_value = " + 1
                }else{
                    document.cookie = "js_var_value = " + 0
                }
            }, 500);

        });
    </script>

    <script src="plugins/highlight/highlight.pack.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/scrollspyNav.js"></script>

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="plugins/apex/apexcharts.min.js"></script>
    <script src="assets/js/widgets/modules-widgets.js"></script>
    <script>
        try {


/*
    ==============================
    |    @Options Charts Script   |
    ==============================
*/


/*
    ===========================================
        Unique Month Report Visitors | Options |
    ===========================================
*/

  var d_1options1 = {
    chart: {
        height: 350,
        type: 'bar',
        toolbar: {
          show: false,
        }
    },
    colors: ['#5c1ac3', '#d6b007'],
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
        },
    },
    dataLabels: {
        enabled: false
    },
    legend: {
          position: 'bottom',
          horizontalAlign: 'center',
          fontSize: '14px',
          markers: {
            width: 10,
            height: 10,
          },
          itemMargin: {
            horizontal: 0,
            vertical: 8
          }
    },
    stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
    },
    series: [{
        name: 'Logged In',
        data: [<?=$mandayIn;?>,<?=$tuesdayIn;?>,<?=$wednesdayIn;?>,<?=$thursdayIn;?>,<?=$fridayIn;?>,<?=$saturdayIn;?>,<?=$sundayIn;?>]
    }, {
        name: 'Logged out',
        data: [<?=$mandayOut;?>,<?=$tuesdayOut;?>,<?=$wednesdayOut;?>,<?=$thursdayOut;?>,<?=$fridayOut;?>,<?=$saturdayOut;?>,<?=$sundayOut;?>]
    }],
    xaxis: {
        categories: ['Manday','TuesDay','Wenesday','Thersday','Firday','Sturday','Sunday'],
    },
    fill: {
      type: 'gradient',
      gradient: {
        shade: 'light',
        type: 'vertical',
        shadeIntensity: 0.1,
        inverseColors: false,
        opacityFrom: 1,
        opacityTo: 0.8,
        stops: [0, 100]
      }
    },
    tooltip: {
        y: {
            formatter: function (val) {
                return val
            }
        }
    }
  }

  //For Donut Chart
  <?php
  $staffLogs = 0;
  $studentLogs = 0;

  if (isset($logsData)) {
    foreach ($logsData as $log) {
        if ($log->crd_staff != null) {
            $staffLogs++;
        } elseif ($log->crd_student != null) {
            $studentLogs++;
        }
    }
  }
  ?>
  var options = {
        chart: {
            type: 'donut',
            width: 380
        },
        colors: ['#5c1ac3', '#e2a03f', '#e7515a', '#e2a03f'],
        dataLabels: {
          enabled: false
        },
        legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            fontSize: '14px',
            markers: {
              width: 10,
              height: 10,
            },
            itemMargin: {
              horizontal: 0,
              vertical: 8
            }
        },
        plotOptions: {
          pie: {
            donut: {
              size: '65%',
              background: 'transparent',
              labels: {
                show: true,
                name: {
                  show: true,
                  fontSize: '29px',
                  fontFamily: 'Nunito, sans-serif',
                  color: undefined,
                  offsetY: -10
                },
                value: {
                  show: true,
                  fontSize: '26px',
                  fontFamily: 'Nunito, sans-serif',
                  color: '20',
                  offsetY: 16,
                  formatter: function (val) {
                    return val
                  }
                },
                total: {
                  show: true,
                  showAlways: true,
                  label: 'Total',
                  color: '#888ea8',
                  formatter: function (w) {
                    return w.globals.seriesTotals.reduce( function(a, b) {
                      return a + b
                    }, 0)
                  }
                }
              }
            }
          }
        },
        stroke: {
          show: true,
          width: 25,
        },
        series: [<?=$studentLogs;?>, <?=$staffLogs;?>],
        labels: ['Students', 'Staffs'],
        responsive: [{
            breakpoint: 1599,
            options: {
                chart: {
                    width: '350px',
                    height: '400px'
                },
                legend: {
                    position: 'bottom'
                }
            },
    
            breakpoint: 1439,
            options: {
                chart: {
                    width: '250px',
                    height: '390px'
                },
                legend: {
                    position: 'bottom'
                },
                plotOptions: {
                  pie: {
                    donut: {
                      size: '65%',
                    }
                  }
                }
            },
        }]
  }

/*
    ===================================
        Unique Visitors | Script
    ===================================
*/

var d_1C_3 = new ApexCharts(
    document.querySelector("#logsChart"),
    d_1options1
);
d_1C_3.render();

/*
      =================================
          Sales By Category | Render
      =================================
  */
  var chart_2 = new ApexCharts(
      document.querySelector("#donatChart"),
      options
  );
  
  chart_2.render();

/*
  =============================================
      Perfect Scrollbar | Notifications
  =============================================
*/
const ps = new PerfectScrollbar(document.querySelector('.mt-container'));


} catch(e) {
// statements
console.log(e);
}

</script>
<?php
$session = \Config\Services::session();
if ($session->getFlashdata('success')) {
    ?>
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
            title: '<?=$session->getFlashdata("success");?>',
            padding: '2em',
        })
    </script>
    <?php
}
?>
<?= $this->endSection();?>