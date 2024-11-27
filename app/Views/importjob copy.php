<?= $this->extend('commanfile/header'); ?>
<?= $this->section('content'); ?>

<!-- page title area end -->
<div class="main-content-inner">
    <div class="login-area">
        <div class="container">
            <div class="login-box">
                <form method="POST" action="<?= base_url() ?>import-jobsheet" enctype="multipart/form-data">
                    <div class="login-form-body" style="border: 3px solid #000;">
                        <?php if (session()->get('errors')): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach (session()->get('errors') as $field => $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="form-group mb-3">
                            <label for="">Select Branch</label>
                            <select name="branch" id="branch" class="form-control">
                                <option value="">Select Branch</option>
                                <option value="1">Branch 1</option>
                                <option value="2">Branch 2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Upload File Here</label>
                            <input type="file" name="import_file" id="exampleInputEmail1">
                            <i class="ti-file"></i>
                            <div class="text-danger"></div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <!-- <div class="submit-btn-area"> -->
                            <button type="submit" class="btn btn-success btn-block" id="form_submit">Upload File <i class="ti-upload"></i></button>
                            <!-- </div> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
<?= $this->renderSection('pagescripts'); ?>
<script>
  

    function submitform() {
        e.preventDefault(); // Prevent normal form submission

        var formData = new FormData(this); // Create FormData object from the form
        $.ajax({
            url: '<?= base_url() ?>import-jobsheet', // Your backend URL
            type: 'POST',
            data: formData,
            contentType: false, // Don't set content type header
            processData: false, // Don't process data
            beforeSend: function() {
                // Optionally add a loading indicator
                $('#form_submit').prop('disabled', true);
                $('#form_submit').text('Uploading...');
            },
            success: function(response) {
                // Enable the submit button again
                $('#form_submit').prop('disabled', false);
                $('#form_submit').text('Upload File <i class="ti-upload"></i>');

                // Check if there were errors or success
                if (response.success) {
                    // Handle success response
                    alert('File uploaded successfully!');
                    // Optionally, you can reset the form after successful upload
                    $('#uploadForm')[0].reset();
                } else {
                    // Handle validation or error messages
                    if (response.errors) {
                        // Loop through error messages and display them
                        var errorMessages = '<ul>';
                        $.each(response.errors, function(index, error) {
                            errorMessages += '<li>' + error + '</li>';
                        });
                        errorMessages += '</ul>';
                        $('#error-messages').html('<div class="alert alert-danger">' + errorMessages + '</div>');
                    }

                    // Handle file-specific errors
                    if (response.file_error) {
                        $('#file-error').text(response.file_error);
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle any server-side errors
                $('#form_submit').prop('disabled', false);
                $('#form_submit').text('Upload File <i class="ti-upload"></i>');
                $('#error-messages').html('<div class="alert alert-danger">There was an error with the upload. Please try again.</div>');
            }
        });
    }
</script>

<?= $this->endSection();
