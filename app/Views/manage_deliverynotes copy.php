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
                                                    <td><?= esc($deliverynote->est_amount) ?>
                                                    </td>
                                                    <td><?= esc($deliverynote->signed_status) ?> <a href="javascript:void(0)" onclick="get_data(<?= $deliverynote->id ?>,'signedin')"><i class="fa fa-edit"></i> </a> </td>
                                                    <!-- <td><?= esc($deliverynote->is_issue_invoice) ?> <a href="javascript:void(0)" onclick="get_data(<?= $deliverynote->id ?>,'issue_invoice')"><i class="fa fa-edit"></i> </a> </td> -->
                                                    <td class="reload">
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
                                                    <td class="reload">
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
                                                    <!-- <td><?= esc($deliverynote->is_invoice_issued) ?> <a href="javascript:void(0)" onclick="get_data(<?= $deliverynote->id ?>,'invoice_issue')"><i class="fa fa-edit"></i> </a> </td> -->
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

<!-- invoice issue model -->
<div class="modal fade show" id="isInvoiceIssueModel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <form id="invoice_issueform">
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Invoice Issue </label>
                                    <select name="is_invoice_issued" class="form-control" id="">
                                        <option value="">Select Option</option>
                                        <option value="YES">Yes</option>
                                        <option value="NO">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="updateChanges('invoice_issue')" class="btn btn-danger">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- issue invoice model -->
<div class="modal fade show" id="isIssueInvoiceModel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <form id="issue_invoiceform">
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for=""> Issued Invoice ? </label>
                                    <select name="is_issue_invoice" class="form-control" id="">
                                        <option value="">Select Option</option>
                                        <option value="YES">Yes</option>
                                        <option value="NO">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="updateChanges('issue_invoice')" class="btn btn-danger">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- signed in status model -->
<div class="modal fade show" id="SignedStatus" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <form id="signedinform">
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Signed Delivery Notes </label>
                                    <select name="signed_status" class="form-control" id="signed_status">
                                        <option value="">Select Option</option>
                                        <option value="YES">Yes</option>
                                        <option value="NO">No</option>
                                        <option value="OTHER">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="signed_remark_div" style="display:none">
                                <div class="form-group">
                                    <label for="signed_remark">Signed Remark </label>
                                    <textarea class="form-control" name="signed_remark" id="signed_remark" placeholder="Signed Status Remark" id=""></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="updateChanges('signedin')" class="btn btn-danger">Save Changes</button>
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

    $('#signed_status').change(function() {
        var selectedName = $(this).val();
        if (selectedName === 'OTHER') {
            // Show the region div and make it required
            $('#signed_remark_div').css('display', 'block');
            $('#signed_remark').prop('required', true);
        } else {
            // Hide the region div and remove the required attribute
            $('#signed_remark_div').css('display', 'none');
            $('#signed_remark').prop('required', false);
        }
    });

    function get_data(dn_id, userType) {
        save_method = 'update';
        var link = "<?php echo base_url() ?>edit-deliverynotes/" + dn_id;
        // Ajax to load data from the server
        $.ajax({
            url: link,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                if (userType == 'signedin') {
                    $('[name="signed_status"]').val(data.signed_status);
                    if (data.signed_status == 'OTHER' || data.signed_status == 'Other') {
                        $('#signed_remark_div').css('display', 'block');
                        $('[name="signed_remark"]').val(data.signed_remark);
                    } else {
                        $('#signed_remark_div').hide();
                    }
                    $('#SignedStatus').modal('show');
                    $('#SignedStatus .modal-title').text('Edit Info');
                } else if (userType == 'issue_invoice') {
                    $('[name="is_issue_invoice"]').val(data.is_issue_invoice);
                    $('#isIssueInvoiceModel').modal('show');
                    $('#isIssueInvoiceModel .modal-title').text('Edit Info');
                } else if (userType == 'invoice_issue') {
                    $('[name="is_invoice_issued"]').val(data.is_invoice_issued);
                    $('#isInvoiceIssueModel').modal('show');
                    $('#isInvoiceIssueModel .modal-title').text('Edit Info');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    }

    // function updateChanges(userType) {

    //     var formData;
    //     var url = '<?= base_url() ?>update-deliverynotes';

    //     if (userType == 'signedin') {
    //         formData = $('#signedinform').serialize();
    //     } else if (userType == 'invoice_issue') {
    //         formData = $('#invoice_issueform').serialize();
    //     } else if (userType == 'issue_invoice') {
    //         formData = $('#issue_invoiceform').serialize();
    //     }

    //     $.ajax({
    //         url: '<?= base_url() ?>update-deliverynotes',
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

    function updateChanges(id, record, coloum) {
        var url = '<?= base_url() ?>update-deliverynotes'; // The URL to send the AJAX request to

        if (coloum == 'is_issue_invoice') {
            var data = {
                id: id, // Include the delivery note ID
                is_issue_invoice: record // Send the updated status (1 or 0)
            };
        }
        else if(coloum == 'is_invoice_issued'){
            var data = {
                id: id, // Include the delivery note ID
                is_invoice_issued: record // Send the updated status (1 or 0)
            };
        }
        // Send AJAX request to update the record
        $.ajax({
            url: url,
            type: "POST",
            data: data, // Send data directly, no form serialization
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
                        icon: "error" // Show error if the update fails
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload(); // Reload the page on confirmation
                        }
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX request failed:', textStatus, errorThrown); // Log any errors
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