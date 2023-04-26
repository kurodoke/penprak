<div class="container">
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
        <div class="col">
            <table class="table">
                
            </table>
        </div>
    </div>

    <div class="row m-3 justify-content-between">
        <div class="col-3">  
            <button type="button" class="btn btn-danger hidden-elm" data-bs-toggle="modal" data-bs-target="#confirmHapusModal">Hapus tugas</button>
        </div>
        <div class="col-3">
            <button type="submit" class="btn btn-primary float-end hidden-elm">Input nilai</button>
        </div>
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
                <a href="<?= BASE_URL . "/admin/deletematkul/" . join("/", $data)?>" class="btn btn-danger">Iya</a>
            </div>
        </div>
    </div>
</div>