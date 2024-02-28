<div class="container">
    <div class="row justify-content-center">
        <div class="d-flex justify-content-center align-items-center mb-4">
            <div class="text-center">
                <h1 aria-label="Welcome">Welcome<span class="blink">.</span></h1>
            </div>
        </div>
        <div class="d-flex gap-3 justify-content-center">
            <button id="back" type="button" class="btn btn-light back-button" aria-label="Go back">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                </svg>
            </button>
            <div class="col-12 col-sm-8 col-md-6 col-lg-8">
                <div class="card">
                    <button id="new-password-info-button" type="button" class="btn btn-light position-absolute top-0 end-0 mt-1 me-2 info-button" aria-label="Information about password">
                        ?
                    </button>
                    <div class="card-body">
                        <form class="d-flex flex-column gap-3">
                            <label class="font-weight-bold" for="password">Password</label>
                            <input id="password" type="password" placeholder="Enter Password" name="password" class="form-control" required aria-describedby="new-password-info">
                            <label class="font-weight-bold" for="verify-password">Verify Password</label>
                            <input id="verify-password" type="password" placeholder="Re-Enter Password" name="verify-password" class="form-control" required aria-describedby="new-password-info">
                            <button id="register" type="button" class="btn btn-primary">Register</button>
                            <div class="description-container">
                                <small id="new-password-info" class="form-text typing-effect mt-1">Password must be at least 8 characters and include a number or a special character</small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
