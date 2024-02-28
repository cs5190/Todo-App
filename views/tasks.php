<span id="tasks-page"></span>
<div class="container">
    <div class="row justify-content-center">
        <div class="d-flex justify-content-center align-items-center mb-4">
            <div class="text-center title-container">
                <h1 id="task-message" class="typing-effect">Lets Get To Work</h1>
            </div>
        </div>
        <div class="d-flex gap-3">
            <div class="tasks-content card col-12 col-sm-8 col-md-6 col-lg-8">
                <div class="card-body">
                <ul id="todo-list" class="list-group">
                    <!-- List items will be added here -->
                </ul>
                <ul id="archive-list" class="list-group">
                    <!-- Archived List items will be added here -->
                </ul>
                </div>
            </div>
            <div class="col-12 col-sm-8 col-md-2 col-lg-3 d-flex flex-column gap-3 justify-content-start">
                <button id="add" type="button" class="btn btn-primary w-120 hexagon-button" data-bs-toggle="modal" data-bs-target="#newtaskModal">Add Task</button>
                <button id="about" class="btn btn-danger w-120 hexagon-button">About</button>
            </div>
            <div class="col-12 col-sm-8 col-md-2 col-lg-3 d-flex flex-column gap-3 justify-content-start mt-4">
                <button id="archive" type="button" class="btn btn-secondary w-120 hexagon-button">Archive</button>
                <button id="logout" class="btn btn-danger w-120 hexagon-button">Logout</button>
            </div>
        </div>
    </div>
</div>
