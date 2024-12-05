<?= $this->extend('commanfile/header'); ?>
<?= $this->section('content'); ?>

<!-- page title area end -->
<div class="main-content-inner">
    <div class="row">
        <!-- table primary start -->
        <div class="col-lg-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <button type="button" class="btn btn-success btn-md text-white" data-toggle="modal" data-target="#createjobsheetModal"> <i class="fa fa-plus mr-1"></i> Create Job</button>
                        </div>
                    </div>
                    <hr>
                    <div class="single-table">
                        <?php if (!empty($Jobrecords) and is_array($Jobrecords)): ?>
                            <div class="table-responsive">
                                <div class="data-tables datatable-primary">
                                    <table id="dataTable2" class="text-center">
                                        <thead class="text-uppercase bg-primary w-100">
                                            <tr class="text-white">
                                                <th>Job ID</th>
                                                <th>Date</th>
                                                <th>Job Name</th>
                                                <th>Job Type</th>
                                                <th>Client Name</th>
                                                <th>Manual Reff</th>
                                                <th>Realize Cost</th>
                                                <th>Project Cost</th>
                                                <th>Inv.Amount</th>
                                                <th>Balance Amount</th>
                                                <th>Dispatcher</th>
                                                <th>Handler</th>
                                                <th>Status</th>
                                                <th>Delivery Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            function formatNumber($number)
                                            {
                                                if ($number == 0) {
                                                    return '0.00';
                                                }
                                                $exploded = explode('.', $number);
                                                $integerPart = $exploded[0];
                                                $decimalPart = isset($exploded[1]) ? $exploded[1] : '00';
                                                // Format the integer part
                                                $formattedIntegerPart = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', substr($integerPart, 0, -3)) . ',' . substr($integerPart, -3);
                                                return $formattedIntegerPart . '.' . str_pad($decimalPart, 2, '0', STR_PAD_RIGHT);
                                            }

                                            foreach ($Jobrecords as $record): ?>
                                                <tr>
                                                    <th scope="row"><?= esc($record->jobid) ?></th>
                                                    <td><?= date('d-m-Y', strtotime($record->job_createdate)) ?></td>
                                                    <td><a href="<?= base_url() ?>jobsheet-detail/<?= $record->id ?>"><?= esc($record->jobname) ?></a></td>
                                                    <td><?= esc($record->jobtype) ?></td>
                                                    <td><?= esc($record->clientname) ?></td>
                                                    <td><?= esc($record->manualreff) ?></td>
                                                    <td><?= esc(formatNumber($record->realize_cost)) ?></td>
                                                    <td><?= esc(formatNumber($record->project_cost)) ?></td>
                                                    <td><?= esc(formatNumber($record->invoice_amount)) ?></td>
                                                    <td><?= esc(formatNumber($record->balance_amount)) ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <span type="button" class=""><?= esc($record->dispatcher_name) ?></span>
                                                            <a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            </a>
                                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(72px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                <?php foreach ($dispatcherlist as $dispatcher) { ?>
                                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $record->id ?>,<?= $dispatcher->ID ?>,'dispatcher_id')"><?= $dispatcher->name ?></a>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <span type="button" class=""><?= esc($record->handler_name) ?></span>
                                                            <a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            </a>
                                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(72px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                <?php foreach ($handlerlist as $handler) { ?>
                                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $record->id ?>,<?= $handler->ID ?>,'handler_id')"><?= $handler->name ?></a>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="btn-group">
                                                            <span type="button" class=""><?= esc($record->status) ?></span>
                                                            <a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            </a>
                                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(72px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $record->id ?>,'Approved','status')">Approved</a>
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $record->id ?>,'To Be Approved','status')">To Be Approved</a>
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $record->id ?>,'Job to Close','status')">Job to Close</a>
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $record->id ?>,'Rejected','status')">Rejected</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center"><a href="<?= base_url() ?>delivery-notes/<?= esc($record->jobid) ?>"><i class="ti-shopping-cart-full" title="Upload Delivery Notes"></i></a></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="card-body text-warning"> No Jobs Found! </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- create job model -->
<div class="modal fade show" id="createjobsheetModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Job</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body p-4">
                    <form id="jobform">
                        <div class="row">
                            <div class="form-group col-md-4 mb-2">
                                <label for="">Job ID</label>
                                <input type="text" name="jobid" placeholder="Please Enter Your Job ID" class="form-control">
                                <span class="text-danger" id="jobid_error"></span>
                            </div>

                            <div class="form-group col-md-4 mb-2">
                                <label for="">Select Branch</label>
                                <select name="branch" id="" class="form-control">
                                    <option value="">Select Branch</option>
                                    <option value="1">Branch 1</option>
                                    <option value="2">Branch 2</option>
                                </select>
                                <span class="text-danger" id="branch_error"></span>
                            </div>
                            <div class="form-group col-md-4 mb-2">
                                <label for="">Job Created Date</label>
                                <input type="date" name="job_createdate" class="form-control">
                                <span class="text-danger" id="job_createdate_error"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="example-text-input" class="col-form-label">Job Name</label>
                                <input class="form-control" type="text" name="jobname" placeholder="Job Name">
                                <span class="text-danger" id="jobname_error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="example-text-input" class="col-form-label">Job Type</label>
                                <!-- <input class="form-control" type="text" value="Audiovisual"> -->
                                <select name="jobtype" class="custom-select">
                                    <option value="">Select Jobtype</option>
                                    <?php foreach (JOBTYPES as $jobtype): ?>
                                        <option value="<?= $jobtype ?>"><?= ucfirst($jobtype) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="text-danger" id="jobtype_error"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="example-text-input" class="col-form-label">Client Name</label>
                                <input class="form-control" name="clientname" type="text" placeholder="Enter Client Name. e.g. Eastern Company">
                                <span class="text-danger" id="clientname_error"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="example-text-input" class="col-form-label">Manual Reff.</label>
                                <input class="form-control" type="text" name="manualreff" placeholder="Enter Manual Reff. E.g. LG-AV-24/8061 R01">
                                <span class="text-danger" id="manualreff_error"></span>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="example-text-input" class="col-form-label">Dispatcher</label>
                                <select name="dispatcher_id" class="custom-select">
                                    <option value="">Select Option</option>
                                    <?php foreach ($dispatcherlist as $dispatcher) { ?>
                                        <option value="<?= $dispatcher->ID ?>">
                                            <?= $dispatcher->name ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <span class="text-danger" id="dispatcher_id_error"></span>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="col-form-label">Handler</label>
                                <select name="handler_id" class="custom-select">
                                    <option>Select Option</option>
                                    <?php foreach ($handlerlist as $handler) { ?>
                                        <option value="<?= $handler->ID ?>">
                                            <?= $handler->name ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <span class="text-danger" id="handler_id_error"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="example-text-input" class="col-form-label">STAT</label>
                                <input class="form-control" name="stat" type="text" placeholder="T.I">
                                <span class="text-danger" id="stat_error"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="example-text-input" class="col-form-label">Currency</label>
                                <input class="form-control" type="text" name="currency" placeholder="SAR">
                                <span class="text-danger" id="currency_error"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="col-form-label">Status</label>
                                <select name="status" class="custom-select">
                                    <option value="">Select Option</option>
                                    <option value="Approved"> Approved</option>
                                    <option value="To Be Approved">To Be Approved</option>
                                    <option value="Job to Close">Job to Close</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                                <span class="text-danger" id="status_error"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="example-text-input" class="col-form-label">Project Cost</label>
                                <input class="form-control" type="number" name="project_cost" placeholder="Project Cost">
                                <span class="text-danger" id="project_cost_error"></span>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="example-text-input" class="col-form-label">Realization Cost</label>
                                <input class="form-control" type="number" name="realize_cost" placeholder="Realization Cost">
                                <span class="text-danger" id="realize_cost_error"></span>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="example-text-input" class="col-form-label">Invoice Amount</label>
                                <input class="form-control" type="number" name="invoice_amount" placeholder="Invoice Amount">
                                <span class="text-danger" id="invoice_amount_error"></span>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="example-text-input" class="col-form-label">Balance</label>
                                <input class="form-control" readonly type="number" name="balance_amount" placeholder="Balance Amount">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="saveRecord()" class="btn btn-danger">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end model -->


<?= $this->endSection(); ?>
<?= $this->section('pagescripts'); ?>
<script>
    $(document).ready(function() {
        // For input fields
        $("input").on("change", function() {
            $(this).closest('.form-group').find('.text-danger').text('');
        });

        // For select elements
        $("select").on("change", function() {
            $(this).closest('.form-group').find('.text-danger').text('');
        });

        // Function to calculate balance
        function calculateBalance() {
            const projectCost = parseFloat($('input[name="project_cost"]').val()) || 0;
            const invoiceAmount = parseFloat($('input[name="invoice_amount"]').val()) || 0;
            // Calculate balance
            const balance = projectCost - invoiceAmount;
            // Update the balance input field
            $('input[name="balance_amount"]').val(balance.toFixed(2)); // Format to 2 decimal places
        }

        // Attach event listeners to recalculate on every possible change
        $('input[name="project_cost"], input[name="invoice_amount"]').on('input change', function() {
            calculateBalance();
        });

    });

    // function assigned_user(jobid, userType) {
    //     save_method = 'update';
    //     var link = "<?php echo base_url() ?>edit-jobsheet/" + jobid;
    //     // Ajax to load data from the server
    //     $.ajax({
    //         url: link,
    //         type: "GET",
    //         dataType: "JSON",
    //         success: function(data) {

    //             $('[name="id"]').val(data.id);
    //             if (userType == 'dispatcher') {
    //                 $('[name="dispatcher_id"]').val(data.dispatcher_id);
    //                 $('#assignDispatcherModal').modal('show');
    //                 $('#assignDispatcherModal .modal-title').text('Edit Dispatcher Info');
    //             } else if (userType == 'handler') {
    //                 $('[name="handler_id"]').val(data.handler_id);
    //                 $('#assignHandlerModal').modal('show');
    //                 $('#assignHandlerModal .modal-title').text('Edit Handler Info');
    //             } else if (userType == 'jobstatus') {
    //                 $('[name="status"]').val(data.status);
    //                 $('#jobstatusModal').modal('show');
    //                 $('#jobstatusModal .modal-title').text('Edit Status');
    //             }
    //         },
    //         error: function(jqXHR, textStatus, errorThrown) {
    //             alert(errorThrown);
    //         }
    //     });
    // }

    // function updateChanges(userType) {
    //     var formData;
    //     var url = '<?= base_url() ?>update-jobsheet';
    //     if (userType == 'dispatcher') {
    //         formData = $('#dispatcherForm').serialize();
    //     } else if (userType == 'handler') {
    //         formData = $('#handlerForm').serialize();
    //     } else if (userType == 'jobstatus') {
    //         formData = $('#statusForm').serialize();
    //     }

    //     $.ajax({
    //         url: url,
    //         type: "POST",
    //         data: formData, // Send serialized form data
    //         dataType: "json",
    //         success: function(response) {
    //             if (response.status == true) {
    //                 Swal.fire({
    //                     position: "bottom-end",
    //                     title: "Good job!",
    //                     text: response.message,
    //                     icon: "success"
    //                 }).then((result) => {
    //                     if (result.isConfirmed) {
    //                         location.reload(); // Reload the page on confirmation
    //                     }
    //                 });
    //             } else {
    //                 Swal.fire({
    //                     position: "bottom-end",
    //                     text: response.message,
    //                     icon: "error" // Changed to 'error' for incorrect status
    //                 }).then((result) => {
    //                     if (result.isConfirmed) {
    //                         location.reload(); // Reload the page on confirmation
    //                     }
    //                 });
    //             }
    //         },
    //         error: function(jqXHR, textStatus, errorThrown) {
    //             console.log('AJAX request failed:', textStatus, errorThrown);
    //         }
    //     });
    // }

    // Function to reload the table content and reinitialize the DataTable
    function reloadTableContent() {
        // Reload the table section using jQuery .load()
        $('.table-responsive').load(window.location.href + ' .table-responsive', function() {
            // After the content is loaded, reinitialize DataTable to restore functionality
            initializeDataTable();
        });
    }

    // Initialize DataTable with the desired options
    function initializeDataTable() {
        // If DataTable is already initialized, destroy it before reinitializing
        if ($.fn.dataTable.isDataTable('#dataTable2')) {
            $('#dataTable2').DataTable().destroy();
        }

        // Reinitialize DataTable
        $('#dataTable2').DataTable({
            "paging": true, // Enable pagination
            "searching": true, // Enable search
            "ordering": true, // Enable column sorting
            "info": true, // Display info about the number of records
            "lengthChange": true, // Enable the option to change the number of records per page
            "responsive": false // Make the table responsive
        });
    }

    function updateChanges(id, record, coloum) {
        var data = {
            id: id
        };
        if (coloum == 'status') {
            data.status = record;
        } else if (coloum == 'dispatcher_id') {
            data.dispatcher_id = record;
        } else if (coloum == 'handler_id') {
            data.handler_id = record;
        }
        sendUpdateRequest(data);
    }

    function sendUpdateRequest(data) {
        var url = '<?= base_url() ?>update-jobsheet';
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "json",
            success: function(response) {
                if (response.status == true) {
                    Swal.fire({
                        text: response.message,
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            reloadTableContent();
                        }
                    });
                } else {
                    Swal.fire({
                        position: "bottom-end",
                        text: response.message,
                        icon: "error"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            reloadTableContent();
                        }
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX request failed:', textStatus, errorThrown);
            }
        });
    }





    function saveRecord() {
        var formData = $('#jobform').serialize();
        var url;
        url = '<?= base_url() ?>insert-jobsheet';
        $.ajax({
            url: url,
            type: "POST",
            data: formData, // Send serialized form data
            dataType: "json",
            success: function(response) {
                if (response.errors) {
                    // Loop through each error and display it next to the respective field
                    for (const field in response.errors) {
                        if (response.errors.hasOwnProperty(field)) {
                            // Find the input field and display the error message
                            const inputField = $('[name="' + field + '"]');
                            console.log(field);
                            if (inputField.length) {
                                // Add an 'error' class to the parent container (optional for styling)
                                inputField.closest('.form-group').addClass('has-error');

                                // Display the error message in a sibling element with the class 'text-danger'
                                inputField.siblings('.text-danger').text(response.errors[field]);
                            } else {
                                console.error('Input field not found for:', field);
                            }
                        }
                    }
                } else {
                    if (response.status == true) {
                        Swal.fire({
                            position: "bottom-end",
                            title: "Good job!",
                            text: response.message,
                            icon: "success"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(); // Reloads the page when "OK" is clicked
                            }
                        });
                    } else {
                        Swal.fire({
                            position: "bottom-end",
                            title: "Ohh Snap!",
                            text: response.message,
                            icon: "error"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(); // Reloads the page when "OK" is clicked
                            }
                        });
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX request failed:', textStatus, errorThrown);
            }
        });

    }
</script>
<?= $this->endSection(); ?>