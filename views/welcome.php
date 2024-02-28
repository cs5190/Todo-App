<div class="container">
    <div class="row justify-content-center">
        <div class="d-flex justify-content-center align-items-center mb-4">
            <div class="text-center title-container">
                <h1 id="initial-welcome" class="typing-effect">Welcome</h1>
            </div>
        </div>
        <div class="col-12 col-sm-8 col-md-6 col-lg-8">
            <div class="card">
                <button id="welcome-info-button" type="button" class="btn btn-light position-absolute top-0 end-0 mt-1 me-2 info-button" aria-label="Information">
                    ?
                </button>
                <div class="card-body">
                    <form class="d-flex flex-column welcome-box">
                        <label class="font-weight-bold" for="username">Username</label>
                        <div>
                            <div class="description-container">
                                <small id="welcome-info" class="form-text typing-effect mt-1">If you're a new user go ahead and enter your new username. Your new account awaits</small>
                            </div>
                            <input id="username" type="text" placeholder="Enter Username" name="username" class="form-control" required aria-describedby="welcome-info">
                        </div>
                        <button id="submit-username" type="button" class="btn btn-primary mt-auto">Check In!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
