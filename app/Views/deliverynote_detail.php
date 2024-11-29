<?= $this->extend('commanfile/header'); ?>
<?= $this->section('content'); ?>

<!-- page title area end -->
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <!-- <div class="d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#jobsheetModal"> <i class="fa fa-edit"> </i> Edit</button>
                    </div> -->

                    <div class="d-flex justify-content-between align-items-center">
                        <button type="button" id="editBtn" class="btn btn-info btn-sm "> <i class="fa fa-edit"> </i> Edit Record</button>
                    </div>
                    <div class="row buttongrp" style="display: none;">
                        <div class="form-group col-md-4">
                            <button type="button" onclick="updateInfo()" class="btn btn-danger mb-3">Update Record</button>
                            <a href="<?= base_url() ?>job-sheet" class="btn btn-success mb-3">Cancel</a>
                        </div>
                    </div>
                    <hr>
                    <form id="deliverynotesform">
                        <input type="text" name="id" hidden value="<?= $dn_detail->id ?>">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="example-text-input" class="col-form-label">Delivery Note Id.</label>
                                <input class="form-control" name="deliverynote_id" type="text" value="<?= $dn_detail->deliverynote_id ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="example-text-input" class="col-form-label">Date </label>
                                <input type="date" name="issue_date" class="form-control" value="<?= $dn_detail->issue_date ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="example-text-input" class="col-form-label">EST. Amount </label>
                                <input type="text" name="est_amount" class="form-control" value="<?= $dn_detail->est_amount ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="example-text-input" class="col-form-label">Job List</label>
                                <select name="job_id" class="form-control select2" id="job_id">
                                    <option value="">Select Job Here</option>
                                    <?php foreach ($joblist as $job) { ?>
                                        <option data-id="<?= $job->id ?>" value="<?= $job->jobid ?>" <?= $dn_detail->job_id == $job->jobid ? 'selected' : '' ?>><?= $job->jobname . ' - ' . $job->manualreff ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="example-text-input" class="col-form-label">Handler</label>
                                <select name="handler_id" class="form-control select2" id="handler_id">
                                    <option value="">Select Handler Here</option>
                                    <?php foreach ($handlerlist as $handler) { ?>
                                        <option value="<?= $handler->ID ?>" <?= $dn_detail->handler_id == $handler->ID ? 'selected' : '' ?>><?= $handler->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="example-text-input" class="col-form-label">Region </label>
                                <select name="region" class="form-control">
                                    <option value="">Select Region</option>
                                    <?php foreach (REGIONS as $region): ?>
                                        <option value="<?= $region ?>" <?= $dn_detail->region == $region ? 'selected' : '' ?>><?= ucfirst($region) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="text-danger" id="region_error"></span>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="example-text-input" class="col-form-label">Job Name</label>
                                <input class="form-control" readonly id="jobname" type="text" value="<?= $dn_detail->jobname ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="example-text-input" class="col-form-label">Client Name </label>
                                <input type="text" readonly class="form-control" id="clientname" value="<?= $dn_detail->clientname ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="col-form-label">Transport Type</label>
                                <select name="transport_type" class="custom-select">
                                    <option value="">Select Option</option>
                                    <option value="Naqel" <?= $dn_detail->transport_type == "Naqel" ? 'selected' : '' ?>> Naqel</option>
                                    <option value="Private Car" <?= $dn_detail->transport_type == "Private Car" ? 'selected' : '' ?>>Private car</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="col-form-label">Issue Invoice</label>
                                <select name="is_issue_invoice" class="custom-select">
                                    <option value="">Select Option</option>
                                    <option value="YES" <?= $dn_detail->is_issue_invoice == "YES" ? 'selected' : '' ?>> Yes</option>
                                    <option value="NO" <?= $dn_detail->is_issue_invoice == "NO" ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="col-form-label">Invoice Issued</label>
                                <select name="is_invoice_issued" class="custom-select">
                                    <option value="">Select Option</option>
                                    <option value="YES" <?= $dn_detail->is_invoice_issued == "YES" ? 'selected' : '' ?>> Yes</option>
                                    <option value="NO" <?= $dn_detail->is_invoice_issued == "NO" ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="delivery_status">Delivery Status</label>
                                <select name="delivery_status" class="form-control" id="delivery_status">
                                    <option value="">Select Status</option>
                                    <option value="DELIVERED" <?= $dn_detail->delivery_status == "DELIVERED" ? 'selected' : '' ?>>DELIVERED</option>
                                    <option value="NOT DELIVERED" <?= $dn_detail->delivery_status == "NOT DELIVERED" ? 'selected' : '' ?>>NOT DELIVERED</option>
                                    <option value="OTHER" <?= $dn_detail->delivery_status == "OTHER" ? 'selected' : '' ?>>Other</option>
                                </select>
                            </div>

                            <div class="col-md-8">
                                <label for="delivery_status_remark">Delivery Remark</label>
                                <input type="text" name="delivery_status_remark" id="delivery_status_remark" value="<?= $dn_detail->delivery_status_remark ?>" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="signed_status">Signed In</label>
                                <select name="signed_status" class="form-control" id="signed_status">
                                    <option value="">Select Status</option>
                                    <option value="YES" <?= $dn_detail->signed_status == "YES" ? 'selected' : '' ?>>Yes</option>
                                    <option value="NO" <?= $dn_detail->signed_status == "NO" ? 'selected' : '' ?>>No</option>
                                    <option value="OTHER" <?= $dn_detail->signed_status == "OTHER" ? 'selected' : '' ?>>Other</option>
                                </select>
                            </div>

                            <div class="col-md-8">
                                <label for="signed_remark">Signed In Remark</label>
                                <input type="text" name="signed_remark" id="signed_remark" value="<?= $dn_detail->signed_remark ?>" class="form-control" disabled>
                            </div>
                        </div>

                    </form>
                    <!-- <hr>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <button type="button" onclick="updateChanges()" class="btn btn-warning mb-3">Save Changes</button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>



<?= $this->endSection(); ?>

<?= $this->section('pagescripts') ?>
<script>
    $(document).ready(function() {

        // Select all input and select elements within the form
        const fields = document.querySelectorAll('#deliverynotesform input, #deliverynotesform select');
        // Disable all the selected input and select fields
        fields.forEach(field => {
            field.disabled = true;
        });

        // You can add an event listener to the Edit button to enable the fields
        $('#editBtn').on('click', function() {
            fields.forEach(field => {
                if (field.id !== 'delivery_status_remark' && field.id !== 'signed_remark') {
                    field.disabled = false; // Enable the field
                    $('#editBtn').css('display', 'none');
                    $('.buttongrp').css('display', 'block');
                }
            });
        });

        // Check the current delivery status on page load and adjust the input field accordingly
        var deliveryStatus = $('#delivery_status').val();
        toggleDeliveryRemarkField(deliveryStatus); // Call function on page load

        // Listen to changes in the delivery status select dropdown
        $('#delivery_status').change(function() {
            var selectedStatus = $(this).val();
            toggleDeliveryRemarkField(selectedStatus); // Adjust the input field when changed
        });

        // Function to enable/disable the delivery remark field based on selected delivery status
        function toggleDeliveryRemarkField(status) {
            if (status == 'OTHER') {
                // Enable the delivery remark field if status is 'OTHER'
                $('#delivery_status_remark').prop('disabled', false); // Enable input field
            } else {
                // Disable the delivery remark field if status is not 'OTHER'
                $('#delivery_status_remark').prop('disabled', true); // Disable input field
            }
        }

        // Check the current signed status on page load and adjust the signed_remark field accordingly
        var signedStatus = $('#signed_status').val();
        toggleSignedRemarkField(signedStatus); // Call function on page load

        // Listen to changes in the signed_status select dropdown
        $('#signed_status').change(function() {
            var selectedStatus = $(this).val();
            toggleSignedRemarkField(selectedStatus); // Adjust the signed_remark field when changed
        });

        // Function to enable/disable the signed remark field based on selected signed status
        function toggleSignedRemarkField(status) {
            if (status == 'OTHER') {
                // Enable the signed remark field if status is 'OTHER'
                $('#signed_remark').prop('disabled', false); // Enable input field
            } else {
                // Disable the signed remark field if status is not 'OTHER'
                $('#signed_remark').prop('disabled', true); // Disable input field
            }
        }

    });

    $('#job_id').change(function() {
        var job_id = $(this).val();
        var link = "<?php echo base_url() ?>get-by-jobid/" + job_id;
        // Ajax to load data from the server
        $.ajax({
            url: link,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#clientname').val(data.clientname);
                $('#jobname').val(data.jobname);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });

    function updateInfo() {
        var formData = $('#deliverynotesform').serialize();
        var url;
        url = '<?= base_url() ?>update-deliverynotes';
        $.ajax({
            url: url,
            type: "POST",
            data: formData, // Send serialized form data
            dataType: "json",
            success: function(response) {
                // if (response.status == true) {
                //     Swal.fire({
                //         position: "bottom-end",
                //         title: "Good job!",
                //         text: response.message,
                //         icon: "success"
                //     }).then((result) => {
                //         if (result.isConfirmed) {
                //             location.reload(); // Reloads the page when "OK" is clicked
                //         }
                //     });
                // } else {
                //     Swal.fire({
                //         position: "bottom-end",
                //         // title: "Good job!",
                //         text: response.message,
                //         icon: "danger"
                //     }).then((result) => {
                //         if (result.isConfirmed) {
                //             location.reload(); // Reloads the page when "OK" is clicked
                //         }
                //     });
                // }

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
                    Swal.fire({
                        position: "bottom-end",
                        // title: "Good job!",
                        text: response.message,
                        icon: "danger"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload(); // Reloads the page when "OK" is clicked
                        }
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX request failed:', textStatus, errorThrown);
            }
        });

    }
</script>
<?= $this->endSection(); ?>