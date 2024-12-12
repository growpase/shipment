<?= $this->extend('commanfile/header'); ?>
<?= $this->section('content'); ?>


<!-- page title area end -->
<div class="main-content-inner">
    <div class="row">
        <!-- table primary start -->
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-warning btn-md mt-3 mb-3" data-toggle="modal" data-target="#levelModal"> <i class="fa fa-user-plus"></i> Add Level</button>
                    </div>

                    <?php if (!empty($records) and is_array($records)): ?>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-striped table-bordered" id="usertable">
                                <thead class="bg-primary text-white">
                                    <tr class="text-nowrap">
                                    <th>ID</th>
                                        <th>Level ID</th>
                                        <th>Level Name</th>
                                        <th>Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($records as $record): ?>
                                        <tr>
                                        <td><?= esc(' ' . $record->id) ?></td>
                                            <td><?= esc('Level -' . $record->id) ?></td>
                                            <td><?= esc($record->level_name) ?></td>
                                            <td>
                                                <?php
                                                $category_status = ($record->status == 1) ? "btn-primary" : "btn-danger";
                                                $status = ($record->status == 1) ? "Active" : "Inactive";
                                                ?>
                                                <span data-id="<?= esc($record->id) ?>" class="btn btn-sm <?= $category_status ?> status_checks" onclick="changeStatus(<?= esc($record->id) ?>, <?= esc($record->status) ?>)">
                                                    <?= esc($status) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <i data-toggle="modal" onclick="edit_level(<?= esc($record->id) ?>)" class="ti-pencil edit-icon" data-id="<?= esc($record->id) ?>" data-name="<?= esc($record->level_name) ?>"></i>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="card-body text-warning"> No Users Found! </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- add User Modal -->
<div class="modal fade show modalform" id="levelModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Level here</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <form id="levelform">
                        <input type="text" hidden name="id" id="id" class="form-control">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Level Name</label>
                                    <input type="text" class="form-control" id="level_name" name="level_name" placeholder="Enter level name">
                                    <span class="text-danger" id="level_name_error"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <!-- data-dismiss="modal" -->
                    <button type="button" class="btn btn-secondary" onclick="hideModal()">Close</button>
                    <button type="button" onclick="SaveUser()" id="submit-btn" class="btn btn-danger">Save changes</button>
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

    function edit_level(userid) {

        save_method = 'update';
        var link = "<?php echo base_url() ?>editlevel/" + userid;
        //Ajax Load data from ajax
        $.ajax({
            url: link,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                
                $('[name="id"]').val(data.id);
                $('[name="level_name"]').val(data.level_name);

                $('#levelModal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Level Info'); // Set title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    }

    function SaveUser() {

        var formData = $('#levelform').serialize();
        var url;
        if (save_method == 'update') {
            url = '<?= base_url() ?>update-level';
        } else {
            url = '<?= base_url() ?>insert-level';
        }

        $.ajax({
            url: url,
            type: "POST",
            data: formData, // Send serialized form data
            dataType: "json",
            success: function(response) {
                console.log(response);
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

                }
                // location.reload()
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX request failed:', textStatus, errorThrown);
            }
        });
    }


    function changeStatus(id, currentStatus) {
        // Determine the new status (if it's 0, we want to change it to 1, and vice versa)
        var newStatus = (currentStatus === 0) ? 1 : 0;
        // Show SweetAlert confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to change the user status?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, make AJAX request to update status
                $.ajax({
                    url: "<?php echo base_url() ?>update-level-status",
                    type: "POST",
                    data: {
                        id: id,
                        status: newStatus
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.status) {
                            Swal.fire(
                                'Updated!',
                                'The status has been updated.',
                                'success'
                            );
                            location.reload()
                        } else {
                            Swal.fire(
                                'Error!',
                                'There was an error updating the status.',
                                'error'
                            );
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.fire(
                            'Error!',
                            'Failed to update status.',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>

<?= $this->endSection(); ?>