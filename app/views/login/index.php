<?php
    // todo: 
    // 2. session 
    // 1. login view model login
?>
<?= Flasher::flash() ?>
<div class="container-fluid">
    <div class="row justify-content-center" style="height: 100vh;">
        <div class="col-4 m-auto">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="display-6">Login</h3>
                </div>
                <div class="card-body">
                    <form action="<?= BASE_URL?>/login/login" method="post">
                        <div class="row mt-3">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="user" placeholder="e.g., G1A012034">
                                    <div id="userHelp" class="form-text">Inputkan Username kamu.. npm juga boleh</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="password" class="form-label" >Password</label>
                                    <input type="password" class="form-control" id="password" name="pass">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-8">
                                <a href="<?= BASE_URL . "/login/editpass/" ?>" class="text-decoration-none">kamu mau ganti password?</a>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary float-end" name="login-btn">Submit</button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
