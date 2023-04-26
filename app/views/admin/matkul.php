<?php
    Flasher::flash();
?>

<div class="loading">
  	<div class="loader"></div>
</div>

<div class="container" id="container-hidden" style="visibility: hidden;">
    <div class="row m-3 justify-content-between">
        <div class="col-3">
            <h3>Matkul <?= $data[0] ?></h3>
            <h6 class="text-secondary"><?= str_replace("-", " ", $data[1]) ?></h6>
        </div>
        <div class="col-3">
            <a href="<?= BASE_URL . "/home"?>" class="btn-close float-end"></a>
        </div>
    </div>
    <div class="row">
        <form action="<?= BASE_URL . "/admin/editMatkul/" . join("/", $data) ?>" method="post"> 
            <div class="col">
                <div class="row m-3">
                    <div class="col">
                        <input type="text" id="search-mhs" class="form-control" onkeyup="searchMhs()" placeholder="npm..., e.g., G1A021">
                        <table class="table table-mhs">
                            <thead>
                                <tr>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class="tbody-custom">
                                <!-- <tr>
                                    <td>G1A021076</td>
                                    <td>Arief Satrio Budi Prasojo</td>
                                    <td>
                                        <input type="hidden" name="npm[]" value="G1A012076">
                                        <select name="status[]" class="form-select">
                                            <option value="" selected>---</option>
                                            <option value="Mahasiswa">Mahasiswa</option>
                                            <option value="Asisten Dosen">Asisten Dosen</option>
                                        </select>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row m-3 justify-content-between">
                    <div class="col-3">  
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmHapusModal">Hapus Matkul</button>
                    </div>
                    <!-- hidden-elm -->
                    <div class="col-3">
                        <button type="submit" class="btn btn-primary float-end">Edit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


</div>


<div class="modal fade" tabindex="-1" id="confirmHapusModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Kamu yakin mau hapus matkul ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Gak jadi</button>
                <a href="<?= BASE_URL . "/admin/delmatkul/" . join("/", $data)?>" class="btn btn-danger">Iya</a>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASE_URL_PUB. "/js/custom/matkul.admin.js" ?>"></script>