<?php
    Flasher::flash();
?>

<div class="loading">
    <div class="loader"></div>
</div>

<div class="container-fluid">
    <div class="row m-3 justify-content-between">
        <div class="col-3">
            <h3>Tugas</h3>
        </div>
        <div class="col-3">
            <a href="<?= BASE_URL . "/kelas/index/" . join("/", array($data[0], $data[1])) ?>" class="btn-close float-end"></a>
        </div>
    </div>

    <form action="<?= BASE_URL . "/kelas/nilai/" . join("/", $data)?>" method="post">
        <div class="row m-3 nilai-custom">
            <!-- <div class="col-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">G1A021076</h5>
                        <input type="hidden" name="npm[0]" value="G1A021076">
                        <a href="<?= BASE_URL_PUB . "/pdf/G1A021076_TIF-201_genap-2023_1.pdf" ?>" class="text-decoration-none text-secondary"><i class="fa-solid fa-circle-check text-success"></i> Lihat Tugas~</a>
                        <div class="input-group mt-3">
                            <input type="number" min="0" max="100" class="form-control" name="nilai[0]"><span class="input-group-text">/100</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">G1A021011</h5>
                        <p class="card-text text-secondary"><i class="fa-solid fa-circle-xmark text-danger"></i> Belum Mengumpulkan</p>
                        <div class="input-group mt-3">
                            <input type="number" min="0" max="100" class="form-control" name="nilai[1]" disabled><span class="input-group-text">/100</span>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>

        <div class="row m-3 justify-content-between">
            <div class="col-3">  
                <button type="button" class="btn btn-danger hidden-elm" data-bs-toggle="modal" data-bs-target="#confirmHapusModal">Hapus tugas</button>
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-primary float-end hidden-elm">Input nilai</button>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" tabindex="-1" id="confirmHapusModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Kamu yakin mau hapus tugas ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Gak jadi</button>
                <a href="<?= BASE_URL . "/kelas/deletetugas/" . join("/", $data)?>" class="btn btn-danger">Gas</a>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASE_URL_PUB . "/js/custom/kelas.tugas.asdos.js" ?>"></script>