<?php
    Flasher::flash();
?>


<div class="container">
    <div class="row">
        <div class="col-4 mt-4">
            <div class="row mb-3">
                <div class="col">
                    <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#bobotModal">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-edit"></i> Ganti Bobot Tugas</h5>
                                <p class="card-text">Pengen ganti bobot tugas anak didik kamu?</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col md-3">
                    <a href="<?= BASE_URL . "/kelas/datamhs/" . join("/", $data) ?>" class="text-decoration-none">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-users"></i> Lihat Data Siswa</h5>
                                <p class="card-text">Pengen lihat siapa aja yang kamu didik?</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col md-3">
                    <a href="<?= BASE_URL . "/kelas/rekap/" . join("/", $data) ?>" class="text-decoration-none">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-poll"></i> Rekap Nilai Siswa</h5>
                                <p class="card-text">Pengen ngerekap nilai semua anak didik kamu?</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-8 mt-4">
            <div class="row">
                <div class="col">
                    <a href="" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#tugasModal">
                        <div class="card mb-3">
                            <div class="card-body text-center m-auto">
                                <p class="card-text"><i class="fas fa-plus"></i> Tambah Tugas</p>
                            </div>
                        </div>
                    </a>
                    <div class="tugas-custom">
                        <!-- <a href="" class="text-decoration-none">
                            <div class="card mb-3">
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
                                </div>
                            </div>
                        </a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal bobot -->
    <div class="modal fade" id="bobotModal" tabindex="-1" role="dialog" aria-labelledby="bobotModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bobot-modal-custom">
                <form action="" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bobotModalLabel">Edit Bobot</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col">
                                        <label for="bobot-laprak" class="col-form-label">Laprak</label>
                                        <input type="text" class="form-control" id="bobot-laprak" placeholder="">
                                    </div>
                                    <div class="col">
                                        <label for="bobot-responsi" class="col-form-label">Responsi</label>
                                        <input type="text" class="form-control" id="bobot-responsi" placeholder="">
                                    </div>
                                    <div class="col">
                                        <label for="bobot-tubes" class="col-form-label">Tubes</label>
                                        <input type="text" class="form-control" id="bobot-tubes" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal bobot -->


    <!-- modal tambah tugas -->
    <div class="modal fade" id="tugasModal" tabindex="-1" role="dialog" aria-labelledby="tugasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form action="<?= BASE_URL . "/kelas/addtugas/" . join("/", $data) ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tugasModalLabel">Tambah tugas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="jenis-tugas" class="col-form-label">Jenis</label>
                                    <select class="form-control" id="jenis-tugas" name="jenis">
                                        <option>Laprak</option>
                                        <option>Responsi</option>
                                        <option>Tubes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="soal-tugas">Soal</label>
                                    <textarea class="form-control" id="soal-tugas" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal tambah tugas -->
</div>

<script src="<?= BASE_URL_PUB . "/js/custom/kelas.main.asdos.js" ?>"></script>


