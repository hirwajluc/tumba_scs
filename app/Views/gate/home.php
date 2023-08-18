<?= $this->extend('layout/gate_layout');?>
<?= $this->section('page_css');?>
    <link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
    <link href="plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="assets/css/widgets/modules-widgets.css">
<?= $this->endSection();?>
<?= $this->section('content');?>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">

            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-one">
                    <div class="widget-heading">
                        <h6 class="">Cards</h6>

                    </div>
                    <div class="w-chart">

                        <div class="w-chart-section total-visits-content">
                            <div class="w-detail">
                                <p class="w-title">Staff Cards</p>
                                <p class="w-stats">30</p>
                            </div>
                        </div>


                        <div class="w-chart-section paid-visits-content">
                            <div class="w-detail">
                                <p class="w-title">Students Cards</p>
                                <p class="w-stats">445</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-header">
                            <div class="w-info">
                                <h6 class="value">Staffs</h6>
                            </div>
                            <div class="task-action">
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="pendingTask" style="will-change: transform;">
                                        <a class="dropdown-item" href="javascript:void(0);">Add Staff</a>
                                        <a class="dropdown-item" href="javascript:void(0);">View List</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-content">

                            <div class="w-info">
                                <p class="value">50 <span>This Month</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg></p>
                            </div>
                            
                        </div>

                        <div class="w-progress-stats">                                            
                            <div class="progress">
                                <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <div class="">
                                <div class="w-icon">
                                    <p>75%</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-account-invoice-two">
                    <div class="widget-content">
                        <div class="account-box">
                            <div class="info">
                                <div class="inv-title">
                                    <h5 class="">Total Students</h5>
                                </div>
                                <div class="inv-balance-info">

                                    <p class="inv-balance">15</p>

                                </div>
                            </div>
                            <div class="acc-action">
                                <div class="">
                                    <a href="<?=route_to('student.new');?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></a>
                                </div>
                                <a href="<?=route_to('student.list');?>">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
        data: [15,11,7,35,40,20,20]
    }, {
        name: 'Logged out',
        data: [5,20,12,30,45,15,16]
    }],
    xaxis: {
        categories: ['Manday','TuesDay','wenesday','Thersday','Firday','Sturday','Sunday'],
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
        series: [420, 65],
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