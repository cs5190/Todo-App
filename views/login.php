<div class="container">
    <div class="row justify-content-center">
        <div class="d-flex justify-content-center align-items-center mb-4">
            <div class="text-center">
                <h1>Welcome<span class="blink">.</span></h1>
            </div>
        </div>
        <div class="d-flex gap-3 justify-content-center">
            <button id="back" type="button" class="btn btn-light back-button slow-blink">
                <<<
            </button>
            <div class="col-12 col-sm-8 col-md-6 col-lg-8">
            <div class="card">
                <button id="password-info-button" type="button" class="btn btn-light position-absolute top-0 end-0 mt-1 me-2 info-button">
                    ?
                </button>
                <div class="card-body">
                    <form class="d-flex flex-column gap-3">
                        <label class="font-weight-bold" for="password">Password</label>
                        <input id="password" type="password" placeholder="Enter Password" name="password" class="form-control" required>
                        <button id="login" type="button" class="btn btn-primary">Login</button>
                        <div class="description-container">
                            <small id="password-info" class="form-text text-muted typing-effect mt-1">Password must be at least 8 characters and include a number or a special character</small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
