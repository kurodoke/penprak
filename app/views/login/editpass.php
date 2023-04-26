<div class="container-fluid">
    <div class="row justify-content-center" style="height: 100vh;">
        <div class="col-4 m-auto">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="display-6">Ganti Password</h3>
                </div>
                <div class="card-body">
                    <form action="<?= BASE_URL?>/login/pass" method="post">
                        <div class="row mt-3">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="user" placeholder="e.g., G1A012034" required>
                                    <div id="userHelp" class="form-text">Inputkan Username kamu.. npm juga boleh</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="password" class="form-label" >Password Lama</label>
                                    <input type="password" class="form-control" id="password" name="passLama" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="password" class="form-label" >Password Baru</label>
                                    <input type="password" class="form-control" id="password" name="passBaru" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <a href="<?= BASE_URL . "/login" ?>" class="btn btn-secondary" name="login-btn">Balik</a>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary float-end" name="login-btn">Submit</button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
