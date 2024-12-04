<?= $this->extend('commanfile/header'); ?>
<?= $this->section('content'); ?>

<div class="main-content-inner">
    <div class="login-area">
        <div class="container">
            <div class="login-box">
                <form method="POST" id="deliverynotesform" enctype="multipart/form-data">
                    <div class="login-form-body" style="border: 3px solid #000;">

                        <div class="form-group">
                            <label for="import_file">Upload File Here</label>
                            <input type="file" name="import_file" id="import_file">
                            <i class="ti-file"></i>
                            <div class="text-danger"></div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <!-- <div class="submit-btn-area"> -->
                            <button type="button" onclick="submitform()" class="btn btn-success btn-block" id="form_submit">Upload File <i class="ti-upload"></i></button>
                            <!-- </div> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
    })

    function submitform() {
        $('#loader-overlay').fadeIn();
        var formData = new FormData($('#deliverynotesform')[0]);
        $.ajax({
            url: '<?= base_url() ?>import-deliverynotes', // Your backend URL
            type: 'POST',
            data: formData,
            contentType: false, // Don't set content type header
            processData: false, // Don't process data
            success: function(response) {
                $('#loader-overlay').fadeOut();
                // Enable the submit button again
                $('#form_submit').prop('disabled', false);
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
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle any server-side errors
                $('#loader-overlay').fadeOut();
                $('#form_submit').prop('disabled', false);
                $('#form_submit').text('Upload File <i class="ti-upload"></i>');
                $('#error-messages').html('<div class="alert alert-danger">There was an error with the upload. Please try again.</div>');
            }
        });
    }
</script>
<?= $this->endSection(); ?>