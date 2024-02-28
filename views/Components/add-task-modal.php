<div class="modal fade" id="newtaskModal" tabindex="-1" role="dialog" aria-labelledby="newtaskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newtaskModalLabel">New Task</h5>
                <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="task-form">
                    <div class="form-group">
                        <label for="task-label" class="col-form-label">Label</label>
                        <input type="text" class="form-control" id="task-label" aria-describedby="task-label-help">
                        <small id="task-label-help" class="form-text">Enter the label for the task.</small>
                    </div>
                    <div class="form-group">
                        <label for="task-description" class="col-form-label">Description</label>
                        <textarea class="form-control" id="task-description" aria-describedby="task-description-help"></textarea>
                        <small id="task-description-help" class="form-text">Enter the description for the task.</small>
                    </div>
                    <div class="form-group">
                        <label for="task-due-date" class="col-form-label">Due Date</label>
                        <input type="date" class="form-control" id="task-due-date" name="task-due-date" value="2024-02-27" min="2024-02-27" max="2029-12-31" aria-describedby="task-due-date-help" />
                        <small id="task-due-date-help" class="form-text">Enter the due date for the task.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button form="task-form" id="send-task-form" type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Add task">Add task</button>
            </div>
        </div>
    </div>
</div>
