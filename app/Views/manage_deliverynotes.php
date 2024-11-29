<?= $this->extend('commanfile/header'); ?>
<?= $this->section('content'); ?>

<!-- page title area end -->
<div class="main-content-inner">
    <div class="row">
        <!-- table primary start -->
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Job Id</label>
                                <select name="" id="" class="form-control">
                                    <option value="">Select Job Id</option>
                                    <option value="">360</option>
                                    <option value="">361</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Job Name</label>
                                <select name="" id="" class="form-control">
                                    <option value="">Select Job Name</option>
                                    <option value="">AKIRA BACK</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-info btn-sm text-white mt-4"> <i class="fa fa-search"></i> Search Record</button>
                            <button type="button" class="btn btn-warning btn-sm text-white mt-4" data-toggle="modal" data-target="#jobsheetModal"> <i class="fa fa-upload"></i> Upload Delivery Note</button>
                        </div>
                    </div>
                    <hr>
                    <div class="single-table dntable">
                        <?php if (!empty($deliverynotes) and is_array($deliverynotes)): ?>
                            <div class="table-responsive">
                                <div class="data-tables datatable-primary">
                                    <table id="dataTable2" class="text-center">
                                        <thead class="text-uppercase bg-primary">
                                            <tr class="text-white">
                                                <th scope="col">Delivery Note</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Net Amount</th>
                                                <th scope="col">Signed</th>
                                                <th scope="col">Issued Invoice</th>
                                                <th scope="col">Invoice Issue</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($deliverynotes as $deliverynote): ?>
                                                <tr>
                                                    <td scope="row"><?= esc($deliverynote->deliverynote_id) ?></td>
                                                    <td><?= date('d-m-Y', strtotime($deliverynote->issue_date)) ?></td>
                                                    <td><?= esc($deliverynote->jobname) ?></td>
                                                    <td><?= esc($deliverynote->est_amount) ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <span type="button" class=""><?= esc($deliverynote->signed_status) ?></span>
                                                            <a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            </a>
                                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(72px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'YES','signed_status')">Yes</a>
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'NO','signed_status')">No</a>
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'OTHER','signed_status')">Other</a>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="btn-group">
                                                            <span type="button" class=""><?= esc($deliverynote->is_issue_invoice) ?></span>
                                                            <a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            </a>
                                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(72px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'YES','is_issue_invoice')">Yes</a>
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'NO','is_issue_invoice')">No</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <span type="button" class=""><?= esc($deliverynote->is_invoice_issued) ?></span>
                                                            <a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            </a>
                                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(72px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'YES','is_invoice_issued')">Yes</a>
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'NO','is_invoice_issued')">No</a>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td> <a href="<?= base_url() ?>deliverynotes-detail/<?= $deliverynote->id ?>"> <i class="fa fa-eye"></i> </a> | <i class="fa fa-trash-o delete-icon" onclick="delete_data(<?= $deliverynote->id ?>)"></i></td>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                <?php else: ?>
                    <div class="card-body text-warning"> No Users Found! </div>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- signed in status model -->
<div class="modal fade show" id="remarkModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <form id="signedinform">
                        <input type="hidden" id="deliveyid" value="">
                        <input type="hidden" id="signed_status_value" value="">
                        <div class="row">
                            <div class="col-md-12" id="signed_remark_div">
                                <div class="form-group">
                                    <label for="signed_remark">Signed Remark </label>
                                    <textarea class="form-control" name="signed_remark" id="type_signed_remark" placeholder="Signed Status Remark" id=""></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="updateChanges($('#deliveyid').val(), $('#signed_status_value').val(),'signed_remark')" class="btn btn-danger">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
<?= $this->section('pagescripts'); ?>
<script>
    let save_method = 'add';
    $(document).ready(function() {
        // For input fields
        $("input").on("change", function() {
            $(this).closest('.form-gp').find('.error-text').text('');
        });
        // For select elements
        $("select").on("change", function() {
            $(this).closest('.form-gp').find('.error-text').text('');
        });
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
            "ordering": true, // Enable column sorting
            "info": true, // Display info about the number of records
            "lengthChange": true, // Enable the option to change the number of records per page
            "responsive": false // Make the table responsive
        });
    }

    function updateChanges(id, record, coloum) {
        var url = '<?= base_url() ?>update-deliverynotes'; // The URL to send the AJAX request to
        if (coloum == 'signed_status') {
            if (record == 'OTHER') {
                // Show modal to enter remark when "Other" is selected
                $('#remarkModal').modal('show');
                $("#deliveyid").val(id);
                $("#signed_status_value").val(record);
            } else {
                // For "Yes" or "No", proceed with the update directly
                var data = {
                    id: id,
                    signed_status: record
                };
                sendUpdateRequest(data);
            }
        } else {
            var data = {
                id: id
            };
            if (coloum == 'is_issue_invoice') {
                data.is_issue_invoice = record;
            } else if (coloum == 'is_invoice_issued') {
                data.is_invoice_issued = record;
            } else if (coloum == 'signed_remark') {
                data.signed_remark = $('#type_signed_remark').val();
                data.signed_status = record;
                $('#remarkModal').modal('hide');
            }
            sendUpdateRequest(data);
        }
    }

    function sendUpdateRequest(data) {
        var url = '<?= base_url() ?>update-deliverynotes';
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

    function delete_data(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?php echo base_url() ?>delete-deliverynote/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        // console.log(data);
                        if (data.status == true) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            location.reload()
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            }
        })
    }
</script>
<?= $this->endSection(); ?>