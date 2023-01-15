<?= $this->extend('layout/admin_layout');?>
<?= $this->section('page_css');?>
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
    <!-- <link rel="stylesheet" type="text/css" href="plugins/table/datatable/custom_dt_multiple_tables.css"> -->
    <style>
        .table-responsive > .table {
            background: transparent;
        }
    </style>
    <!-- END PAGE LEVEL STYLES -->
<?= $this->endSection();?>
<?= $this->section('content');?>
<!--  BEGIN CONTENT AREA  -->
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <table class="multi-table table table-striped table-bordered table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>N<sup>o</sup></th>
                            <th>Names</th>
                            <th>Reg N<sup>o</sup></th>
                            <th>Department/Option</th>
                            <th>Registered On</th>
                            <th>Card Status</th>
                            <th class="text-center dt-no-sorting">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        use App\Models\Student;
                        $studentObj = new Student();

                        if(isset($students)):
                            $x = 0;
                            foreach($students as $std):
                                $x++;
                                ?>
                                <tr>
                                    <td><?=$x;?></td>
                                    <td>
                                    <div class="d-flex">
                                        <div class="usr-img-frame mr-2 rounded-circle">
                                            <img alt="avatar" class="img-fluid rounded-circle" src="<?=$std->std_picture;?>">
                                        </div>
                                        <p class="align-self-center mb-0 admin-name">
                                        <?=$std->std_firstname.' '.$std->std_lastname;?>
                                        </p>
                                    </div>
                                    </td>
                                    <td><?=$std->std_regno;?></td>
                                    <td><?=$std->dpt_name?></td>
                                    <td><?=date('d-m-Y', strtotime($std->std_created_at));?></td>
                                    <td>
                                        <?php
                                        $crd_status = $studentObj->cardStatus($std->std_id);
                                        if ($crd_status == 'active'): ?>
                                            <span class="text-success"><?= ucfirst($crd_status);?></span>
                                        <?php elseif ($crd_status == 'expired'):?>
                                            <span class="text-warning"><?=ucfirst($crd_status);?></span>
                                        <?php else:?>
                                            <span class="text-danger"><?=ucfirst($crd_status);?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                <?php
                                                ?>
                                                <a class="dropdown-item" href="<?= route_to('student.info', $std->std_id); ?>">View</a>
                                                <a class="dropdown-item" href="<?=route_to('student.edit', $std->std_id)?>">Edit</a>
                                                <a class="dropdown-item warning confirm" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>
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
            "pageLength": 5,
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
<?= $this->endSection();?>
