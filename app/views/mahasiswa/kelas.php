<?php
    Flasher::flash();
?>

<div class="loading">
    <div class="loader"></div>
</div>

<div class="container">
    <div class="row">
        <div class="col banner-kelas-big"></div>
        <!-- <div class="col mt-3 rounded mb-3 banner-background-3">
            <h2 class="card-title m-5 text-white">
                Basis Data Lanjutan
            </h2>
        </div> -->
    </div>
    <div class="row">
        <div class="col-3 bobot-custom">
            <!-- <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fas fa-users-class"></i> Deskripsi Kelas</h4>
                    <h5 class="card-subtitle mb-2 text-body-secondary">Bobot Nilai</h5>
                    <p class="card-text">Laporan : 30</p>
                    <p class="card-text">Responsi : 30</p>
                    <p class="card-text">Tugas Besar : 40</p>
                    <a href="#" class="btn btn-primary">Lihat Nilai Kamu!</a>
                </div>
            </div> -->
        </div>

        <div class="col-9">
            <!-- <form action="<?= BASE_URL . "/kelas/upload/" . $data[0] . "/" . $data[1] ?>" method="post" enctype="multipart/form-data"> -->
                <div class="tugas-custom">
                    <!-- <div class="card mb-3">
                        <div class="card-header">
                            Laprak
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Laporan 1</h5>
                            <p class="card-text" style="white-space: pre-line;">buat lah laporan dengan soal berikut :
                                1. buat review
                                2. buat normalisasi
                                3. buat bumi
                                4. buat dunia
                            </p>
                            <button type="submit" class="btn btn-primary" name="submit-tugas">Submit Tugas</button>
                            <input type="hidden" value="1" name="nomorTugas">
                        </div>
                    </div> -->
                </div>
            <!-- </form> -->
        </div>
    </div>
</div>

<div class="modal fade" id="modalNilai" tabindex="-1" aria-labelledby="modalNilai" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalNilaiLabel">Nilai kamu adalah</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center modal-nilai">
                <h1>31</h1>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<script src="<?= BASE_URL_PUB . "/js/custom/kelas.main.mhs.js" ?>"></script>