<?= $this->extend('layout/admin_layout');?>
<?= $this->section('page_css');?>
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
    <!-- <link rel="stylesheet" type="text/css" href="plugins/table/datatable/custom_dt_multiple_tables.css"> -->
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/tabs-accordian/custom-accordions.css" rel="stylesheet" type="text/css" />
    <script src="assets/jquery-3.6.3.min.js"></script>
    <style>
        .table-responsive > .table {
            background: transparent;
        }
    </style>
    <!-- END PAGE LEVEL STYLES -->
<?= $this->endSection();?>
<?= $this->section('content');?>
<?php
    $validation = \Config\Services::validation();
?> 
<!--  BEGIN CONTENT AREA  -->
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <div id="toggleAccordion">
                        <div class="card-header" id="headingOne1">
                            <section class="mb-0 mt-0">
                            <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionOne" aria-expanded="true" aria-controls="defaultAccordionOne">
                                <?php if (isset($errors)):?>
                                    <strong style="color: red;">Filter Failed <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg> </strong> 
                                <?php elseif(isset($filtered)):?>
                                    <strong style="color: blue;">Filter Applied <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg> </strong> 
                                <?php else:?>
                                    <strong>Filter Logs <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg> </strong>  
                                <?php endif;?>
                                
                                <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                            </div>
                            </section>
                        </div>
                        <div id="defaultAccordionOne" class="collapse" aria-labelledby="headingOne1" data-parent="#toggleAccordion">
                            <div class="card-body">
                            <form action="<?=route_to('stdlg.filter');?>" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <!-- <div class="form-group col-sm-3">
                                        <label for="company-name" class="col-form-label col-form-label-sm">Department</label>
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
                                    <div class="form-group col-sm-3">
                                        <label for="client-name" class="col-sm-7 col-form-label col-form-label-sm">Option</label>
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
                                    <div class="form-group col-sm-3">
                                        <label for="client-name" class="col-sm-7 col-form-label col-form-label-sm">Level</label>
                                        <select name="level" id="level" class="form-control form-control-sm">
                                            <?php
                                            $levels = array(1 => 'Level 6 - Y1', 2 => 'Level 6 - Y2', 3 => 'Level 7 - Y3');
                                            ?>
                                            <option value="0" selected>All Levels</option>
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
                                        </select>
                                        <?php if($validation->getError('level')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('level'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
                                    </div> -->
                                    <div class="form-group col-sm-3">
                                        <label for="client-name" class="col-form-label col-form-label-sm">Registration N<sup>o</sup> (Optional)</label>
                                        <input type="text" value="<?= (isset($regno)) ? $regno : ''; ?>" name="regno" class="form-control form-control-sm" id="company-name" placeholder="Registration Number">

                                        <?php if($validation->getError('regno')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('regno'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="client-name" class="col-form-label col-form-label-sm">From (Date)</label>
                                        <input type="date" value="<?= (isset($from_date)) ? $from_date : ''; ?>" name="from_date" class="form-control form-control-sm" id="company-name" max="<?= date('Y-m-d'); ?>">

                                        <?php if($validation->getError('from_date')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('from_date'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="client-name" class="col-form-label col-form-label-sm">To (Date)</label>
                                        <input type="date" value="<?= (isset($to_date)) ? $to_date : ''; ?>" name="to_date" class="form-control form-control-sm" id="company-name" max="<?= date('Y-m-d'); ?>">

                                        <?php if($validation->getError('to_date')): ?>
                                            <span>
                                                <strong class="text-danger">
                                                    <?=$validation->getError('to_date'); ?>
                                                </strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-primary mb-2 float-right"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg> Apply Filter</button>
                                </div> 
                            </form> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <table class="multi-table table table-striped table-bordered table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>N<sup>o</sup></th>
                            <th>Names</th>
                            <th>Reg N<sup>o</sup></th>
                            <th>Student Option</th>
                            <th>Log</th>
                            <th>Log Date</th>
                            <th>Log Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($logsData)):
                            $x = 0;
                            foreach($logsData as $log):
                                $x++;
                                ?>
                                <tr>
                                    <td><?=$x;?></td>
                                    <td><?=$log->std_firstname.' '.$log->std_lastname;?></td>
                                    <td><?=$log->std_regno;?></td>
                                    <td><?=$log->opt_code;?></td>
                                    <td><?=$log->log_status;?></td>
                                    <td><?=date('d-M-Y', strtotime($log->log_created_at));?></td>
                                    <td><?=date('H:i:s', strtotime($log->log_created_at));?></td>
                                </tr>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    <!--  END CONTENT AREA  -->
<?= $this->endSection();?>
<?= $this->section('page_scripts');?>

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="plugins/table/datatable/datatables.js"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/js/scrollspyNav.js"></script>
<script src="assets/js/components/ui-accordions.js"></script>
<script>
    $(document).ready(function() {
        $('table.multi-table').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
    "<'table-responsive'tr>" +
    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [1, 2, 5, 10, 20, 50],
            "pageLength": 10,
            drawCallback: function () {
                $('.t-dot').tooltip({ template: '<div class="tooltip status" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' })
                $('.dataTables_wrapper table').removeClass('table-striped');
            }
        });
    } );
</script>
<script>
$('.widget-content .warning.confirm').on('click', function (event) {
event.preventDefault();
const url = $(this).attr('href');
swal({
    title: 'Are you sure?',
    text: "You want to delete this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Delete',
    padding: '2em'
    }).then(function(result) {
    if (result.value) {
        swal(
        'Deleted!',
        'Your file has been deleted.',
        'success'
        )
        window.location.href = url;
    }
    })
})
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
            title: '<?=$session->getFlashdata('success').' is updated';?>',
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
                url:"<?=route_to('option.json');?>",
                method:"POST",
                data:{id:id},
                dataType:"JSON",
                success:function(data)
                {
                    var html = '<option selected value="0">All (Default)</option>';

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
