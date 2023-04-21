<form action="<?= BASE_URL. "/home/profile"?>" method="post" enctype="multipart/form-data">
    <div class="modal fade modal-xl" id="profileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-auto">
                    <h1 class=""> Login sebagai Admin</h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- script profile modal --> 
    <script>
        var base_url = "<?= BASE_URL?>";
        var base_url_pub = "<?= BASE_URL_PUB?>";
    </script>
<!-- script profile modal --> 