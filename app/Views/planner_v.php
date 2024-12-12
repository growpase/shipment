<?= $this->extend('commanfile/header'); ?>
<?= $this->section('content'); ?>

<div class="main-content-inner">
    <div class="row">
        <div class="col-lg-12 mt-1 mb-1">
            <div class="card shadow p-3 mb-3 rounded">
                <div class="card-body">
                    <!-- Search Form -->
                    <form id="search-form">
                        <div class="row">
                            <!-- Month Selection -->
                            <div class="col-md-4 mb-3">
                                <label for="month-select" class="form-label">Select Month</label>
                                <input type="month" id="month-select" class="form-control" style="width: 100%;">
                            </div>

                            <!-- Level Selection -->
                            <div class="col-md-4 mb-3">
                                <label for="level-select" class="form-label">Select Level</label>
                                <select id="level-select" class="form-control" style="width: 100%;">
                                    <option value="" disabled selected>Select Level</option>
                                    <?php foreach ($levels as $level): ?>
                                        <option value="<?= $level->id ?>"><?= 'Level - ' . $level->id . ' ' . $level->level_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Search Button -->
                            <div class="col-md-4 mt-4">
                                <button type="button" class="btn btn-primary w-100" id="search-bt" onclick="getDays()">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped table-bordered" id="planner-table">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Level</th>
                                    <th>Content</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Add/Edit -->
<div class="modal fade bd-example-modal-lg fixed-modal" id="plannerModal" data-backdrop="static" role="dialog" aria-hidden="true" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg fixed-modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Planner</h5>
                <button type="button" class="close" data-dismiss="modal"><span>X</span></button>
            </div>
            <div class="modal-body">
                <form id="plannerForm">
                    <input type="hidden" id="planner-id" name="id">
                    <input type="hidden" id="planner-month" name="month">
                    <input type="hidden" id="planner-level" name="level">
                    <div class="form-group">
                        <label for="planner-day">Date</label>
                        <input type="date" class="form-control" id="planner-day" name="date" readonly>
                    </div>
                    <div class="form-group">
                        <label for="planner-content">Content</label>
                        <textarea class="form-control" id="planner-content" name="content" rows="4" cols="50"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save-planner-btn">Save</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
<?= $this->section('pagescripts'); ?>

<script src="<?= base_url() ?>assets/ckeditor/ckeditor.js"></script>

