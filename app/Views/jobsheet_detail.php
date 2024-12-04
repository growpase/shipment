<?= $this->extend('commanfile/header'); ?>
<?= $this->section('content'); ?>

<!-- page title area end -->
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
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
                    <form method="POST" id="jobupdateform">
                        <input type="text" name="id" hidden value="<?= $jobdetail->id ?>">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="">Select Branch</label>
                                <select name="branch" id="branch" class="form-control">
                                    <option value="1" <?= $jobdetail->branch == '1' ? 'selected' : '' ?>>Branch 1</option>
                                    <option value="2" <?= $jobdetail->branch == '2' ? 'selected' : '' ?>>Branch 2</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="">Job Created Date</label>
                                <input type="date" name="job_createdate" class="form-control" value="<?= $jobdetail->job_createdate ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="example-text-input" class="col-form-label">Job Name</label>
                                <input class="form-control" name="jobname" type="text" value="<?= $jobdetail->jobname ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="example-text-input" class="col-form-label">Job Type</label>
                                <select name="jobtype" class="custom-select">
                                    <option value="">Select Jobtype</option>
                                    <?php foreach (JOBTYPES as $jobtype): ?>
                                        <option value="<?= $jobtype ?>" <?= $jobdetail->jobtype == $jobtype ? 'selected' : '' ?>><?= ucfirst($jobtype) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="example-text-input" class="col-form-label">Client Name</label>
                                <input class="form-control" type="text" name="clientname" value="<?= $jobdetail->clientname ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="example-text-input" class="col-form-label">Manual Reff.</label>
                                <input class="form-control" type="text" name="manualreff" value="<?= $jobdetail->manualreff ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="example-text-input" class="col-form-label">Dispatcher</label>
                                <select name="dispatcher_id" class="custom-select">
                                    <option value="">Select Option</option>
                                    <?php foreach ($dispatcherlist as $dispatcher) { ?>
                                        <option value="<?= $dispatcher->ID ?>" <?= $jobdetail->dispatcher_id == $dispatcher->ID ? 'selected' : '' ?>>
                                            <?= $dispatcher->name ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="col-form-label">Handler</label>
                                <select name="handler_id" class="custom-select">
                                    <option>Select Option</option>
                                    <?php foreach ($handlerlist as $handler) { ?>
                                        <option value="<?= $handler->ID ?>" <?= $jobdetail->handler_id == $handler->ID ? 'selected' : '' ?>>
                                            <?= $handler->name ?>
                                        </option>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="example-text-input" class="col-form-label">STAT</label>
                                <input class="form-control" type="text" name="stat" value="<?= $jobdetail->stat ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="example-text-input" class="col-form-label">Currency</label>
                                <input class="form-control" type="text" name="currency" value="<?= $jobdetail->currency ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="col-form-label">Status</label>
                                <select name="status" id="status" class="custom-select">
                                    <option>Select Option</option>
                                    <option value="Approved" <?= $jobdetail->status == 'Approved' ? 'selected' : '' ?>>Approved</option>
                                    <option value="To Be Approved" <?= $jobdetail->status == 'To Be Approved' ? 'selected' : '' ?>>To Be Approved</option>
                                    <option value="Job to Close" <?= $jobdetail->status == 'Job to Close' ? 'selected' : '' ?>>Job to Close</option>
                                    <option value="Rejected" <?= $jobdetail->status == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="example-text-input" class="col-form-label">Project Cost</label>
                                <input class="form-control" type="number" name="project_cost" value="<?= $jobdetail->project_cost ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="example-text-input" class="col-form-label">Realization Cost</label>
                                <input class="form-control" type="number" name="realize_cost" value="<?= $jobdetail->realize_cost ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="example-text-input" class="col-form-label">Invoice Amount</label>
                                <input class="form-control" type="number" name="invoice_amount" value="<?= $jobdetail->invoice_amount ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="example-text-input" class="col-form-label">Balance</label>
                                <input class="form-control" type="number" name="balance_amount" value="<?= $jobdetail->balance_amount ?>">
                            </div>
                        </div>
                        
                        <hr>

                    </form>
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
        const fields = document.querySelectorAll('#jobupdateform input, #jobupdateform select');
        // Disable all the selected input and select fields
        fields.forEach(field => {
            field.disabled = true;
        });

        // You can add an event listener to the Edit button to enable the fields
        $('#editBtn').on('click', function() {
            // Enable all the selected input and select fields when Edit button is clicked
            fields.forEach(field => {
                field.disabled = false;
                $('#editBtn').css('display', 'none');
                $('.buttongrp').css('display', 'block');
            });

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

    })


    function updateInfo() {
        var formData = $('#jobupdateform').serialize();
        var url;
        url = '<?= base_url() ?>update-jobsheet';
        $.ajax({
            url: url,
            type: "POST",
            data: formData, // Send serialized form data
            dataType: "json",
            success: function(response) {

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