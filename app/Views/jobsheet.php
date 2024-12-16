<?= $this->extend('commanfile/header'); ?>
<?= $this->section('content'); ?>

<!-- page title area end -->
<div class="main-content-inner">
    <div class="row">
        <!-- table primary start -->
        <div class="col-lg-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <form id="filterForm" method="POST">
                        <div class="row mb-2">
                            <!-- Date Range -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="dateRange">Job Date</label>
                                    <input type="text" id="" name="datetimes" class="form-control" placeholder="d">
                                </div>
                            </div>
                            <!-- Client Name -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="clientName">Client Name</label>
                                    <select name="clientname" id="clientName" class="form-control">
                                        <option value="">Select Client Name</option>
                                        <?php foreach ($clientlist as $client): ?>
                                            <option value="<?= esc($client->clientname) ?>"><?= esc($client->clientname) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <!-- Manual Reff -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="manualReff">Manual Reff.</label>
                                    <select name="manualreff" id="manualReff" class="form-control">
                                        <option value="">Select Manual Reff.</option>
                                        <?php foreach ($manualrefflist as $manual_reff): ?>
                                            <option value="<?= esc($manual_reff->manualreff) ?>"><?= esc($manual_reff->manualreff) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="clientName">Job Type</label>
                                    <select name="searchjobtype" id="jobtype" class="form-control ">
                                        <option value="">Select Job Type</option>
                                        <?php foreach (JOBTYPES as $jobtype): ?>
                                            <option value="<?= $jobtype ?>"><?= ucfirst($jobtype) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <!-- Button Group -->
                            <div class="col-md-3">
                                <div class="btn-group w-100" role="group" aria-label="Button group example">
                                    <button type="button" id="searchBtn" class="btn btn-info btn-sm text-white">
                                        <i class="fa fa-search"></i> Search
                                    </button>
                                    <button type="button" id="resetBtn" class="btn btn-dark btn-sm text-white">
                                        <i class="fa fa-refresh"></i> Reset
                                    </button>

                                    <?php if (session()->get('userRoleName') === 'Admin') : ?>
                                        <button type="button" class="btn btn-success btn-md text-white" data-toggle="modal" data-target="#createjobsheetModal">
                                            <i class="fa fa-plus mr-1"></i> Create Job
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </form>
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
                                                            <?php if (in_array(session()->get('userRoleName'), ['Admin'])) { ?>
                                                                <span type="button"><?= esc($record->dispatcher_name) ?></span>
                                                                <a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                                                <div class="dropdown-menu">
                                                                    <?php foreach ($dispatcherlist as $dispatcher) { ?>
                                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $record->id ?>,<?= $dispatcher->ID ?>,'dispatcher_id')">
                                                                            <?= esc($dispatcher->name) ?>
                                                                        </a>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } else { ?>
                                                                <span class="text-danger"><?= esc($record->dispatcher_name) ?></span>
                                                            <?php } ?>
                                                        </div>
                                                    </td>


                                                    <td>
                                                        <div class="btn-group">
                                                            <?php if (in_array(session()->get('userRoleName'), ['Admin'])) { ?>
                                                                <span type="button"><?= esc($record->handler_name) ?></span>
                                                                <a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                                                <div class="dropdown-menu">
                                                                    <?php foreach ($handlerlist as $handler) { ?>
                                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $record->id ?>,<?= $handler->ID ?>,'handler_id')">
                                                                            <?= esc($handler->name) ?>
                                                                        </a>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } else { ?>
                                                                <span class="text-danger"><?= esc($record->handler_name) ?></span>
                                                            <?php } ?>
                                                        </div>
                                                    </td>


                                                    <td>
                                                        <div class="btn-group">

                                                            <?php if (in_array(session()->get('userRoleName'), ['Admin'])) { ?>
                                                                <span type="button"><?= esc($record->status) ?></span>
                                                                <a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $record->id ?>, 'Approved', 'status')">Approved</a>
                                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $record->id ?>, 'To Be Approved', 'status')">To Be Approved</a>
                                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $record->id ?>, 'Job to Close', 'status')">Job to Close</a>
                                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $record->id ?>, 'Rejected', 'status')">Rejected</a>
                                                                </div>
                                                            <?php } else { ?>
                                                                <span class="text-danger"> <span type="button"><?= esc($record->status) ?></span></span>
                                                            <?php } ?>
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

        $('input[name="datetimes"]').daterangepicker({
            timePicker: false,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            autoUpdateInput: true, // Prevents the input field from being auto-filled
            locale: {
                format: 'YYYY-MM-DD'
            }
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

        // Handle Search Button Click
        $('#searchBtn').click(function() {
            $('#dataTable2 tbody').html('');
            // Serialize form data
            var filters = $('#filterForm').serialize();
            $.ajax({
                url: '<?= base_url('jobsheet-filter') ?>',
                type: 'POST',
                data: filters,
                success: function(response) {
                    $('#dataTable2 tbody').html(response.Jobrecords);
                    initializeDataTable();
                },
                error: function(xhr, status, error) {
                    console.error('Error occurred:', error);
                }
            });
        });
    });

    // Handle Reset Button Click
    $('#resetBtn').click(function() {
        window.location.href = '<?= base_url('job-sheet') ?>';
    });

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
            "ordering": false, // Enable column sorting
            "info": false, // Display info about the number of records
            "lengthChange": false, // Enable the option to change the number of records per page
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
                                // location.reload(); // Reloads the page when "OK" is clicked
                                $('.createjobsheetModal').hide();
                                reloadTableContent();
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
                                // location.reload(); // Reloads the page when "OK" is clicked
                                $('.createjobsheetModal').hide();
                                reloadTableContent();
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