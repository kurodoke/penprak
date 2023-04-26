<!-- todo: 
1. input mhs
2. input asdos(role)
3. input matkul
4. view data mhs (role), matkul
5. edit dl mhs
6. edit dl role
7. edit dl matkul  -->

<?php
    Flasher::flash();
?>

<div class="loading">
  	<div class="loader"></div>
</div>

<div class="container" id="container-hidden" style="visibility: hidden;">
    <div class="row mt-3">
        <div class="col-3">
            <a href="" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#mhsModal">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Mahasiswa</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-3">
            <a href="<?= BASE_URL . "/admin/mahasiswa" ?>" class="text-decoration-none">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Mahasiswa</h4>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-6">
            <a href="" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#matkulModal">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Mata Kuliah</h4>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <h3>List Matkul</h3>
            <input type="text" id="search-mhs" class="form-control" onkeyup="searchMatkul()" placeholder="Id Matkul...">
            <p class="text-secondary mx-2">cari matkul menggunakan search ajaib ini</p>

            <table class="table table-mhs">
                <thead>
                    <tr>
                        <th>id Matkul</th>
                        <th>Nama</th>
                        <th>Semester</th>
                    </tr>
                </thead>
                <tbody class="tbody-custom">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="mhsModal" tabindex="-1" role="dialog" aria-labelledby="mhsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="<?= BASE_URL . "/admin/addmhs" ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="mhsModalLabel">Tambah Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="jurusan" class="col-form-label">Jurusan</label>
                                <select class="form-control" id="jurusan" name="jurusan">
                                    <option>G1A</option>
                                    <option>G1B</option>
                                    <option>G1C</option>
                                    <option>G1D</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="angkatan" class="col-form-label">Angkatan</label>
                                <input type="number" name="angkatan" class="form-control" id="angkatan" min="1" max="99" required>
                            </div>
                            <div class="col">
                                <label for="nomor" class="col-form-label">Nomor</label>
                                <input type="number" name="nomor" class="form-control" id="nomor" min="1" max="999" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="nama-mhs" class="col-form-label">Nama</label>
                                <input type="text" id="nama-mhs" class="form-control" name="nama" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="password" class="col-form-label">Password</label>
                                <input type="text" id="password" class="form-control" name="pass" value="admin" readonly>
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

<div class="modal fade" id="matkulModal" tabindex="-1" role="dialog" aria-labelledby="matkulModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="<?= BASE_URL . "/admin/addmatkul" ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="matkulModalLabel">Tambah Matkul</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="idmatkul" class="col-form-label">Id Matkul</label>
                                <input type="text" id="idmatkul" class="form-control" name="idmatkul" required>
                            </div>
                            <div class="col">
                                <label for="nama-matkul" class="col-form-label">Nama Matkul</label>
                                <input type="text" id="nama-matkul" class="form-control" name="nama" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="semester" class="col-form-label">Semester</label>
                                <select class="form-control" id="semester" name="semester">
                                    <option>ganjil</option>
                                    <option>genap</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="tahun" class="col-form-label">Tahun</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon3">20</span>
                                    <input type="number" name="tahun" class="form-control" id="tahun" min="1" max="99" placeholder="2 digit terakhir tahun, e.g., 23" required>
                                </div>
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

<script src="<?= BASE_URL_PUB. "/js/custom/home.admin.js" ?>"></script>