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
                        <button type="button" class="btn btn-warning btn-md mt-3 mb-3" data-toggle="modal" data-target="#userModal"> <i class="fa fa-user-plus"></i> Add User</button>
                    </div>

                    <?php if (!empty($records) and is_array($records)): ?>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-striped" id="usertable">
                                <thead class="bg-primary">
                                    <tr class="text-nowrap">
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($records as $record): ?>
                                        <tr>
                                            <!-- <td><a href="<?= base_url() ?>users/<?= esc($record->ID) ?>"><strong><?= esc($record->name) ?></strong></a></td> -->
                                            <td><a href="#"><strong><?= esc($record->name) ?></strong></a></td>
                                            <td><?= esc($record->mobile_number) ?></td>
                                            <td><?= esc($record->email) ?></td>
                                            <td><?= esc($record->role_name) ?></td>
                                            <td>
                                                <?php
                                                $category_status = ($record->is_active == 1) ? "btn-primary" : "btn-danger";
                                                $status = ($record->is_active == 1) ? "Active" : "Inactive";
                                                ?>
                                                <!-- Button to toggle status with SweetAlert -->
                                                <span data-id="<?= esc($record->ID) ?>" class="btn btn-sm <?= $category_status ?> status_checks" onclick="changeStatus(<?= esc($record->ID) ?>, <?= esc($record->is_active) ?>)">
                                                    <?= esc($status) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <i class="ti-trash" onclick="delete_user(<?= esc($record->ID) ?>)" data-id="<?= esc($record->ID) ?>"></i> |
                                                <i data-toggle="modal" onclick="edit_user(<?= esc($record->ID) ?>)" class="ti-pencil edit-icon" data-id="<?= esc($record->ID) ?>" data-name="<?= esc($record->name) ?>" data-email="<?= esc($record->email) ?>" data-role="<?= esc($record->role_name) ?>" data-mobile="<?= esc($record->mobile_number) ?>"></i>
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
<div class="modal fade show modalform" id="userModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add User Here</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <form id="userRegistrationForm">
                        <input type="text" hidden name="ID" id="ID" class="form-control">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                                    <span class="text-danger" id="name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email / Username </label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email / Username">
                                    <span class="text-danger" id="email_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Contact Number </label>
                                    <input type="number" class="form-control" id="mobile_number" name="mobile_number" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="12" placeholder="Enter Contact Number">
                                    <span class="text-danger" id="mobile_number_error"></span>
                                </div>
                            </div>
                            
                         

                            <div class="col-md-6">
                                <div class="form-group passwordDiv">
                                    <label for="">Set Password </label>
                                    <input type="password" class="form-control togglepassword" name="newpassword" id="newpassword" placeholder="Set a Password">
                                    <span class="text-danger" id="newpassword_error"></span>
                                    <input class="m-2" type="checkbox" onclick="togglePassword()">Show Password
                                </div>

                                <div id="password-error" style="color: red; display: none;">Passwords do not match!
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group passwordDiv">
                                    <label for="">Confirm Password </label>
                                    <input type="password" class="form-control togglepassword" name="password" id="confirmpassword" placeholder="Set a Password">
                                    <span class="text-danger" id="password_error"></span>
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

        $('#newpassword, #confirmpassword').on('keyup', function() {
            var newPassword = $('#newpassword').val();
            var confirmPassword = $('#confirmpassword').val();

            if (newPassword !== confirmPassword) {
                $('#password-error').show();
                $('#submit-btn').attr('disabled', 'disabled');
            } else {
                $('#password-error').hide();
                $('#submit-btn').removeAttr('disabled');
            }
        });

        // For input fields
        $("input").on("change", function() {
            $(this).closest('.form-gp').find('.error-text').text('');
        });

        // For select elements
        $("select").on("change", function() {
            $(this).closest('.form-gp').find('.error-text').text('');
        });

    });

    $('#user_role').change(function() {

        var selectedOption = $(this).find('option:selected');
        var selectedName = selectedOption.data('name'); // Get the name from data-name attribute
        if (selectedName === 'Dispatcher') {
            // Show the region div and make it required
            $('.region').css('display', 'block');
            $('#region_input').prop('required', true);
        } else {
            // Hide the region div and remove the required attribute
            $('.region').hide();
            $('#region_input').prop('required', false);
        }

        // if (selectedName === 'Sales Manager') {
        //     // Show the region div and make it required
        //     $('.jobtype').css('display', 'block');
        //     $('#region_input').prop('required', true);
        // } else {
        //     // Hide the region div and remove the required attribute
        //     $('.jobtype').hide();
        //     $('#region_input').prop('required', false);
        // }
    });


    function togglePassword() {
        var $x = $('.togglepassword'); // Use jQuery to select elements with the class "togglepassword"
        $x.each(function() { // Iterate over each element if there are multiple
            if ($(this).attr('type') === 'password') {
                $(this).attr('type', 'text');
            } else {
                $(this).attr('type', 'password');
            }
        });
    }

    function edit_user(userid) {

        save_method = 'update';
        var link = "<?php echo base_url() ?>edituser/" + userid;
        //Ajax Load data from ajax
        $.ajax({
            url: link,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="ID"]').val(data.ID);
                $('[name="name"]').val(data.name);
                $('[name="email"]').val(data.email);
                $('[name="mobile_number"]').val(data.mobile_number);
                $('[name="user_role"]').val(data.user_role);
                if (data.user_role == '3') {
                    $('.region').css('display', 'block');
                }
                if (data.user_role == '4') {
                    $('.jobtype').css('display', 'block');
                }
                $('[name="region"]').val(data.region);
                $('[name="job_type"]').val(data.job_type);
                $('.passwordDiv').css('display', 'none');

                $('#userModal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit User Info'); // Set title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    }

    function SaveUser() {

        var form = $('#userRegistrationForm');
        var isValid = true;

        var newPassword = $('#newpassword').val();
        var confirmPassword = $('#confirmpassword').val();
        if (newPassword !== confirmPassword) {
            $('#password-error').show();
            isValid = false;
        }

        if (isValid) {

            var formData = form.serialize();
            var url;
            if (save_method == 'update') {
                url = '<?= base_url() ?>update-user';
            } else {
                url = '<?= base_url() ?>user-registration';
            }
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
                                    inputField.closest('.form-gp').addClass('has-error');

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
    }


    function delete_user(id) {
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
                    url: "<?php echo base_url() ?>deleteuser/" + id,
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
                            // $('#usertable').ajax.reload(null, false); //reload datatable ajax 
                            // location.reload()
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            }
        })
    }

    function changeStatus(userId, currentStatus) {
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
                    url: "<?php echo base_url() ?>updatestatus", // Your update status endpoint
                    type: "POST",
                    data: {
                        id: userId,
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