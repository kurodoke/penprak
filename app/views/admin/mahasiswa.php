<?php
    Flasher::flash();
?>

<div class="loading">
  	<div class="loader"></div>
</div>

<div class="container" id="container-hidden" style="visibility: hidden;">
    <div class="row m-3 justify-content-between">
        <div class="col-3">
            <h3>Mahasiswa</h3>
        </div>
        <div class="col-3">
            <a href="<?= BASE_URL . "/home"?>" class="btn-close float-end"></a>
        </div>
    </div>

    <div class="row m-3 justify-content-between">
        <div class="col">
            <input type="text" id="search-mhs" class="form-control" onkeyup="searchMhs()" placeholder="npm..., e.g., G1A021">
            <table class="table table-mhs">
                <thead>
                    <tr>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="tbody-custom">
                    <tr>
                        <!-- <td>G1A012076</td>
                        <td>Arief SAtri Budi Praosjo</td>
                        <td>
                            <a href="" class="btn btn-danger btn-sm">Hapus</a>
                        </td> -->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="<?= BASE_URL_PUB. "/js/custom/mahasiswa.admin.js" ?>"></script>