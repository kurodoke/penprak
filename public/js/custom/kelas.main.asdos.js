onload();

async function onload(){
    let path = "/penprak/kelas/index/"
    let currentURL = window.location.pathname;
    let params = currentURL.replace(path, "");
    params = params.split("/");

    //tugas
    await fetch(base_url + "/api/tugas/" + params.join("/"))
        .then( res => res.json())
        .then( (result) => {
            let elm = document.querySelector(".tugas-custom");
            let elmBuild = ``;
            if( result["status"] != "err"){
                result.forEach(data => {
                elmBuild += `
            <a href="${base_url + "/kelas/tugas/" + params.join("/") + "/" + data["nomorTugas"]}" class="text-decoration-none">
                <div class="card mb-3">
                    <div class="card-header">
                        ${data["jenis"]}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Tugas ke-${data["nomorTugas"]}</h5>
                        <p class="card-text" style="white-space: pre-line;">${data["deskripsi"]}</p>
                    </div>
                </div>
            </a>`;
                })
            }
            elm.innerHTML = elmBuild;
        })

    //bobot
    await fetch(base_url + "/api/bobot/" + params.join("/"))
        .then( res => res.json())
        .then( (result) => {
            let elm = document.querySelector(".bobot-modal-custom");
            let elmBuild = `
            <form action="${base_url + "/kelas/editbobot/" + params.join("/")}" method="post">
            <div class="modal-header">
                <h5 class="modal-title" id="bobotModalLabel">Edit Bobot</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">`;
                        result.forEach(data => {
                            elmBuild += `
                            <div class="col">
                                <label for="bobot-${data['jenis'].toLowerCase()}" class="col-form-label">${data['jenis']}</label>
                                <input type="text" class="form-control" id="bobot-${data['jenis'].toLowerCase()}" placeholder="${data['bobot']}" name="${data['jenis'].toLowerCase()}">
                            </div>`;
                        });
            elmBuild += `
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
            </form>`;
            elm.innerHTML = elmBuild;
        })
    
        document.querySelector(".loading").style.display = "none";
    
}