<script>
    $(function() {
        CKEDITOR.replace('planner-content');
    });
    $(document).ready(function() {


        // $('#search-btn').click(function() {
        //     // Retrieve selected month and level
        //     let months = $('#month-select').val();
        //     let level = $('#level-select').val();

        //     // Validate inputs
        //     if (!months || !level) {
        //         alert('Please select both month and level.');
        //         return;
        //     }

        //     // Extract year and month, calculate days in the selected month
        //     const [year, month] = months.split('-').map(Number);
        //     const daysInMonth = new Date(year, month, 0).getDate();

        //     // Make POST request to fetch planner data
        //     $.ajax({
        //         url: '<?= base_url('get-planner-data') ?>',
        //         type: 'POST',
        //         data: {
        //             month,
        //             level
        //         },
        //         dataType: 'json',
        //         success: function(data) {
        //             // Get table body and clear existing content
        //             let tableBody = $('#planner-table tbody');
        //             tableBody.empty();

        //             // Iterate through all days of the selected month
        //             for (let day = 1; day <= daysInMonth; day++) {
        //                 // Format current date as YYYY-MM-DD
        //                 let currentdate = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

        //                 // Find data for the current date
        //                 let dayData = data.find(d => d.date === currentdate);

        //                 // Prepare table row content
        //                 let content = dayData ? dayData.content : 'No Content';
        //                 let id = dayData ? dayData.id : '';
        //                 let levelInfo = dayData && dayData.levelname ?
        //                     `Level - ${dayData.level} ${dayData.levelname}` :
        //                     'No Level';

        //                 // Truncate content to 30 characters
        //                 let truncatedContent = content.length > 30 ?
        //                     content.substring(0, 30) + '...' :
        //                     content;

        //                 // Prepare delete button if data exists
        //                 let deleteButton = dayData ?
        //                     `<button class="btn btn-sm btn-danger" onclick="deletePlanner(${id})">Delete</button>` :
        //                     '';

        //                 // Append the row to the table
        //                 tableBody.append(`
        //                     <tr>
        //                         <td>${day}</td>
        //                         <td>${currentdate}</td>
        //                         <td>${levelInfo}</td>
        //                         <td>${truncatedContent}</td>
        //                         <td>
        //                             <button class="btn btn-sm btn-warning" 
        //                                     onclick="editPlanner(${id})">Edit</button>
        //                             ${deleteButton}
        //                         </td>
        //                     </tr>
        //                 `);
        //             }
        //         },
        //         error: function(xhr, status, error) {
        //             alert('Failed to fetch planner data. Please try again later.');
        //         }
        //     });
        // });

        $('#save-planner-btn').click(function() {
            // Get content from CKEditor and update the hidden textarea
            const editorData = CKEDITOR.instances['planner-content'].getData();
            $('#planner-content').val(editorData); // Update hidden textarea value

            // Make an AJAX POST request to save planner data
            $.ajax({
                url: '<?= base_url('save-planner-data') ?>',
                type: 'POST',
                data: $('#plannerForm').serialize(),
                dataType: 'json',
                success: function(response) {
                    // Handle success response
                    if (response.status == true) {
                        // $('#search-btn').click(); // Refresh the table
                        Swal.fire({
                            position: "bottom-end",
                            title: "Good job!",
                            text: response.message,
                            icon: "success"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#plannerModal').modal('hide'); // Close modal

                            }
                        });

                    } else {
                        alert(response.error || 'Failed to save planner data.');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('Error saving planner data:', error);
                    alert('An error occurred while saving. Please try again.');
                }
            });
        });

    });

    function getDays() {
        // Retrieve selected month and level
        const monthYear = $('#month-select').val();
        const level = $('#level-select').val();

        // Validate inputs
        if (!monthYear || !level) {
            Swal.fire({
                icon: 'error',
                title: 'Not Select Month And Level',
                text: 'Please select both month and level.'
            });
            return;
        }

        // Extract year and month, calculate days in the selected month
        const [year, month] = monthYear.split('-').map(Number);
        const daysInMonth = new Date(year, month, 0).getDate();

        // Make POST request to fetch planner data
        $.ajax({
            url: '<?= base_url('get-planner-data') ?>',
            type: 'POST',
            data: {
                month,
                level
            },
            dataType: 'json',
            success: function(data) {
                const tableBody = $('#planner-table tbody');
                tableBody.empty();

                // Iterate through all days of the selected month
                for (let day = 1; day <= daysInMonth; day++) {
                    const currentDate = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                    const dayData = data.find(d => d.date === currentDate);

                    // Set default values for content and level
                    const content = dayData ? dayData.content : 'No Content';
                    const id = dayData ? dayData.id : 0;
                    const levelInfo = dayData && dayData.levelname ? `Level - ${dayData.level} ${dayData.levelname}` : 'No Level';

                    // Truncate content if it's too long
                    const truncatedContent = content.length > 30 ? `${content.substring(0, 30)}...` : content;

                    // Create delete button if data exists
                    const deleteButton = dayData ? `<button class="btn btn-sm btn-danger" onclick="deletePlanner(${id})">Delete</button>` : '';

                    // Append the row to the table
                    tableBody.append(`
                    <tr>
                        <td>${day}</td>
                        <td>${currentDate}</td>
                        <td>${levelInfo}</td>
                        <td>${truncatedContent}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" onclick="editPlanner(${id})">Edit</button>
                            ${deleteButton}
                        </td>
                    </tr>
                `);
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Request Failed',
                    text: 'Failed to fetch planner data. Please try again later.'
                });
            }
        });
    }

    /* function editPlanner(currentdate, content, id, month, level) {
         $('#planner-id').val(id);
         $('#planner-day').val(currentdate);
         $('#planner-content').val(content);
         $('#planner-month').val(month);
         $('#planner-level').val(level);
         CKEDITOR.instances['planner-content'].setData(content);
         $('#plannerModal').modal('show');
     }*/


    function editPlanner(id, currentDate, level) {
        if (id === 0) {
            // Prepare the modal for inserting a new record
            $('#planner-id').val(''); // Clear the hidden id field
            $('#planner-day').val(currentDate); // Set the current date
            $('#planner-month').val($('#month-select').val()); // Set the selected month
            $('#planner-level').val(level); // Set the level
            CKEDITOR.instances['planner-content'].setData(''); // Clear the content editor
            $('#plannerModal').modal('show'); // Show the modal
            $('.modal-title').text('INSERT PLANNER CONTENT'); // Update the modal title
        } else {
            // Load existing data for editing
            $.ajax({
                url: `<?= base_url() ?>edit-planner/${id}`,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    // Populate the form with existing data
                    $('#planner-id').val(data.id);
                    $('#planner-day').val(data.date);
                    $('#planner-month').val(data.month);
                    $('#planner-level').val(data.level);
                    CKEDITOR.instances['planner-content'].setData(data.content);
                    // Show the modal
                    $('#plannerModal').modal('show');
                    $('.modal-title').text('EDIT PLANNER CONTENT'); // Update the modal title
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error loading planner data: ' + errorThrown);
                }
            });
        }
    }


    function deletePlanner(id) {
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
                    url: "<?php echo base_url() ?>delete-planner/" + id,
                    type: "DELETE",
                    dataType: "JSON",
                    success: function(data) {
                        // $('#search-btn').click(); // Refresh the table
                        if (data.status == true) {
                            Swal.fire(
                                'Deleted!',
                                'Your Entry has been deleted.',
                                'success'
                            )
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