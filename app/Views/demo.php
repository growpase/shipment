function editPlanner(id, currentdate, content, level, levelName) {
        // Set initial modal data
        $('#planner-id').val(id);
        $('#planner-day').val(currentdate);
        $('#planner-level').val(level);

        // Always open the modal
        $('#plannerModal').modal('show');

        // Check if content exists
        if (content && content !== "") {
            // If content exists, populate the CKEditor with the existing content
            CKEDITOR.instances['planner-content'].setData(content);
            $('.modal-title').text('EDIT PLANNER CONTENT'); // Set modal title for editing
        } else {
            // If no content exists, initialize CKEditor with empty content
            CKEDITOR.instances['planner-content'].setData('');
            $('.modal-title').text('ADD PLANNER CONTENT'); // Set modal title for adding new content
           
        }
    }