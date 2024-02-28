<div id="tasks-page" class="container">
    <div class="row justify-content-center">
        <div class="d-flex justify-content-center align-items-center mb-4">
            <div class="text-center title-container">
                <h1 id="task-message" class="typing-effect" aria-label="Let's Get To Work">Lets Get To Work</h1>
            </div>
        </div>
        <div class="d-flex gap-3 justify-content-center">
            <div class="col-12 col-sm-8 col-md-2 col-lg-3 d-flex flex-column gap-3 justify-content-start mt-2 button-container">
                <button id="add" type="button" class="btn btn-secondary w-120 menu-button" data-bs-toggle="modal" data-bs-target="#newtaskModal" aria-label="Add new task">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                    </svg>
                </button>
                <button id="home" type="button" class="btn btn-secondary w-120 menu-button" style="display: none;" aria-label="Home">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                    </svg>
                </button>
                <button id="archive" type="button" class="btn btn-tertiary w-120 menu-button" aria-label="Archive">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive-fill" viewBox="0 0 16 16">
                        <path d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1M.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8z"/>
                    </svg>
                </button>
                <button id="about" class="btn btn-quaternary w-120 menu-button" aria-label="About">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-person" viewBox="0 0 16 16">
                        <path d="M12 1a1 1 0 0 1 1 1v10.755S12 11 8 11s-5 1.755-5 1.755V2a1 1 0 0 1 1-1zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                        <path d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                    </svg>
                </button>
                <button id="logout" class="btn btn-danger w-120 menu-button" aria-label="Logout">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
                        <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
                    </svg>
                </button>
            </div>
            <div class="tasks-content col-12 col-sm-8 col-md-6 col-lg-8">
                <ul id="task-list" class="list-group bg-transparent" aria-label="Task list">
                    <!-- List items will be added here -->
                </ul>
                <ul id="archive-list" class="list-group" aria-label="Archived tasks">
                    <!-- Archived List items will be added here -->
                </ul>
            </div>
        </div>
    </div>
</div>
