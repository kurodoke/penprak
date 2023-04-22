<!-- Modal profile navbar -->
<form action="<?= BASE_URL. "/home/editProfile"?>" method="post" enctype="multipart/form-data">
    <div class="modal fade modal-xl" id="profileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-5 m-auto w-0 text-center">
                                <button type="button" class="invis-button"  data-bs-target="#profileModal2" data-bs-toggle="modal">
                                    <img src="<?= BASE_URL_PUB . "/img/profile/" . $_SESSION['user'] . ".jpg" ?>" class="img-thumbnail img-fluid mx-auto d-block" id="img-profile" alt="">
                                </button>
                            </div>
                            <div class="col-7">
                                <div class="row">
                                    <div class="col mb-1">
                                        <label for="profile-npm" class="col-form-label">NPM</label>
                                        <input type="text" class="form-control" id="profile-npm" placeholder="" readonly>
                                    </div>
                                    <div class="col mb-1">
                                        <label for="profile-name" class="col-form-label">Nama</label>
                                        <input type="text" class="form-control" id="profile-name" placeholder="" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-1">
                                        <label for="profile-fakultas" class="col-form-label">Fakultas</label>
                                        <input type="text" class="form-control" id="profile-fakultas" placeholder="" readonly>
                                    </div>
                                    <div class="col mb-1">
                                        <label for="profile-prodi" class="col-form-label">Program Studi</label>
                                        <input type="text" class="form-control" id="profile-prodi" placeholder="" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1">
                                        <label for="profile-tgllahir" class="col-form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="profile-tgllahir" placeholder="" name="tglLahir">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1">
                                        <label for="profile-email" class="col-form-label">Email</label>
                                        <input type="email" class="form-control" id="profile-email" placeholder="" name="email">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1">
                                        <label for="profile-alamat" class="col-form-label">Alamat</label>
                                        <textarea class="form-control" id="profile-alamat" placeholder=""></textarea name="alamat">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="edit-profile-btn">Edit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal file upload -->
    <div class="modal fade" id="profileModal2" aria-hidden="true" aria-labelledby="profileModalLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="profileModalLabel2">Input Foto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="imgProfile" class="form-label">Input foto Profile</label>
                    <input class="form-control" type="file" id="imgProfile" name="fileImg">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-target="#profileModal" data-bs-toggle="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal file upload -->
</form>
    <!-- script profile modal --> 
    <script>
        var base_url = "<?= BASE_URL?>";
    </script>

    <script src="<?= BASE_URL_PUB. "/js/custom/profile.js" ?>"></script>
    <!-- script profile modal -->
<!-- Modal profile navbar -->