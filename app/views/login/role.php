<!-- todo: 
1. choose role when available -->
<?php
    if(isset($_POST["login-mhs"])){
        $_SESSION['role'] = "mahasiswa";
        $this->location("home");
    } else if (isset($_POST["login-asdos"])){
        $this->location("home");
    }
?>


<form action="" method="post">
    <div class="container">
        <div class="row justify-content-center align-content-center" style="height: 100vh;">
            <div class="col-4">
                <button type="submit" class="invis-button" name="login-mhs">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Sebagai Mahasiswa</h5>
                            <p class="card-text">Kamu akan login sebagai mahasiswa</p>
                        </div>
                    </div>
                </button>
            </div>
            <div class="col-4">
                <button type="submit" class="invis-button" name="login-asdos">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Sebagai Asisten Dosen</h5>
                            <p class="card-text">Kamu akan login sebagai Asisten Dosen</p>
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </div>
</form>