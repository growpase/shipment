<?= $this->extend('commanfile/header'); ?>
<?= $this->section('content'); ?>

<div class="main-content-inner">
    <div class="row">
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-start align-items-center mb-3">
                        <input type="month" id="month-select" class="form-control" class="form-control mr-" style="width: 200px;">


                        <select id="level-select" class="form-control mr-2" style="width: 200px;">
                            <option value="" disabled selected>Select Level</option>
                            <?php foreach ($levels as $level): ?>
                                <option value="<?= $level->id ?>"><?= 'Level - ' . $level->id . ' ' . $level->level_name ?></option>
                            <?php endforeach; ?>
                        </select>

                        <button class="btn btn-primary" id="search-btn">Search</button>
                    </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
   $(function () {
    // Initialize CKEditor
    CKEDITOR.replace('planner-content');
});

$(document).ready(function () {
    /**
     * Search button click handler
     */
    $('#search-btn').click(function () {
        // Retrieve selected month and level
        let months = $('#month-select').val();
        let level = $('#level-select').val();

        // Validate inputs
        if (!months || !level) {
            Swal.fire({
                title: 'Missing Inputs!',
                text: 'Please select both month and level.',
                icon: 'warning',
                confirmButtonText: 'Okay',
                timer: 3000, // Optional: Auto close after 3 seconds
                showConfirmButton: true
            });
            return;
        }

        // Extract year and month, calculate days in the selected month
        const [year, month] = months.split('-').map(Number);
        const daysInMonth = new Date(year, month, 0).getDate();

        // Fetch planner data
        $.ajax({
            url: '<?= base_url('admin/get-planner-data') ?>',
            type: 'POST',
            data: { month, level },
            dataType: 'json',
            success: function (data) {
                let tableBody = $('#planner-table tbody');
                tableBody.empty();

                for (let day = 1; day <= daysInMonth; day++) {
                    let currentdate = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                    let dayData = data.find(d => d.date === currentdate);

                    let content = dayData ? dayData.content : 'No Content';
                    let id = dayData ? dayData.id : 0;
                    let levelInfo = dayData && dayData.levelname ? `Level - ${dayData.level} ${dayData.levelname}` : 'No Level';
                    let truncatedContent = content.length > 30 ? content.substring(0, 30) + '...' : content;

                    let deleteButton = dayData ? `<button class="btn btn-sm btn-danger" onclick="deletePlanner(${id})">Delete</button>` : '';

                    tableBody.append(`
                        <tr>
                            <td>${day}</td>
                            <td class="cur_date">${currentdate}</td>
                            <td>${levelInfo}</td>
                            <td>${truncatedContent}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" onclick="editPlanner(${id},'${currentdate}','${month}','${level}')">Edit</button>
                                ${deleteButton}
                            </td>
                        </tr>
                    `);
                }
            },
            error: function () {
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to fetch planner data.',
                    icon: 'error',
                    confirmButtonText: 'Okay'
                });
            }
        });
    });

    /**
     * Save button click handler
     */
    $('#save-planner-btn').click(function () {
        const editorData = CKEDITOR.instances['planner-content'].getData();
        $('#planner-content').val(editorData);

        $.ajax({
            url: '<?= base_url('admin/save-planner-data') ?>',
            type: 'POST',
            data: $('#plannerForm').serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.status === true) {
                    $('#search-btn').click(); // Refresh the table
                    Swal.fire({
                        position: 'bottom-end',
                        title: 'Good job!',
                        text: response.message,
                        icon: 'success'
                    }).then(() => $('#plannerModal').modal('hide')); // Close modal
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.error || 'Failed to save planner data.',
                        icon: 'error',
                        confirmButtonText: 'Okay'
                    });
                }
            },
            error: function () {
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while saving.',
                    icon: 'error',
                    confirmButtonText: 'Okay'
                });
            }
        });
    });
});

/**
 * Edit planner content
 */
function editPlanner(id, currentdate, month, level) {
    if (id === 0) {
        $('#planner-day').val(currentdate);
        $('#planner-month').val(month);
        $('#planner-level').val(level);
        CKEDITOR.instances['planner-content'].setData('');
        $('#plannerModal').modal('show');
        $('.modal-title').text('INSERT PLANNER CONTENT');
    } else {
        $.ajax({
            url: `<?= base_url() ?>edit-planner/${id}`,
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                $('#planner-id').val(data.id);
                $('#planner-day').val(data.date);
                $('#planner-month').val(data.month);
                $('#planner-level').val(data.level);
                CKEDITOR.instances['planner-content'].setData(data.content);
                $('#plannerModal').modal('show');
                $('.modal-title').text('EDIT PLANNER CONTENT');
            },
            error: function () {
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to load planner data.',
                    icon: 'error',
                    confirmButtonText: 'Okay'
                });
            }
        });
    }
}

/**
 * Delete planner content
 */
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
                url: `<?= base_url() ?>admin/delete-planner/${id}`,
                type: 'DELETE',
                dataType: 'JSON',
                success: function (data) {
                    if (data.status === true) {
                        Swal.fire('Deleted!', 'Your entry has been deleted.', 'success');
                    }
                },
                error: function () {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to delete planner data.',
                        icon: 'error',
                        confirmButtonText: 'Okay'
                    });
                }
            });
        }
    });
}

</script>
<?= $this->endSection(); ?>