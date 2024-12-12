<?= $this->extend('commanfile/header'); ?>
<?= $this->section('content'); ?>

<!-- page title area end -->
<div class="main-content-inner">
    <div class="login-area">
        <div class="container">
            <div class="login-box">
                <form method="POST" id="jobform" enctype="multipart/form-data">
                    <div class="login-form-body" style="border: 3px solid #000;">
                        <div class="form-group mb-3">
                            <label for="">Select Branch</label>
                            <select name="branch" id="branch" class="form-control">
                                <option value="">Select Branch</option>
                                <option value="1">Branch 1</option>
                                <option value="2">Branch 2</option>
                            </select>
                            <span class="text-danger"></span>
                        </div>
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
        var formData = new FormData($('#jobform')[0]);
        $.ajax({
            url: '<?= base_url() ?>import-jobsheet', // Your backend URL
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
                    if (response.status == true) {
                        if (response.log && response.log.length > 0) {
                            // Create a table for logs dynamically
                            let logTable = `
                            <table border="1" style="width: 100%; text-align: left; font-size: 14px;">
                                <thead>
                                    <tr>
                                        <th style="padding: 8px;">Job ID</th>
                                        <th style="padding: 8px;">Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${response.log
                                        .map(
                                            (log) =>
                                                `<tr>
                                                    <td style="padding: 8px;">${log.jobid}</td>
                                                    <td style="padding: 8px;">${log.reason}</td>
                                                </tr>`
                                        )
                                        .join("")}
                                </tbody>
                            </table>`;

                            // Display logs in SweetAlert with print and download options
                            Swal.fire({
                                position: "center",
                                title: "Import Completed with Warnings",
                                html: `
                                    <div style="max-height: 300px; overflow-y: auto; margin-bottom: 15px;">
                                        ${logTable}
                                    </div>
                                    <button class="btn btn-info" id="downloadLog" style="margin-right: 10px;">Download Logs</button>
                                    <button class="btn btn-danger" id="printLog">Print Logs</button>
                                `,
                                icon: "warning",
                                showConfirmButton: true,
                                confirmButtonText: "Okay"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });

                            // Add event listener to download logs as a text file
                            document.getElementById("downloadLog").addEventListener("click", () => {
                                let logContent = response.log
                                    .map((log) => `Job ID: ${log.jobid}, Reason: ${log.reason}`)
                                    .join("\n");
                                let blob = new Blob([logContent], {
                                    type: "text/plain"
                                });
                                let link = document.createElement("a");
                                link.href = window.URL.createObjectURL(blob);
                                link.download = "jobsheet_logs.txt";
                                link.click();
                            });

                            // Add event listener to print logs
                            document.getElementById("printLog").addEventListener("click", () => {
                                let printWindow = window.open("", "_blank");
                                printWindow.document.write("<html><head><title>Logs</title></head><body>");
                                printWindow.document.write("<h1>Skipped Entries Log</h1>");
                                printWindow.document.write(logTable);
                                printWindow.document.write("</body></html>");
                                printWindow.document.close();
                                printWindow.print();
                            });
                        } else {
                            Swal.fire({
                                position: "bottom-end",
                                title: "Good job!",
                                text: response.message,
                                icon: "success"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        }
                    } else {
                        Swal.fire({
                            position: "bottom-end",
                            title: "Ohh Snap!",
                            text: response.message,
                            icon: "error"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
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